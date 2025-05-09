<?php 
    // DB connection secttings
    $host = 'localhost';
    $db = 'registration_form';
    $user ='root';
    $pass = 'root';
    $charset = 'utf8mb4';

    $conn = mysqli_connect($host, $user, $pass, $db);

    // Check connection
    if ($conn === false) {
        die("ERROR: Could not connect. " . mysqli_connect_error());
    }
 
    // Collect POST data
    $accountType = $_POST['accountType'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $fullName = $_POST['fullName'];
    $title = $_POST['title'];
    $phoneNumber = $_POST['phoneNumber'];
    $email = $_POST['email'];

    // Sanitize user input
    // Allow only "Individual" or "Company" for account type
    $accountType = ($accountType === 'Individual' || $accountType === 'Company') ? $accountType : 'Individual';

    // Trim and strip tags for username,full name, and title if not null
    $username = trim(strip_tags($username));
    $fullName = trim(strip_tags($fullName));
    $title = ($accountType === 'Company' && isset($title)) ? trim(strip_tags($title)) : null;

    // Sanitize phone number
    $phoneNumber = preg_replace('[^\d+\-\s]', '', $phoneNumber);

    // Hash password for secure storage
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    //Email Sanitization
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Invalid email format.");
    }

    // Prepare SQL statement
    $stmt = $conn->prepare("INSERT INTO users (account_type, username, password, full_name, title, phone_number, email) VALUES (?, ?, ?, ?, ?, ?, ?)");
    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }
    
    $stmt->bind_param("sssssss", $accountType, $username, $hashedPassword, $fullName, $title, $phoneNumber, $email);
    

    // Execute and check 
    if ($stmt->execute()) {
        echo "Success";
    } else {
        echo $stmt->error;
    }

    $stmt->close();
    $conn->close();
?>