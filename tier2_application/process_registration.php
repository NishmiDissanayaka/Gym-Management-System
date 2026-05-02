<?php
require_once 'db_config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
    $full_name = $_POST['full_name'];
    $email     = $_POST['email'];
    $phone     = $_POST['phone'];
    $gender    = $_POST['gender'];
    $type_id   = $_POST['type_id'];
    $amount    = $_POST['amount'];

    
    if (empty($full_name) || empty($email) || empty($type_id)) {
        die("Error: Please fill all required fields.");
    }

    
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Error: Invalid email format.");
    }

    
    if (!preg_match('/^[0-9]{10}$/', $phone)) {
        die("Error: Phone number must be 10 digits.");
    }

    try {
        
        $sql = "CALL RegisterNewMember(?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssid", $full_name, $email, $phone, $gender, $type_id, $amount);

        if ($stmt->execute()) {
            
            header("Location: ../tier1_presentation/index.php?status=success");
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }
        $stmt->close();
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }

    $conn->close();
}
?>