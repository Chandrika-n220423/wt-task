<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['idToken'])) {
    $idToken = $_POST['idToken'];

    // In a real production application, you would use the Firebase Admin SDK for PHP (via Composer) 
    // to securely verify the token offline.
    // For this assignment (without Composer setup), we can hit the Google Identity Toolkit API directly
    
    require_once 'load_env.php';
    
    // Fetch Firebase Web API Key from environment
    $firebase_web_api_key = $_ENV['FIREBASE_WEB_API_KEY'];
    
    $verify_url = 'https://identitytoolkit.googleapis.com/v1/accounts:lookup?key=' . $firebase_web_api_key;
    $post_fields = json_encode(['idToken' => $idToken]);

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $verify_url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post_fields);
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
    // Important for local XAMPP without configured CA certificates
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); 
    $response = curl_exec($ch);
    curl_close($ch);

    $verification_result = json_decode($response, true);

    if (isset($verification_result['users']) && count($verification_result['users']) > 0) {
        $user_data = $verification_result['users'][0];
        
        $_SESSION['user_email'] = $user_data['email'];
        $_SESSION['oauth_provider'] = 'firebase';
        
        // Return to success page
        header('Location: success.php?action=login');
        exit();
    } else {
        echo "Firebase Backend Token Verification Failed.";
        if (isset($verification_result['error'])) {
            echo "<br>Error: " . $verification_result['error']['message'];
        }
    }
} else {
    echo "Invalid request.";
}
?>
