<?php
require_once '../../tier2_application/get_members.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Members - Fitness Hub</title>
    <link rel="stylesheet" href="dashboard_style.css">
    <style>
        /* ── Members Page overrides ───────────────────── */
        body { background: #f0f2f5; }

        .page-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 28px;
        }

        .page-header h1 { font-size: 1.9rem; font-weight: 800; color: #2c3e50; }
        .page-header p  { font-size: 0.88rem; color: #7f8c8d; margin-top: 4px; }

        .members-count-badge {
            background: #ffcc00;
            color: #2c3e50;
            font-weight: 700;
            font-size: 0.85rem;
            padding: 8px 18px;
            border-radius: 999px;
        }

        /* Table card */
        .table-card {
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.07);
            overflow: hidden;
            margin-bottom: 24px;
        }

        .member-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 0.9rem;
        }

        .member-table thead tr {
            background: #2c3e50;
            color: #ffcc00;
        }

        .member-table thead th {
            padding: 14px 18px;
            text-align: left;
            font-weight: 700;
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .member-table tbody tr {
            border-bottom: 1px solid #f0f2f5;
            transition: background 0.15s;
        }

        .member-table tbody tr:hover { background: #fffbea; }

        .member-table td {
            padding: 13px 18px;
            color: #2c3e50;
            vertical-align: middle;
        }

        .cell-id    { color: #95a5a6; font-size: 0.82rem; }
        .cell-name  { font-weight: 600; }
        .cell-email { color: #7f8c8d; font-size: 0.87rem; }
        .cell-date  { color: #95a5a6; font-size: 0.85rem; }

        /* Gender tags */
        .gender-tag {
            display: inline-block;
            padding: 3px 10px;
            border-radius: 999px;
            font-size: 0.76rem;
            font-weight: 600;
        }
        .gender-male   { background: #ebf5fb; color: #2980b9; }
        .gender-female { background: #fdf2f8; color: #c0392b; }

        /* Plan badges */
        .plan-badge {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 999px;
            font-size: 0.76rem;
            font-weight: 700;
        }
        .plan-gold    { background: #fff8e1; color: #e6a800; border: 1px solid #ffe082; }
        .plan-silver  { background: #f4f6f7; color: #7f8c8d; border: 1px solid #d5d8dc; }
        .plan-basic   { background: #fdf5e6; color: #ca8a04; border: 1px solid #fcd34d; }
        .plan-default { background: #f0fdf4; color: #16a34a; border: 1px solid #86efac; }

        .no-data {
            text-align: center;
            padding: 48px !important;
            color: #95a5a6;
            font-style: italic;
        }

        /* Back button */
        .btn-back {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 20px;
            border: 2px solid #2c3e50;
            color: #2c3e50;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            font-size: 0.88rem;
            transition: background 0.2s, color 0.2s;
        }
        .btn-back:hover { background: #2c3e50; color: #ffcc00; }
    </style>
</head>
<body>

    <?php $active_page = 'members'; include 'includes/sidebar.php'; ?>

    <!-- Main Content -->
    <div class="main-content">

        <div class="page-header">
            <div>
                <h1>Registered Members</h1>
                <p>All active gym members at a glance</p>
            </div>
            <?php $total = $result->num_rows; ?>
            <div class="members-count-badge"><?php echo $total; ?> Members</div>
        </div>

        <div class="table-card">
            <table class="member-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Full Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Gender</th>
                        <th>Membership Plan</th>
                        <th>Join Date</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $plan = htmlspecialchars($row["type_name"]);
                        $planClass = 'plan-default';
                        if (stripos($plan, 'gold') !== false || stripos($plan, 'premium') !== false) {
                            $planClass = 'plan-gold';
                        } elseif (stripos($plan, 'silver') !== false || stripos($plan, 'standard') !== false) {
                            $planClass = 'plan-silver';
                        } elseif (stripos($plan, 'basic') !== false || stripos($plan, 'bronze') !== false) {
                            $planClass = 'plan-basic';
                        }
                ?>
                    <tr>
                        <td class="cell-id"><?php echo htmlspecialchars($row["member_id"]); ?></td>
                        <td class="cell-name"><?php echo htmlspecialchars($row["full_name"]); ?></td>
                        <td class="cell-email"><?php echo htmlspecialchars($row["email"]); ?></td>
                        <td><?php echo htmlspecialchars($row["phone"]); ?></td>
                        <td>
                            <span class="gender-tag gender-<?php echo strtolower(htmlspecialchars($row['gender'])); ?>">
                                <?php echo htmlspecialchars($row["gender"]); ?>
                            </span>
                        </td>
                        <td><span class="plan-badge <?php echo $planClass; ?>"><?php echo $plan; ?></span></td>
                        <td class="cell-date"><?php echo htmlspecialchars($row["join_date"]); ?></td>
                    </tr>
                <?php
                    }
                } else {
                    echo "<tr><td colspan='7' class='no-data'>No members found</td></tr>";
                }
                ?>
                </tbody>
            </table>
        </div>

        <a href="admin_dashboard.php" class="btn-back">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/></svg>
            Back to Dashboard
        </a>

    </div>

</body>
</html>
