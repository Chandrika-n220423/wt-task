<?php
session_start();

require_once 'load_env.php';

// Fetch Google OAuth App credentials from environment
$client_id = $_ENV['GOOGLE_CLIENT_ID'];
$client_secret = $_ENV['GOOGLE_CLIENT_SECRET'];
$redirect_uri = 'http://localhost/php_cafe/wtlab3/google_callback.php';

if (isset($_GET['code'])) {
    $code = $_GET['code'];

    // 1. Exchange code for access token using cURL
    $token_url = 'https://oauth2.googleapis.com/token';
    $post_fields = [
        'code' => $code,
        'client_id' => $client_id,
        'client_secret' => $client_secret,
        'redirect_uri' => $redirect_uri,
        'grant_type' => 'authorization_code'
    ];

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $token_url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post_fields));
    // Important for local XAMPP without configured CA certificates
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); 
    $response = curl_exec($ch);
    curl_close($ch);

    $token_data = json_decode($response, true);

    if (isset($token_data['access_token'])) {
        $access_token = $token_data['access_token'];

        // 2. Fetch user profile
        $profile_url = 'https://www.googleapis.com/oauth2/v2/userinfo';
        $ch2 = curl_init();
        curl_setopt($ch2, CURLOPT_URL, $profile_url);
        curl_setopt($ch2, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch2, CURLOPT_HTTPHEADER, ['Authorization: Bearer ' . $access_token]);
        curl_setopt($ch2, CURLOPT_SSL_VERIFYPEER, false);
        $profile_response = curl_exec($ch2);
        curl_close($ch2);

        $profile_data = json_decode($profile_response, true);

        // Store info in session 
        $_SESSION['user_email'] = $profile_data['email'];
        $_SESSION['user_name'] = $profile_data['name'];
        $_SESSION['oauth_provider'] = 'google';

        // Redirect to success
        header('Location: success.php?action=login');
        exit();
    } else {
        echo "Failed to get access token from Google.";
        if (isset($token_data['error'])) echo "<br>Error: " . $token_data['error'];
        exit();
    }
} else {
    echo "No authorization code provided.";
    exit();
}
?>
