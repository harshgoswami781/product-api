<?php
$page_name = $_GET['page']?? '';

if ($page_name == 'Register') {
        include 'inc/header.php';
    include 'inc/register-body.php';
    include 'inc/footer.php';
} else if ($page_name == 'Thankyou') {
        include 'inc/header.php';
    include 'inc/thankyou-body.php';
    include 'inc/footer.php';
} else if ($page_name == 'ForgotPassword') {
        include 'inc/header.php';
    include 'inc/forgot-password-body.php';
    include 'inc/footer.php';
} else if ($page_name == 'Logout') {
        include 'inc/header.php';
    include 'inc/logout-body.php';
    include 'inc/footer.php';
} else if ($page_name == 'Authenticate') {
        include 'inc/header.php';
    include 'inc/authenticate-body.php';
    include 'inc/footer.php';
} else if ($page_name == 'Dashboard') {
        include 'inc/header-1.php';
        include 'inc/nav-bar.php';
    include 'inc/dashboard-body.php';
    include 'inc/footer-1.php';
} 
else if ($page_name == 'Products') {
        include 'inc/header-1.php';
        include 'inc/nav-bar.php';
    include 'inc/products-body.php';
    include 'inc/footer-1.php';
} 
 else if ($page_name == 'Orders') {
        include 'inc/header-1.php';
        include 'inc/nav-bar.php';
    include 'inc/orders-body.php';
    include 'inc/footer-1.php';
} else {
    include 'inc/header.php';
    include 'inc/login-body.php';
    include 'inc/footer.php';

}

?>
