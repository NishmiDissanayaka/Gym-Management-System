<?php
// Database connection එක සම්බන්ධ කිරීම
require_once 'db_config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Form එකෙන් එන දත්ත ලබා ගැනීම
    $name = $_POST['full_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $amount = $_POST['amount'];

    // Tier 3 හි ඇති Stored Procedure එක (AddNewMember) කැඳවීම
    // මෙය SQL Injection වලින් ආරක්ෂා වීමට හොඳම ක්‍රමයකි
    $stmt = $conn->prepare("CALL AddNewMember(?, ?, ?, ?)");
    $stmt->bind_param("sssd", $name, $email, $phone, $amount);

    if ($stmt->execute()) {
        echo "<script>alert('Member Registered Successfully!'); window.location.href='../tier1_presentation/register.php';</script>";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
