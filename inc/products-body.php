<?php
session_start();
include('database.php'); // Required for $conn

$session_id = $_SESSION['session_id'] ?? '';

if (!$session_id) {
    header("Location: index.php");
    exit();
}

$message = '';

$allow = ['jpg', 'jpeg', 'png', 'gif', 'pdf', 'JPG', 'JPEG', 'PNG', 'GIF', 'PDF'];

function uploadFile($fileField) {
    global $allow;
    if (!empty($_FILES[$fileField]['name'])) {
        $extension = pathinfo($_FILES[$fileField]['name'], PATHINFO_EXTENSION);
        if (in_array($extension, $allow)) {
            $filename = md5(rand() * time()) . '.' . $extension;
            $target_path = 'uploads/' . $filename;
            if (move_uploaded_file($_FILES[$fileField]['tmp_name'], $target_path)) {
                return $filename;
            }
        }
    }
    return null;
}

if (isset($_POST['Submit'])) {
    $pro_name = $_POST['productname'] ?? '';
    $pro_sp = $_POST['sellingprice'] ?? '';
    $pro_rp = $_POST['regularprice'] ?? '';
    $pro_desc = addslashes($_POST['productdesc'] ?? '');

    $photo1 = uploadFile('photo1');
    $photo2 = uploadFile('photo2');
    $photo3 = uploadFile('photo3');

    $fields = [
        "pro_name = '$pro_name'",
        "pro_sp = '$pro_sp'",
        "pro_rp = '$pro_rp'",
        "pro_desc = '$pro_desc'"
    ];

    if ($photo1) $fields[] = "pro_img_1 = '$photo1'";
    if ($photo2) $fields[] = "pro_img_2 = '$photo2'";
    if ($photo3) $fields[] = "pro_img_3 = '$photo3'";

    $stmt = $conn->prepare("SELECT id FROM products WHERE id = 1");
    $stmt->execute();

    if ($stmt->fetch()) {
        // Update
        $sql = "UPDATE products SET " . implode(', ', $fields) . " WHERE id = 1";
        $conn->exec($sql);
        $message = "✅ Product updated successfully!";
    } else {
        // Insert
        $columns = ['pro_name', 'pro_sp', 'pro_rp', 'pro_desc'];
        $values = [$pro_name, $pro_sp, $pro_rp, $pro_desc];
        if ($photo1) { $columns[] = 'pro_img_1'; $values[] = $photo1; }
        if ($photo2) { $columns[] = 'pro_img_2'; $values[] = $photo2; }
        if ($photo3) { $columns[] = 'pro_img_3'; $values[] = $photo3; }

        $sql = "INSERT INTO products (" . implode(',', $columns) . ") VALUES (" . rtrim(str_repeat('?,', count($values)), ',') . ")";
        $stmt = $conn->prepare($sql);
        $stmt->execute($values);
        $message = "✅ Product added successfully!";
    }
}

// Fetch product data
$stmt = $conn->prepare("SELECT * FROM products WHERE id = 1");
$stmt->execute();
$product = $stmt->fetch(PDO::FETCH_OBJ);

