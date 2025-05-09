<?php 
    // DB connection secttings
    $host = 'localhost';
    $db = 'user_registration';
    $user ='root';
    $pass = 'root';
    $charset = 'utf8mb4';

    $conn = mysqli_connect($host, $user, $pass, $db);

    // Check connection
    if ($conn === false) {
        die("ERROR: Could not connect. " . mysqli_connect_error());
    }
 
    // Collect POST data
    $username = trim($_POST['username'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $accountType = trim($_POST['accountType'] ?? '');
    $fullName = trim($_POST['fullName'] ?? '');
    $contact_title = trim($_POST['title'] ?? '');
    $phoneNumber = trim($_POST['phoneNumber'] ?? '');
    $password = $_POST['password'] ?? '';

    // Sanitize user input
    // Allow only "Individual" or "Company" for account type
    $accountType = ($accountType === 'Individual' || $accountType === 'Company') ? $accountType : 'Individual';

    // Trim and strip tags for username,full name, and title if not null
    $username = trim(strip_tags($username));
    $fullName = trim(strip_tags($fullName));
    $contact_title = ($accountType === 'Company' && isset($contact_title)) ? trim(strip_tags($contact_title)) : null;

    // Sanitize phone number
    $phoneNumber = preg_replace('[^\d+\-\s]', '', $phoneNumber);

    // Hash password for secure storage
    $passwordHash = password_hash($password, PASSWORD_DEFAULT);

    //Email Sanitization
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Invalid email format.");
    }

    // Prepare SQL statement
    $stmt = $conn->prepare("INSERT INTO users (account_type, username, password_hash, full_name, contact_title, phone_number, email) VALUES (?, ?, ?, ?, ?, ?, ?)");
    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }
    
    $stmt->bind_param("sssssss", $accountType, $username, $passwordHash, $fullName, $contact_title, $phoneNumber, $email);
    

    // Check if username or email already exists
    $checkStmt = $conn->prepare("SELECT id FROM users WHERE username = ? OR email = ?");
    $checkStmt->bind_param("ss", $username, $email);
    $checkStmt->execute();
    $checkStmt->store_result();

    if ($checkStmt->num_rows > 0) {
        // Username or email already exists
        header("Location: /index.php?status=exists");
        exit();
    }
    $checkStmt->close();

    // If not, insert new user
    $stmt = $conn->prepare("INSERT INTO users (account_type, username, password_hash, full_name, contact_title, phone_number, email) VALUES (?, ?, ?, ?, ?, ?, ?)");
    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }

    $stmt->bind_param("sssssss", $accountType, $username, $passwordHash, $fullName, $contact_title, $phoneNumber, $email);

    if ($stmt->execute()) {
        header("Location: /index.php?status=success");
        exit();
    } else {
        header("Location: /index.php?status=error");
        exit();
    }

    $stmt->close();
    $conn->close();
?>