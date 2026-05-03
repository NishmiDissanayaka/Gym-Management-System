<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gym Management System - Home</title>
    <link rel="stylesheet" href="style.css">
    <style>
        
        body { font-family: 'Segoe UI', sans-serif; margin: 0; display: flex; background: #f4f4f4; }
        .sidebar { width: 260px; height: 100vh; background: #2c3e50; color: white; padding: 20px; position: fixed; }
        .sidebar h2 { color: #ffcc00; text-align: center; font-size: 22px; margin-bottom: 30px; }
        .sidebar a { display: block; color: white; padding: 15px; text-decoration: none; margin-bottom: 10px; border-radius: 8px; transition: 0.3s; }
        .sidebar a:hover { background: #34495e; color: #ffcc00; }
        .main-content { margin-left: 280px; padding: 40px; width: 100%; }
        .dashboard-cards { display: flex; gap: 20px; margin-top: 30px; }
        .card { background: white; padding: 25px; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); flex: 1; text-align: center; border-bottom: 4px solid #ffcc00; }
        .card h3 { color: #7f8c8d; margin-bottom: 10px; }
        .card p { font-size: 28px; font-weight: bold; color: #2c3e50; margin: 0; }
        .action-buttons { margin-top: 40px; }
        .btn { padding: 15px 25px; border: none; border-radius: 8px; color: white; text-decoration: none; font-weight: bold; display: inline-block; margin-right: 15px; cursor: pointer; }
        .btn-add { background: #27ae60; } /* Add New Member */
        .btn-view { background: #2980b9; } /* View List */
    </style>
</head>
<body>

    <!-- Sidebar Menu -->
    <div class="sidebar">
        <h2>GYM MASTER</h2>
        <a href="index.php" style="background: #34495e; color: #ffcc00;">Dashboard</a>
        <a href="register.php">Add Member</a>
        <a href="view_members.php">View Members</a>
        <a href="payments.php">Payments</a>
        <a href="view_reports.php">System Reports</a>
    </div>

    <!-- Main Content Area -->
    <div class="main-content">
        <header>
            <h1 style="color: #2c3e50;">Admin Dashboard</h1>
            <p style="color: #7f8c8d;">Manage your gym operations efficiently</p>
        </header>

   
        <div class="dashboard-cards">
            <div class="card">
                <h3>Total Members</h3>
                <p>12</p>
            </div>
            <div class="card">
                <h3>New Admissions</h3>
                <p>03</p>
            </div>
            <div class="card">
                <h3>Monthly Revenue</h3>
                <p>LKR 25,000</p>
            </div>
        </div>

       
        <div class="action-buttons">
            <h2 style="color: #2c3e50; font-size: 20px;">Quick Actions</h2>
            <a href="register.php" class="btn btn-add">Add New Member</a>
            <a href="view_members.php" class="btn btn-view">View Members List</a>
        </div>
    </div>

</body>
</html>