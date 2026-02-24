<?php

// auth_process.php - Handles Sign In and Sign Up with JSON file storage

session_start();

// ─── Path to our "database" file ─────────────────────────────────────────────
define('USERS_FILE', __DIR__ . '/users.json');

// ─── Load users from JSON file ────────────────────────────────────────────────
function load_users() {
    if (!file_exists(USERS_FILE)) {
        return [];
    }
    $json = file_get_contents(USERS_FILE);
    return json_decode($json, true) ?? [];
}

// ─── Save users to JSON file ──────────────────────────────────────────────────
function save_users($users) {
    file_put_contents(USERS_FILE, json_encode($users, JSON_PRETTY_PRINT));
}

// ─── Sanitization Function ────────────────────────────────────────────────────
function sanitize_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// ─── Redirect Helper ──────────────────────────────────────────────────────────
function redirect($url) {
    header("Location: " . $url);
    exit();
}

// ─── Only accept POST ─────────────────────────────────────────────────────────
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    redirect("login.php");
}

$action = $_POST['action'] ?? '';

// =============================================================================
// SIGN UP
// =============================================================================
if ($action === 'signup') {

    $name     = sanitize_input($_POST['signup_name']     ?? '');
    $email    = sanitize_input($_POST['signup_email']    ?? '');
    $password = $_POST['signup_password'] ?? '';
    $confirm  = $_POST['signup_confirm']  ?? '';

    if (empty($name) || empty($email) || empty($password) || empty($confirm)) {
        redirect("login.php?tab=signup&msg_type=error&msg=All+fields+are+required.");
    }

    if (strlen($name) < 2) {
        redirect("login.php?tab=signup&msg_type=error&msg=Please+enter+a+valid+full+name.");
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        redirect("login.php?tab=signup&msg_type=error&msg=Invalid+email+format.");
    }

    if (strlen($password) < 8) {
        redirect("login.php?tab=signup&msg_type=error&msg=Password+must+be+at+least+8+characters.");
    }

    if ($password !== $confirm) {
        redirect("login.php?tab=signup&msg_type=error&msg=Passwords+do+not+match.");
    }

    if (!preg_match('/[A-Z]/', $password) || !preg_match('/[0-9]/', $password)) {
        redirect("login.php?tab=signup&msg_type=error&msg=Password+must+have+at+least+one+uppercase+letter+and+one+number.");
    }

    if (!isset($_POST['agree_terms'])) {
        redirect("login.php?tab=signup&msg_type=error&msg=You+must+agree+to+the+Terms+of+Use.");
    }

    // Check if email already exists
    $users = load_users();
    foreach ($users as $user) {
        if (strtolower($user['email']) === strtolower($email)) {
            redirect("login.php?tab=signup&msg_type=error&msg=An+account+with+that+email+already+exists.");
        }
    }

    // Hash password and save new user
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    $new_user = [
        'id'         => uniqid(),
        'name'       => $name,
        'email'      => strtolower($email),
        'password'   => $hashed_password,
        'created_at' => date('Y-m-d H:i:s')
    ];

    $users[] = $new_user;
    save_users($users);

    redirect("login.php?tab=signin&msg_type=success&msg=Account+created+for+" . urlencode($name) . ".+You+can+now+sign+in.");
}

// =============================================================================
// SIGN IN
// =============================================================================
elseif ($action === 'signin') {

    $email    = sanitize_input($_POST['signin_email']    ?? '');
    $password = $_POST['signin_password'] ?? '';

    if (empty($email) || empty($password)) {
        redirect("login.php?tab=signin&msg_type=error&msg=Email+and+password+are+required.");
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        redirect("login.php?tab=signin&msg_type=error&msg=Invalid+email+format.");
    }

    // Find user in JSON file
    $users = load_users();
    $found_user = null;

    foreach ($users as $user) {
        if (strtolower($user['email']) === strtolower($email)) {
            $found_user = $user;
            break;
        }
    }

    // Verify password with bcrypt
    if ($found_user === null || !password_verify($password, $found_user['password'])) {
        redirect("login.php?tab=signin&msg_type=error&msg=Incorrect+email+or+password.");
    }

    // Set session and redirect
    $_SESSION['user_id']    = $found_user['id'];
    $_SESSION['user_name']  = $found_user['name'];
    $_SESSION['user_email'] = $found_user['email'];

    redirect("index.php?login=success");
}

else {
    redirect("login.php");
}
?>
