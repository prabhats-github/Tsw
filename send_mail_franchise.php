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
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $phone = $_POST['phone'] ?? '';
    $Companyname = $_POST['companyName'] ?? '';
    $investment = $_POST['investment'] ?? '';
    $experience = $_POST['experience'] ?? '';
    $location = $_POST['location'] ?? '';
    $terms = isset($_POST['terms']) ? 'Yes' : 'No';
    $contactConsent = isset($_POST['contactConsent']) ? 'Yes' : 'No';
    
    // Basic validation
    if (empty($name) || empty($email) || empty($phone) || empty($companyName) || empty($investment) || empty($experience) || empty($location)){
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
    $submission_data .= "name: $name\n";
    $submission_data .= "email: $email\n";
    $submission_data .= "phone: $phone\n";
    $submission_data .= "companyName: $companyName\n";
    $submission_data .= "investment: $investment\n";
    $submission_data .= "experience: $experience\n";
    $submission_data .= "location: $location\n";
    
    // Write to log file
    file_put_contents($log_file, $submission_data, FILE_APPEND);
    
    // Show success message
    echo "<script>
        alert('Thank you for your submission! We will contact you soon.');
        window.location.href = 'franchise-form.php';
    </script>";
}
?>