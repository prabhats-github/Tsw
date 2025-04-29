<?php
// Include PHPMailer files
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

// Import PHPMailer classes into the global namespace
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Collect form data
    $name = $_POST['Customer-name'] ?? '';
    $email = $_POST['Customer-email'] ?? '';
    $phone = $_POST['Customer-phone'] ?? '';
    $members = $_POST['Total-members'] ?? '';
    $message = $_POST['Customer-message'] ?? '';
    $terms = isset($_POST['terms']) ? 'Yes' : 'No';
    $contactConsent = isset($_POST['contactConsent']) ? 'Yes' : 'No';
    
    // Basic validation
    if (empty($name) || empty($email) || empty($phone) || empty($members) || empty(message)){
        echo "All fields are required. Please fill in all the details.";
        exit;
    }
    
   
    
    // Check if terms are accepted
    if (!isset($_POST['terms'])) {
        echo "You must agree to the Terms & Conditions.";
        exit;
    }

    // For testing in local WAMP environment:
    // Just record that the form was submitted successfully
    $log_file = 'form_submissions.txt';
    $submission_data = "Date: " . date('Y-m-d H:i:s') . "\n";
    $submission_data .= "contact-name: $name\n";
    $submission_data .= "contact-email: $email\n";
    $submission_data .= "contact-phone: $phone\n";
    $submission_data .= "contact-members: $members\n";
    $submission_data .= "contact-message: $message\n";
    
    // Write to log file
    file_put_contents($log_file, $submission_data, FILE_APPEND);
    
    // Show success message
    echo "<script>
        alert('Thank you for your submission! We will contact you soon.');
        window.location.href = 'contact-us.php';
    </script>";
}
?>