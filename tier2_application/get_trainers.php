<?php
require_once 'db_config.php';


$trainer_count = 0;
$r = $conn->query("SELECT COUNT(*) AS total FROM trainers");
if ($r) {
    $trainer_count = $r->fetch_assoc()['total'];
}


$query = "SELECT
            trainer_id,
            name,
            specialization,
            phone,
            COALESCE(current_load, 0) AS current_load,
            (COALESCE(current_load, 0) >= 10) AS is_overloaded
          FROM trainers
          ORDER BY name ASC";

$trainers_result = $conn->query($query);

if (!$trainers_result) {
    // current_load column missing — fall back to basic query
    $query_basic = "SELECT trainer_id, name, specialization, phone, 0 AS current_load, 0 AS is_overloaded FROM trainers ORDER BY name ASC";
    $trainers_result = $conn->query($query_basic);
}
?>