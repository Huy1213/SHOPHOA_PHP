<?php
require_once "google-api/vendor/autoload.php";
$gClient = new Google_Client();
$gClient->setClientId("741178376328-e2spkd02l8adi2f41b20b4am9j53fkhj.apps.googleusercontent.com");
$gClient->setClientSecret("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");
$gClient->setApplicationName("Vicode Media Login");
$gClient->setRedirectUri("http://localhost/QL_SHOPHOA/controller/controller.php");
$gClient->addScope("https://www.googleapis.com/auth/plus.login https://www.googleapis.com/auth/userinfo.email");
// login URL
$login_url = $gClient->createAuthUrl();
?>