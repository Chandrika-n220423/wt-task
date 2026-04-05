<?php
session_start();

require_once 'load_env.php';

// Fetch Google OAuth App credentials from environment
$client_id = $_ENV['GOOGLE_CLIENT_ID'];
$redirect_uri = 'http://localhost/php_cafe/wtlab3/google_callback.php';

$google_oauth_url = 'https://accounts.google.com/o/oauth2/v2/auth?' . http_build_query([
    'client_id' => $client_id,
    'redirect_uri' => $redirect_uri,
    'response_type' => 'code',
    'scope' => 'email profile',
    'access_type' => 'online',
    'prompt' => 'consent' // Forces consent screen
]);

header('Location: ' . $google_oauth_url);
exit();
?>
