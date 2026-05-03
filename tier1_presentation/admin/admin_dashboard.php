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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Fitness Hub</title>
    <link rel="stylesheet" href="dashboard_style.css">
</head>
<body>

    <!-- Sidebar -->
    <aside class="sidebar">
        <div class="sidebar-brand">
            <div class="sidebar-brand-icon">
                <!-- Dumbbell -->
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#2c3e50" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M6 4v16M18 4v16"/><path d="M4 8h4M16 8h4M4 16h4M16 16h4"/><line x1="8" y1="12" x2="16" y2="12"/>
                </svg>
            </div>
            <span>Fitness Hub</span>
        </div>

        <nav class="sidebar-nav">
            <a href="admin_dashboard.php" class="nav-link active">
                <span class="nav-icon">
                    <!-- Grid / Dashboard -->
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/>
                    </svg>
                </span>
                Dashboard
            </a>
            <a href="../register.php" class="nav-link">
                <span class="nav-icon">
                    <!-- User Plus -->
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><line x1="19" y1="8" x2="19" y2="14"/><line x1="22" y1="11" x2="16" y2="11"/>
                    </svg>
                </span>
                Add Member
            </a>
            <a href="userdata.php" class="nav-link">
                <span class="nav-icon">
                    <!-- Users -->
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                    </svg>
                </span>
                View Members
            </a>
            <a href="#" class="nav-link">
                <span class="nav-icon">
                    <!-- Credit Card -->
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="1" y="4" width="22" height="16" rx="2"/><line x1="1" y1="10" x2="23" y2="10"/>
                    </svg>
                </span>
                Payments
            </a>
            <a href="#" class="nav-link">
                <span class="nav-icon">
                    <!-- Dumbbell -->
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M6 4v16M18 4v16"/><path d="M4 8h4M16 8h4M4 16h4M16 16h4"/><line x1="8" y1="12" x2="16" y2="12"/>
                    </svg>
                </span>
                Trainers
            </a>
            <a href="#" class="nav-link">
                <span class="nav-icon">
                    <!-- Bar Chart -->
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="18" y1="20" x2="18" y2="10"/><line x1="12" y1="20" x2="12" y2="4"/><line x1="6" y1="20" x2="6" y2="14"/>
                    </svg>
                </span>
                Reports
            </a>
        </nav>

        <div class="sidebar-footer">
            &copy; <?php echo date('Y'); ?> Fitness Hub
        </div>
    </aside>

    <!-- Main Content -->
    <div class="main-content">

        <!-- Top Bar -->
        <header class="topbar">
            <div class="topbar-title">
                <h1>Admin Dashboard</h1>
                <p>Manage your gym operations efficiently</p>
            </div>
            <div class="topbar-meta">
                <div class="topbar-date"><?php echo date('l, F j, Y'); ?></div>
                <div class="topbar-admin">Welcome, <strong>Admin</strong></div>
            </div>
        </header>

        <!-- Stats Cards -->
        <div class="stat-grid">

            <div class="stat-card">
                <div class="stat-icon">
                    <!-- Users -->
                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#e6a800" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                    </svg>
                </div>
                <div class="stat-info">
                    <div class="stat-value"><?php echo $total_members; ?></div>
                    <div class="stat-label">Total Members</div>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon">
                    <!-- Calendar -->
                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#e6a800" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/>
                    </svg>
                </div>
                <div class="stat-info">
                    <div class="stat-value"><?php echo $members_this_month; ?></div>
                    <div class="stat-label">New This Month</div>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon">
                    <!-- Dumbbell -->
                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#e6a800" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M6 4v16M18 4v16"/><path d="M4 8h4M16 8h4M4 16h4M16 16h4"/><line x1="8" y1="12" x2="16" y2="12"/>
                    </svg>
                </div>
                <div class="stat-info">
                    <div class="stat-value"><?php echo $trainer_count; ?></div>
                    <div class="stat-label">Trainers</div>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon">
                    <!-- Dollar Sign -->
                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#e6a800" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/>
                    </svg>
                </div>
                <div class="stat-info">
                    <div class="stat-value">Rs.<?php echo number_format($monthly_payment, 2); ?></div>
                    <div class="stat-label">Monthly Revenue</div>
                </div>
            </div>

        </div>

        <!-- Quick Actions -->
        <section class="quick-actions">
            <h2 class="section-title">Quick Actions</h2>
            <div class="action-buttons">
                <a href="../register.php" class="btn btn-add">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                    Add New Member
                </a>
                <a href="userdata.php" class="btn btn-view">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                    View Members List
                </a>
            </div>
        </section>

    </div>

</body>
</html>
