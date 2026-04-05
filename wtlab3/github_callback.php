<?php
session_start();

require_once 'load_env.php';

// Fetch GitHub OAuth App credentials
$client_id = $_ENV['GITHUB_CLIENT_ID'];
$client_secret = $_ENV['GITHUB_CLIENT_SECRET'];
$redirect_uri = 'http://localhost/php_cafe/wtlab3/github_callback.php';

if (isset($_GET['code'])) {
    $code = $_GET['code'];

    // 1. Exchange code for access token using cURL
    $token_url = 'https://github.com/login/oauth/access_token';
    $post_fields = [
        'client_id' => $client_id,
        'client_secret' => $client_secret,
        'code' => $code,
        'redirect_uri' => $redirect_uri
    ];

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $token_url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post_fields));
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Accept: application/json']);
    // Important for local XAMPP without configured CA certificates
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); 
    $response = curl_exec($ch);
    curl_close($ch);

    $token_data = json_decode($response, true);

    if (isset($token_data['access_token'])) {
        $access_token = $token_data['access_token'];

        // 2. Fetch user profile
        $profile_url = 'https://api.github.com/user';
        $ch2 = curl_init();
        curl_setopt($ch2, CURLOPT_URL, $profile_url);
        curl_setopt($ch2, CURLOPT_RETURNTRANSFER, true);
        // GitHub API requires a User-Agent header
        curl_setopt($ch2, CURLOPT_HTTPHEADER, [
            'Authorization: Bearer ' . $access_token,
            'User-Agent: PHP-OAuth-Integration-Assignment'
        ]);
        curl_setopt($ch2, CURLOPT_SSL_VERIFYPEER, false);
        $profile_response = curl_exec($ch2);
        curl_close($ch2);

        $profile_data = json_decode($profile_response, true);

        // Store info in session 
        // GitHub user might not have a public email, or it might be located at /user/emails endpoint.
        // For simplicity, we just use login username if email is missing.
        $_SESSION['user_email'] = isset($profile_data['email']) ? $profile_data['email'] : $profile_data['login'];
        $_SESSION['user_name'] = isset($profile_data['name']) ? $profile_data['name'] : $profile_data['login'];
        $_SESSION['oauth_provider'] = 'github';

        // Redirect to success
        header('Location: success.php?action=login');
        exit();
    } else {
        echo "Failed to get access token from GitHub.";
        if (isset($token_data['error_description'])) echo "<br>Error: " . $token_data['error_description'];
        exit();
    }
} else {
    echo "No authorization code provided.";
    exit();
}
?>
