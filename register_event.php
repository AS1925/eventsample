<?php
session_start();
include("includes/db.php");

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
$role = $_SESSION['role'] ?? "";
if ($role !== 'user') {
    header("Location: " . ($role === 'admin' ? "admin/dashboard.php" : "login.php"));
    exit();
}

if (!isset($_GET['id']) || !is_string($_GET['id']) || !ctype_digit($_GET['id'])) {
    header("Location: events.php");
    exit();
}

$user_id = (int)$_SESSION['user_id'];
$event_id = (int)$_GET['id'];
$event_statement = $conn->prepare("SELECT * FROM events WHERE id = ? AND event_date >= CURDATE()");
$event_statement->bind_param("i", $event_id);
$event_statement->execute();
$event = $event_statement->get_result()->fetch_assoc();
if (!$event) {
    header("Location: events.php");
    exit();
}

$message = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $conn->begin_transaction();

    $locked_event = $conn->prepare("SELECT max_participants, event_date FROM events WHERE id = ? FOR UPDATE");
    $locked_event->bind_param("i", $event_id);
    $locked_event->execute();
    $capacity = $locked_event->get_result()->fetch_assoc();

    $existing = $conn->prepare("SELECT id FROM registrations WHERE user_id = ? AND event_id = ? LIMIT 1");
    $existing->bind_param("ii", $user_id, $event_id);
    $existing->execute();
    $already_registered = $existing->get_result()->num_rows > 0;

    $count = $conn->prepare("SELECT COUNT(*) AS total FROM registrations WHERE event_id = ?");
    $count->bind_param("i", $event_id);
    $count->execute();
    $registered = (int)$count->get_result()->fetch_assoc()['total'];

    if (!$capacity || $capacity['event_date'] < date('Y-m-d')) {
        $message = "This event is no longer available for registration.";
    } elseif ($already_registered) {
        $message = "You are already registered for this event.";
    } elseif ($registered >= (int)$capacity['max_participants']) {
        $message = "This event is full and registration is closed.";
    } else {
        $insert = $conn->prepare("INSERT INTO registrations (user_id, event_id) VALUES (?, ?)");
        $insert->bind_param("ii", $user_id, $event_id);
        if ($insert->execute()) {
            $conn->commit();
            header("Location: user/my_events.php?registered=1");
            exit();
        }
        $message = "Registration could not be completed. Please try again.";
    }

    $conn->rollback();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirm Registration - EventEase</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="icon" href="events/logo.png" type="image/png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
</head>
<body>
    <?php include 'includes/navbar.php'; ?>
    <section class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-xl-7">
                <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                    <?php if ($event['image'] !== ""): ?>
                        <img src="events/<?php echo rawurlencode($event['image']); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($event['event_name']); ?>" style="max-height: 320px; object-fit: cover;">
                    <?php endif; ?>
                    <div class="card-body p-4 p-lg-5">
                        <span class="badge bg-soft-primary text-primary mb-3"><?php echo htmlspecialchars($event['event_type']); ?></span>
                        <h1 class="h2 fw-bold mb-3">Confirm your registration</h1>
                        <h2 class="h4 mb-3"><?php echo htmlspecialchars($event['event_name']); ?></h2>
                        <p class="text-muted"><?php echo nl2br(htmlspecialchars($event['description'])); ?></p>
                        <ul class="list-unstyled text-muted d-grid gap-2 mb-4">
                            <li><i class="fa-solid fa-calendar me-2"></i><?php echo htmlspecialchars($event['event_date']); ?> at <?php echo htmlspecialchars($event['event_time']); ?></li>
                            <li><i class="fa-solid fa-location-dot me-2"></i><?php echo htmlspecialchars($event['venue']); ?></li>
                            <li><i class="fa-solid fa-users me-2"></i><?php echo (int)$event['max_participants']; ?> total places</li>
                        </ul>
                        <?php if ($message !== ""): ?><div class="alert alert-warning" role="alert"><?php echo htmlspecialchars($message); ?></div><?php endif; ?>
                        <form method="POST" class="d-flex flex-wrap gap-2">
                            <button type="submit" class="btn btn-primary"><i class="fa-solid fa-ticket me-2"></i>Confirm Registration</button>
                            <a href="events.php" class="btn btn-outline-secondary">Back to Events</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php include 'includes/footer.php'; ?>
</body>
</html>