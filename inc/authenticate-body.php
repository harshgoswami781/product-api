<?php
echo '<style type="text/css">';
echo 'body {';
echo 'background: linear-gradient(90deg, rgba(7, 174, 234, 1.000) 0.000%, rgba(43, 245, 152, 1.000) 100.000%);';
echo '}';
echo ':root {';
echo '--border-width: 7px;';
echo '}';
echo '';
echo '* {';
echo 'margin: 0;';
echo 'padding: 0;';
echo '}';
echo '';
echo '';
echo '.sec-loading {';
echo 'height: 70vh;';
echo 'width: 100vw;';
echo 'display: flex;';
echo 'align-items: center;';
echo 'justify-content: center;';
echo '}';
echo '';
echo '.sec-loading .one {';
echo 'height: 80px;';
echo 'width: 80px;';
echo 'border: var(--border-width) solid white;';
echo 'transform: rotate(45deg);';
echo 'border-radius: 0 50% 50% 50%;';
echo 'position: relative;';
echo 'animation: move 0.5s linear infinite alternate-reverse;';
echo '}';
echo '.sec-loading .one::before {';
echo 'content: "";';
echo 'position: absolute;';
echo 'height: 55%;';
echo 'width: 55%;';
echo 'border-radius: 50%;';
echo 'border: var(--border-width) solid transparent;';
echo 'border-top-color: white;';
echo 'border-bottom-color: white;';
echo 'top: 50%;';
echo 'left: 50%;';
echo 'transform: translate(-50%, -50%);';
echo 'animation: rotate 1s linear infinite;';
echo '}';
echo '';
echo '@keyframes rotate {';
echo 'to {';
echo 'transform: translate(-50%, -50%) rotate(360deg);';
echo '}';
echo '}';
echo '@keyframes move {';
echo 'to {';
echo 'transform: translateY(15px) rotate(45deg);';
echo '}';
echo '}';
echo '';
echo '</style>';
echo '<body>';
echo '<!-- Admin Panel HTML Codes Will Be Written Here(Starts)-->';
echo '<div class="container-fluid">';
echo '<div class="row" style="padding-top: 10%;">';
echo '<div class="col-md-4"></div>';
echo '';
echo '<section class="sec-loading">';
echo '<div class="one">';
echo '</div>';
echo '</section>';
echo '';
echo '<div class="col-md-12" style="text-align: center; padding-top: 20px;">';
echo '<span style="font-size: 18px; font-weight: 100;color: white;">Please Wait, We Are Authenticating Your Account...</span>';
echo '</div>';
echo '';
echo '<section class="col-md-12" style="text-align: center; padding-top: 10px;">';
echo '';
echo '</section>';
echo '';
echo '';
echo '<div class="col-md-4"></div>';
echo '</div>';
echo '</div>';
echo '';
echo '<meta http-equiv="refresh" content="2;url=index.php?page=Dashboard" />';
?>