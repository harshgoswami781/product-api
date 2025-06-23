<?php
session_start();
session_destroy();
?>

<style type="text/css">
    body {
        background: linear-gradient(90deg, rgba(7, 174, 234, 1.000) 0.000%, rgba(43, 245, 152, 1.000) 100.000%);
    }
    :root {
  --border-width: 7px;
}

* {
  margin: 0;
  padding: 0;
}


.sec-loading {
  height: 70vh;
  width: 100vw;
  display: flex;
  align-items: center;
  justify-content: center;
}

.sec-loading .one {
  height: 80px;
  width: 80px;
  border: var(--border-width) solid white;
  transform: rotate(45deg);
  border-radius: 0 50% 50% 50%;
  position: relative;
  animation: move 0.5s linear infinite alternate-reverse;
}
.sec-loading .one::before {
  content: "";
  position: absolute;
  height: 55%;
  width: 55%;
  border-radius: 50%;
  border: var(--border-width) solid transparent;
  border-top-color: white;
  border-bottom-color: white;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  animation: rotate 1s linear infinite;
}

@keyframes rotate {
  to {
    transform: translate(-50%, -50%) rotate(360deg);
  }
}
@keyframes move {
  to {
    transform: translateY(15px) rotate(45deg);
  }
}

  </style>
  <body>
<!-- Admin Panel HTML Codes Will Be Written Here(Starts)-->
<div class="container-fluid">
    <div class="row" style="padding-top: 10%;">
        <div class="col-md-4"></div>
        <div class="col-md-4" style="text-align: center;"><img src="assets/img/logout2.png" height="250px"></div>
        <div class="col-md-4"></div>
    </div>
    <br><br>
            <div class="col-md-12" style="text-align: center; padding-top: 20px;">
                <span style="font-size: 18px; font-weight: 100;color: white;">Logged Out Successfully...<br>You will be redirected to the Home after 5 seconds</span>
            </div>

            <section class="col-md-12" style="text-align: center; padding-top: 10px;">

</section>
            
        
        <div class="col-md-4"></div>
    </div>
</div>
<meta http-equiv="refresh" content="5;url=index.php" />