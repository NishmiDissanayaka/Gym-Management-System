<?php
require_once '../../tier2_application/db_config.php';

// Total members
$total_members = 0;
$r = $conn->query("SELECT COUNT(*) AS total FROM members");
if ($r) $total_members = $r->fetch_assoc()['total'];

// Members joined this month
$members_this_month = 0;
$r = $conn->query("SELECT COUNT(*) AS total FROM members
                   WHERE MONTH(join_date) = MONTH(CURRENT_DATE())
                   AND YEAR(join_date) = YEAR(CURRENT_DATE())");
if ($r) $members_this_month = $r->fetch_assoc()['total'];

// Trainer count
$trainer_count = 0;
$r = $conn->query("SELECT COUNT(*) AS total FROM trainers");
if ($r) $trainer_count = $r->fetch_assoc()['total'];

// Monthly payment total
$monthly_payment = 0;
$r = $conn->query("SELECT COALESCE(SUM(amount), 0) AS total FROM payments
                   WHERE MONTH(payment_date) = MONTH(CURRENT_DATE())
                   AND YEAR(payment_date) = YEAR(CURRENT_DATE())");
if ($r) $monthly_payment = $r->fetch_assoc()['total'];

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard - Gym Management System</title>
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="admin_style.css">
    <link rel="stylesheet" href="dashboard_style.css">
</head>
<body class="dashboard-page">

    <!-- Top Header -->
    <header class="dash-header">
        <div class="dash-brand">
            <div class="dash-brand-icon">&#127947;</div>
            <div>
                <div class="dash-brand-name">PowerFit Gym</div>
                <div class="dash-brand-tagline">Management System</div>
            </div>
        </div>
        <div class="dash-welcome">
            <div class="dash-welcome-text">Welcome, <span>Admin</span></div>
            <div class="dash-welcome-date"><?php echo date('l, F j, Y'); ?></div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="dash-main">

        <!-- Page Title -->
        <div class="dash-page-title">
            <h1>Dashboard</h1>
            <p>Overview of your gym at a glance</p>
        </div>

        <!-- Stats Cards -->
        <div class="dash-stats">

            <div class="stat-card">
                <div class="stat-icon">&#128101;</div>
                <div class="stat-body">
                    <div class="stat-value"><?php echo $total_members; ?></div>
                    <div class="stat-label">Total Members</div>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon">&#128197;</div>
                <div class="stat-body">
                    <div class="stat-value"><?php echo $members_this_month; ?></div>
                    <div class="stat-label">New This Month</div>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon">&#127947;</div>
                <div class="stat-body">
                    <div class="stat-value"><?php echo $trainer_count; ?></div>
                    <div class="stat-label">Trainers</div>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon">&#128176;</div>
                <div class="stat-body">
                    <div class="stat-value">Rs. <?php echo number_format($monthly_payment, 2); ?></div>
                    <div class="stat-label">Monthly Revenue</div>
                </div>
            </div>

        </div>

        <!-- Quick Action Cards -->
        <div class="dash-section-title">Quick Actions</div>
        <div class="dash-cards">

            <a href="userdata.php" class="dash-card">
                <div class="dash-card-icon">&#128101;</div>
                <div class="dash-card-body">
                    <div class="dash-card-title">View Members</div>
                    <div class="dash-card-desc">Browse all registered gym members</div>
                </div>
                <div class="dash-card-arrow">&#8594;</div>
            </a>

            <a href="../register.php" class="dash-card">
                <div class="dash-card-icon">&#10011;</div>
                <div class="dash-card-body">
                    <div class="dash-card-title">Add New Member</div>
                    <div class="dash-card-desc">Register a new gym member</div>
                </div>
                <div class="dash-card-arrow">&#8594;</div>
            </a>

        </div>

    </main>

    <!-- Footer -->
    <footer class="dash-footer">
        &copy; <?php echo date('Y'); ?> PowerFit Gym &mdash; All rights reserved
    </footer>

</body>
</html>
