<?php

include('../includes/sidebar.php'); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fitness Hub - Admin Dashboard</title>
  
    <link rel="stylesheet" href="dashboard_style.css"> 
</head>
<body>

    <div class="main-content">
        <header class="top-bar">
            <h1>Admin Dashboard</h1>
            <p>Fitness Hub Management System</p>
        </header>

        <div class="dashboard-cards">
          
            <div class="card">
                <div class="card-icon">👥</div>
                <h3>Total Members</h3>
                <p>12</p>
            </div>
           
                <div class="card-icon">💰</div>
                <h3>Monthly Revenue</h3>
                <p>LKR 25,000</p>
            </div>
        </div>

        <div class="action-buttons">
            <h2>Quick Actions</h2>
            <a href="register.php" class="btn btn-add">Add New Member</a>
            <a href="view_members.php" class="btn btn-view">View Members List</a>
        </div>
    </div>

</body>
</html>