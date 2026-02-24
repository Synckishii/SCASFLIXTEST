<?php

// contact_process.php - Handles the SCASFLIX footer contact form

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // 1. Retrieve raw input
    $raw_name    = $_POST['contact_name']    ?? '';
    $raw_email   = $_POST['contact_email']   ?? '';
    $raw_subject = $_POST['contact_subject'] ?? '';
    $raw_message = $_POST['contact_message'] ?? '';

    // 2. Custom sanitization function (trim + stripslashes + htmlspecialchars)
    function sanitize_input($data) {
        $data = trim($data);            // Remove extra whitespace
        $data = stripslashes($data);    // Remove backslashes
        $data = htmlspecialchars($data); // Prevent XSS
        return $data;
    }

    // 3. Sanitize all inputs
    $clean_name    = sanitize_input($raw_name);
    $clean_email   = sanitize_input($raw_email);
    $clean_subject = sanitize_input($raw_subject);
    $clean_message = sanitize_input($raw_message);

    // 4. Validate: check for empty fields
    if (empty($clean_name) || empty($clean_email) || empty($clean_subject) || empty($clean_message)) {
        header("Location: index.php?contact=error&msg=All+fields+are+required.");
        exit();
    }

    // 5. Validate email format
    if (!filter_var($clean_email, FILTER_VALIDATE_EMAIL)) {
        header("Location: index.php?contact=error&msg=Invalid+email+format.");
        exit();
    }

    // 6. Validate name length (must be at least 2 characters)
    if (strlen($clean_name) < 2) {
        header("Location: index.php?contact=error&msg=Please+enter+a+valid+name.");
        exit();
    }

    // 7. Validate message length (must be at least 10 characters)
    if (strlen($clean_message) < 10) {
        header("Location: index.php?contact=error&msg=Message+must+be+at+least+10+characters.");
        exit();
    }

    // 8. All valid — redirect with success message
    // (In a real app, you would save to a database or send an email here)
    header("Location: index.php?contact=success");
    exit();

} else {
    // Prevent direct GET access
    header("Location: index.php");
    exit();
}
?>
