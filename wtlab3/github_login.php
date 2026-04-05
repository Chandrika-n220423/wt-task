<?php
session_start();

require_once 'load_env.php';

// Fetch GitHub OAuth App credentials 
$client_id = $_ENV['GITHUB_CLIENT_ID'];
$redirect_uri = 'http://localhost/php_cafe/wtlab3/github_callback.php';

$github_oauth_url = 'https://github.com/login/oauth/authorize?' . http_build_query([
    'client_id' => $client_id,
    'redirect_uri' => $redirect_uri,
    'scope' => 'read:user user:email'
]);

header('Location: ' . $github_oauth_url);
exit();
?>
