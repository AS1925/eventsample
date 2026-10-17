<?php
session_start();
include("../includes/access_control.php");
require_role("admin");
include("../includes/db.php");

if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST['id']) || !ctype_digit($_POST['id'])) {
    header("Location: view_events.php");
    exit();
}

$id = (int)$_POST['id'];
$image_query = $conn->prepare("SELECT image FROM events WHERE id = ?");
$image_query->bind_param("i", $id);
$image_query->execute();
$event = $image_query->get_result()->fetch_assoc();

if ($event) {
    $conn->begin_transaction();
    $delete_registrations = $conn->prepare("DELETE FROM registrations WHERE event_id = ?");
    $delete_registrations->bind_param("i", $id);
    $registrations_deleted = $delete_registrations->execute();

    $delete_reviews = $conn->prepare("DELETE FROM event_reviews WHERE event_id = ?");
    $delete_reviews->bind_param("i", $id);
    $reviews_deleted = $delete_reviews->execute();

    $delete_event = $conn->prepare("DELETE FROM events WHERE id = ?");
    $delete_event->bind_param("i", $id);
    if ($registrations_deleted && $reviews_deleted && $delete_event->execute()) {
        $conn->commit();
        if ($event['image'] !== "" && is_file("../events/" . $event['image'])) {
            unlink("../events/" . $event['image']);
        }
    } else {
        $conn->rollback();
    }
}

header("Location: view_events.php");
exit();
?>