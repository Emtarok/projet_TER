<?php
require_once __DIR__ . '/../config/database.php';

function get_data() {
    $conn = db_connect();
    $sql = "SELECT * FROM faits";
    $result = mysqli_query($conn, $sql);

    $data = [];
    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }
    }

    mysqli_close($conn);
    return $data;
}
?>
