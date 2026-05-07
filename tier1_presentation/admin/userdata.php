<?php
require_once '../../tier2_application/get_members.php';

require_once '../../tier2_application/get_trainers.php'; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Members - Fitness Hub</title>
    <link rel="stylesheet" href="dashboard_style.css">
    <link rel="stylesheet" href="userdata_style.css">
    <style>
        
        .trainer-select { padding: 5px; border-radius: 4px; border: 1px solid #ddd; font-size: 12px; width: 130px; }
        .btn-assign-small { background: #007bff; color: white; border: none; padding: 5px 10px; border-radius: 4px; cursor: pointer; font-size: 11px; margin-top: 5px; }
        .btn-assign-small:hover { background: #0056b3; }
        .load-full { color: #dc3545; font-size: 10px; font-weight: bold; }
    </style>
</head>
<body>

    <?php $active_page = 'members'; include 'includes/sidebar.php'; ?>

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
                        <th>Assign Trainer</th> </tr>
                </thead>
                <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $plan = htmlspecialchars($row["type_name"]);
                        $member_id = $row["member_id"];
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
                        <td class="cell-id"><?php echo htmlspecialchars($member_id); ?></td>
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
                        
                        <td>
                            <form action="../../tier2_application/process_assignment.php" method="POST">
                                <input type="hidden" name="member_id" value="<?php echo $member_id; ?>">
                                <select name="trainer_id" class="trainer-select" required>
                                    <option value="">Select Trainer</option>
                                    <?php 
                                    
                                    $trainers_result->data_seek(0); 
                                    while($t = $trainers_result->fetch_assoc()): ?>
                                        <option value="<?php echo $t['trainer_id']; ?>" <?php echo ($t['is_overloaded'] ? 'disabled' : ''); ?>>
                                            <?php echo htmlspecialchars($t['name']); ?> 
                                            (<?php echo $t['current_load']; ?>/10)
                                        </option>
                                    <?php endwhile; ?>
                                </select>
                                <button type="submit" class="btn-assign-small">Assign</button>
                            </form>
                        </td>
                    </tr>
                <?php
                    }
                } else {
                    echo "<tr><td colspan='8' class='no-data'>No members found</td></tr>";
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

    <script src="includes/alerts.js"></script>
</body>
</html>