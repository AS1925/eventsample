<?php

session_start();
include("../includes/access_control.php");
require_role("user");
include("../includes/db.php");
$user_id = $_SESSION['user_id'];
if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST['id']) || !ctype_digit($_POST['id'])) {
    header("Location: my_events.php");
    exit();
}

$registration_id = (int)$_POST['id'];
$statement = $conn->prepare("DELETE FROM registrations WHERE id = ? AND user_id = ?");
$statement->bind_param("ii", $registration_id, $user_id);
$statement->execute();
header("Location: my_events.php");
exit();

?>