$p_name = $product->pro_name ?? '';
$p_sp = $product->pro_sp ?? '';
$p_rp = $product->pro_rp ?? '';
$p_desc = $product->pro_desc ?? '';
$img1 = $product->pro_img_1 ?? 'assets/img/product.jpg';
$img2 = $product->pro_img_2 ?? 'assets/img/product2.jpg';
$img3 = $product->pro_img_3 ?? 'assets/img/product3.jpg';
?>
<div class="container mt-4">
    <div class="row">
        <div class="col-md-12 text-center mb-3">
            <h3>My Products</h3>
            <?php if ($message): ?>
                <div class="alert alert-success"><?php echo $message; ?></div>
            <?php endif; ?>
        </div>
    </div>
    <div class="row">
        <!-- Image preview -->
        <div class="col-md-3 text-center">
            <img src="uploads/<?php echo $img1; ?>" height="300px"><br><br>
            <div class="row">
                <div class="col-4"><img src="uploads/<?php echo $img2; ?>" height="100px"></div>
                <div class="col-4"><img src="uploads/<?php echo $img3; ?>" height="100px"></div>
                <div class="col-4"><img src="uploads/<?php echo $img1; ?>" height="100px"></div>
            </div>
        </div>

        <!-- Product form -->
        <div class="col-md-9">
            <form method="POST" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label><strong>Product Name</strong></label>
                        <input type="text" name="productname" class="form-control" value="<?php echo htmlspecialchars($p_name); ?>">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label><strong>Regular Price</strong></label>
                        <input type="text" name="regularprice" class="form-control" value="<?php echo htmlspecialchars($p_rp); ?>">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label><strong>Selling Price</strong></label>
                        <input type="text" name="sellingprice" class="form-control" value="<?php echo htmlspecialchars($p_sp); ?>">
                    </div>
                    <div class="col-md-12 mb-3">
                        <label><strong>Description</strong></label>
                        <textarea name="productdesc" class="form-control" style="height:200px;"><?php echo htmlspecialchars($p_desc); ?></textarea>
                    </div>
                    <div class="col-md-4 mb-3">
                        <input type="file" name="photo1" class="form-control">
                    </div>
                    <div class="col-md-4 mb-3">
                        <input type="file" name="photo2" class="form-control">
                    </div>
                    <div class="col-md-4 mb-3">
                        <input type="file" name="photo3" class="form-control">
                    </div>
                    <div class="col-md-12 text-center">
                        <button type="submit" name="Submit" class="btn btn-warning">Update Product</button>
                    </div>
                </div>
            </form>
        </div>
            <div class="row">
        <!-- Image preview -->
        <div class="col-md-3 text-center">
            <img src="uploads/<?php echo $img1; ?>" height="300px"><br><br>
            <div class="row">
                <div class="col-4"><img src="uploads/<?php echo $img2; ?>" height="100px"></div>
                <div class="col-4"><img src="uploads/<?php echo $img3; ?>" height="100px"></div>
                <div class="col-4"><img src="uploads/<?php echo $img1; ?>" height="100px"></div>
            </div>
        </div>

        <!-- Product form -->
        <div class="col-md-9">
            <form method="POST" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label><strong>Product Name</strong></label>
                        <input type="text" name="productname" class="form-control" value="<?php echo htmlspecialchars($p_name); ?>">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label><strong>Regular Price</strong></label>
                        <input type="text" name="regularprice" class="form-control" value="<?php echo htmlspecialchars($p_rp); ?>">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label><strong>Selling Price</strong></label>
                        <input type="text" name="sellingprice" class="form-control" value="<?php echo htmlspecialchars($p_sp); ?>">
                    </div>
                    <div class="col-md-12 mb-3">
                        <label><strong>Description</strong></label>
                        <textarea name="productdesc" class="form-control" style="height:200px;"><?php echo htmlspecialchars($p_desc); ?></textarea>
                    </div>
                    <div class="col-md-4 mb-3">
                        <input type="file" name="photo1" class="form-control">
                    </div>
                    <div class="col-md-4 mb-3">
                        <input type="file" name="photo2" class="form-control">
                    </div>
                    <div class="col-md-4 mb-3">
                        <input type="file" name="photo3" class="form-control">
                    </div>
                    <div class="col-md-12 text-center">
                        <button type="submit" name="Submit" class="btn btn-warning">Update Product</button>
                    </div>
                </div>
            </form>
        </div>
            <div class="row">
        <!-- Image preview -->
        <div class="col-md-3 text-center">
            <img src="uploads/<?php echo $img1; ?>" height="300px"><br><br>
            <div class="row">
                <div class="col-4"><img src="uploads/<?php echo $img2; ?>" height="100px"></div>
                <div class="col-4"><img src="uploads/<?php echo $img3; ?>" height="100px"></div>
                <div class="col-4"><img src="uploads/<?php echo $img1; ?>" height="100px"></div>
            </div>
        </div>

        <!-- Product form -->
        <div class="col-md-9">
            <form method="POST" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label><strong>Product Name</strong></label>
                        <input type="text" name="productname" class="form-control" value="<?php echo htmlspecialchars($p_name); ?>">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label><strong>Regular Price</strong></label>
                        <input type="text" name="regularprice" class="form-control" value="<?php echo htmlspecialchars($p_rp); ?>">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label><strong>Selling Price</strong></label>
                        <input type="text" name="sellingprice" class="form-control" value="<?php echo htmlspecialchars($p_sp); ?>">
                    </div>
                    <div class="col-md-12 mb-3">
                        <label><strong>Description</strong></label>
                        <textarea name="productdesc" class="form-control" style="height:200px;"><?php echo htmlspecialchars($p_desc); ?></textarea>
                    </div>
                    <div class="col-md-4 mb-3">
                        <input type="file" name="photo1" class="form-control">
                    </div>
                    <div class="col-md-4 mb-3">
                        <input type="file" name="photo2" class="form-control">
                    </div>
                    <div class="col-md-4 mb-3">
                        <input type="file" name="photo3" class="form-control">
                    </div>
                    <div class="col-md-12 text-center">
                        <button type="submit" name="Submit" class="btn btn-warning">Update Product</button>
                    </div>
                </div>
            </form>
        </div>
            <div class="row">
        <!-- Image preview -->
        <div class="col-md-3 text-center">
            <img src="uploads/<?php echo $img1; ?>" height="300px"><br><br>
            <div class="row">
                <div class="col-4"><img src="uploads/<?php echo $img2; ?>" height="100px"></div>
                <div class="col-4"><img src="uploads/<?php echo $img3; ?>" height="100px"></div>
                <div class="col-4"><img src="uploads/<?php echo $img1; ?>" height="100px"></div>
            </div>
        </div>

        <!-- Product form -->
        <div class="col-md-9">
            <form method="POST" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label><strong>Product Name</strong></label>
                        <input type="text" name="productname" class="form-control" value="<?php echo htmlspecialchars($p_name); ?>">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label><strong>Regular Price</strong></label>
                        <input type="text" name="regularprice" class="form-control" value="<?php echo htmlspecialchars($p_rp); ?>">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label><strong>Selling Price</strong></label>
                        <input type="text" name="sellingprice" class="form-control" value="<?php echo htmlspecialchars($p_sp); ?>">
                    </div>
                    <div class="col-md-12 mb-3">
                        <label><strong>Description</strong></label>
                        <textarea name="productdesc" class="form-control" style="height:200px;"><?php echo htmlspecialchars($p_desc); ?></textarea>
                    </div>
                    <div class="col-md-4 mb-3">
                        <input type="file" name="photo1" class="form-control">
                    </div>
                    <div class="col-md-4 mb-3">
                        <input type="file" name="photo2" class="form-control">
                    </div>
                    <div class="col-md-4 mb-3">
                        <input type="file" name="photo3" class="form-control">
                    </div>
                    <div class="col-md-12 text-center">
                        <button type="submit" name="Submit" class="btn btn-warning">Update Product</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
