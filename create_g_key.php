<?php
session_start();
require_once('assets/config.php');
require_once 'assets/GoogleAuthenticator.php';

$user = new UserLib(SQL_HOST, SQL_USER, SQL_PASS, SQL_DB, "users", $uid, "start");
$user->connect();
$uid = 'nosession';


if(isset($_POST['username'])) {
    $username = $_POST['username'];
    $userinfo = mysqli_query($sql, "SELECT * FROM users WHERE name = '" . $username . "'");
    $row = mysqli_fetch_array($userinfo);
    $rankist = $row['rank'];
    $userid = $row['id'];

    $ga = new PHPGangsta_GoogleAuthenticator();
    $secret = $ga->createSecret();
    mysqli_query($sql, "UPDATE users SET g_key='$secret' WHERE id=$userid");
    $qrCodeUrl = $ga->getQRCodeGoogleUrl('Loginscript', $secret);
    echo "<center><h2>".$qrCodeUrl."</h2></center>";
}

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <title>Loginscript</title>
    <meta name="apple-mobile-web-app-capable apple-touch-fullscreen" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="default">
    <link rel="shortcut icon" type="image/png" href=https://avatars1.githubusercontent.com/u/30456028?s=460&v=4">
    <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Source+Sans+Pro:300,300i,400,400i,600,600i,700,700i">
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>*,*:before,*:after{box-sizing:inherit;}html{position:relative;min-height:100vh;font-family:"Source Sans Pro",sans-serif;font-size:100%;font-size:16px;font-weight:400;-moz-font-size-adjust:100%;font-size-adjust:100%;-webkit-text-size-adjust:100%;-ms-text-size-adjust:100%;text-size-adjust:100%;font-kerning:normal;font-variant:none;-webkit-font-smoothing:antialiased;-moz-osx-font-smoothing:grayscale;-webkit-tap-highlight-color:transparent;box-sizing:border-box;}body{margin:0;color:#fff;background-image:url(https://www.warnerbros.co.uk/~/media/images/warner%20bro/movies/the%20intern/robert%20de%20niro.ashx);background-size:cover;background-position:50%;background-repeat:no-repeat;background-attachment:fixed;}strong,b{font-weight:700;}*:focus{outline:none;}body:before{content:"";position:absolute;top:0;right:0;bottom:0;left:0;background-image:linear-gradient(180deg,#246bad 0%,#00c8c8 100%);opacity:.8;z-index:-1;animation:colorSlide 1.5s ease-out;}@keyframes colorSlide{0%{background-size:200%}100%{background-size:100%}}header .brand{background-color:#fff;position:absolute;top:0;left:0;border-radius:0px 0px 100% 0px;}header .brand:before{content:"";position:absolute;top:0;right:-35px;bottom:-35px;left:0;border:1px solid #80c2d7;border-top:none;border-left:none;border-radius:0px 0px 100% 0px;z-index:-1;}header .brand .logo{display:block;text-decoration:inherit;color:inherit;padding:25px 50px 50px 25px;border-radius:0px 0px 100% 0px;}main{margin-top:200px;}main .form-wrap{position:absolute;top:50%;left:22.5%;transform:translate(-50%,-50%);padding:20px 0 20px 25px;border-left:2px solid #80c2d7;animation:slideIn .5s ease-in-out;}@keyframes slideIn{0%{opacity:0;left:-300px;}100%{opacity:1;left:100;}}main .form-wrap h1{font-size:26px;font-weight:400;margin:0 0 50px 0;padding:0;line-height:1;}main .form-wrap .alert{position:absolute;bottom:105%;left:0;white-space:nowrap;padding:12px;background-color:#d92653;line-height:1;border-radius:20px;}main .input-wrap{margin-bottom:20px;}main .input-wrap input{display:block;font:inherit;color:inherit;padding:10px;border:1px solid #80c2d7;border-left:none;background-color:transparent;width:215px;font-weight:300;transition:.125s ease-in-out;}main .input-wrap input:focus{outline:none;border:1px solid #80c2d7;border-left:none;background-color:rgba(255,255,255,.16);font-weight:400;}main .input-wrap input::-webkit-input-placeholder{color:rgba(255,255,255,.8);}main .input-wrap input::-moz-placeholder{color:rgba(255,255,255,.8);}main .input-wrap input:-ms-input-placeholder{color:rgba(255,255,255,.8);}main .input-wrap input:-moz-placeholder{color:rgba(255,255,255,.8);}main .input-wrap i{background-color:#fff;width:42px;line-height:42px;font-size:18px;text-align:center;color:#246bad;float:left;}main .form-wrap form button{background-color:#fff;border:1px solid transparent;width:50%;margin:20px auto 0;font:inherit;font-weight:600;color:#23272c;padding:12px 0;border-radius:25px;display:block;cursor:pointer;transition:.125s ease-in-out;}main .form-wrap form button:hover,main .form-wrap form button:active{color:#fff;background-color:rgba(255,255,255,.16);border-color:#80c2d7;}main .form-wrap form button:focus{}main .form-wrap .form-link{display:block;font-size:18px;margin-top:40px;color:inherit;text-decoration:none;text-align:center;}main .form-wrap .form-link:hover,main .form-wrap .form-link:active{text-decoration:underline;}main .form-wrap .form-link>i{margin-right:.5em;font-weight:700;}.g-recaptcha{transform:scale(0.8543);transform-origin:0 0;max-width:257px;}@media (max-width: 768px) {main .form-wrap{top:55%;}}@media (max-width: 425px) {main .form-wrap{left:auto;width:100%;padding-right:25px;transform:translate(0,-50%);border-left:none;animation:none;}main .input-wrap input{width:calc(100% - 42px);}.g-recaptcha{transform:none;max-width:none;}.g-recaptcha>div{margin:0 auto;}}</style>
</head>
<body>
<main>
    <div class="form-wrap">
        <form method="post">
            <div class="input-wrap">
                <i class="fa fa-user" aria-hidden="true"></i>
                <input name="username" type="name" placeholder="Name from Database" required spellcheck="false" autofocus>
            </div>
            <button name="login" type="submit">Create Key</button>
        </form>
    </div>
</main>
</body>
</html>