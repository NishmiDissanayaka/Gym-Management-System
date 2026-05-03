<?php
// Database connection එක සම්බන්ධ කිරීම
require_once 'db_config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name    = $_POST['full_name'];
    $email   = $_POST['email'];
    $phone   = $_POST['phone'];
    $gender  = $_POST['gender'];
    $type_id = (int) $_POST['type_id'];
    $amount  = (float) $_POST['amount'];

    $conn->begin_transaction();

    try {
        // Insert member with gender and membership plan
        $stmt = $conn->prepare("INSERT INTO members (full_name, email, phone, gender, type_id) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssi", $name, $email, $phone, $gender, $type_id);
        $stmt->execute();
        $member_id = $conn->insert_id;
        $stmt->close();

        // Record initial payment
        $stmt = $conn->prepare("INSERT INTO payments (member_id, amount) VALUES (?, ?)");
        $stmt->bind_param("id", $member_id, $amount);
        $stmt->execute();
        $stmt->close();

        $conn->commit();
        echo "<script>alert('Member Registered Successfully!'); window.location.href='../tier1_presentation/admin/register.php';</script>";
    } catch (Exception $e) {
        $conn->rollback();
        echo "Error: " . $e->getMessage();
    }

    $conn->close();
}
