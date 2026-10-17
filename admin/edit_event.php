<?php
session_start();
include("../includes/access_control.php");
require_role("admin");
include("../includes/db.php");

if (!isset($_GET['id']) || !ctype_digit($_GET['id'])) {
    header("Location: view_events.php");
    exit();
}

$id = (int)$_GET['id'];
$statement = $conn->prepare("SELECT * FROM events WHERE id = ?");
$statement->bind_param("i", $id);
$statement->execute();
$row = $statement->get_result()->fetch_assoc();
if (!$row) {
    header("Location: view_events.php");
    exit();
}

$message = "";
if (isset($_POST['update'])) {
    $event_name = trim($_POST['event_name']);
    $event_type = trim($_POST['event_type']);
    $event_date = $_POST['event_date'];
    $event_time = $_POST['event_time'];
    $venue = trim($_POST['venue']);
    $description = trim($_POST['description']);
    $max_participants = (int)$_POST['max_participants'];
    $image = $row['image'];

    if ($max_participants < 1) {
        $message = "Maximum participants must be at least 1.";
    } elseif (isset($_FILES['image']) && $_FILES['image']['error'] !== UPLOAD_ERR_NO_FILE) {
        $extension = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
        $allowed_extensions = array("jpg", "jpeg", "png", "webp");
        if ($_FILES['image']['error'] !== UPLOAD_ERR_OK || !in_array($extension, $allowed_extensions, true)) {
            $message = "Choose a JPG, JPEG, PNG, or WEBP image.";
        } else {
            $image = bin2hex(random_bytes(8)) . "." . $extension;
            if (!move_uploaded_file($_FILES['image']['tmp_name'], "../events/" . $image)) {
                $message = "The image could not be uploaded. Please try again.";
            }
        }
    }

    if ($message === "") {
        $update = $conn->prepare("UPDATE events SET event_name = ?, event_type = ?, event_date = ?, event_time = ?, venue = ?, description = ?, max_participants = ?, image = ? WHERE id = ?");
        $update->bind_param("ssssssisi", $event_name, $event_type, $event_date, $event_time, $venue, $description, $max_participants, $image, $id);
        if ($update->execute()) {
            header("Location: view_events.php");
            exit();
        }
        $message = "The event could not be updated. Please try again.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Event - EventEase</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="icon" href="../events/logo.png" type="image/png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
</head>
<body>
    <?php include '../includes/navbar.php'; ?>
    <div class="container py-5">
        <div class="row g-4">
            <div class="col-lg-3">
                <?php include '../includes/admin_sidebar.php'; ?>
            </div>
            <div class="col-lg-9">
                <div class="card border-0 shadow-sm rounded-4 p-4 p-lg-5">
                    <h1 class="h3 fw-bold mb-1">Edit Event</h1>
                    <p class="text-muted mb-4">Update the event details shown to attendees.</p>
                    <form method="POST" enctype="multipart/form-data" class="row g-3">
                        <div class="col-md-6"><label class="form-label" for="event-name">Event Name</label><input id="event-name" type="text" name="event_name" class="form-control" value="<?php echo htmlspecialchars($row['event_name']); ?>" required></div>
                        <div class="col-md-6"><label class="form-label" for="event-type">Event Type</label><select id="event-type" name="event_type" class="form-select" required><?php foreach (array("Wedding", "Birthday", "Corporate", "Conference", "Reception", "others") as $type): ?><option value="<?php echo htmlspecialchars($type); ?>" <?php echo $row['event_type'] === $type ? 'selected' : ''; ?>><?php echo htmlspecialchars($type); ?></option><?php endforeach; ?></select></div>
                        <div class="col-md-6"><label class="form-label" for="event-date">Event Date</label><input id="event-date" type="date" name="event_date" class="form-control" value="<?php echo htmlspecialchars($row['event_date']); ?>" required></div>
                        <div class="col-md-6"><label class="form-label" for="event-time">Event Time</label><input id="event-time" type="time" name="event_time" class="form-control" value="<?php echo htmlspecialchars($row['event_time']); ?>" required></div>
                        <div class="col-md-6"><label class="form-label" for="venue">Venue</label><input id="venue" type="text" name="venue" class="form-control" value="<?php echo htmlspecialchars($row['venue']); ?>" required></div>
                        <div class="col-md-6"><label class="form-label" for="max-participants">Maximum Participants</label><input id="max-participants" type="number" name="max_participants" min="1" class="form-control" value="<?php echo (int)$row['max_participants']; ?>" required></div>
                        <div class="col-12"><label class="form-label" for="description">Description</label><textarea id="description" name="description" class="form-control" rows="4"><?php echo htmlspecialchars($row['description']); ?></textarea></div>
                        <div class="col-12">
                            <label class="form-label" for="image">Replace Image (optional)</label>
                            <?php if ($row['image'] !== ""): ?><div class="mb-2"><img src="../events/<?php echo rawurlencode($row['image']); ?>" alt="Current event image" class="img-thumbnail" style="max-width: 180px; max-height: 120px; object-fit: cover;"></div><?php endif; ?>
                            <input id="image" type="file" name="image" accept=".jpg,.jpeg,.png,.webp" class="form-control">
                        </div>
                        <?php if ($message !== ""): ?><div class="col-12"><div class="alert alert-danger mb-0" role="alert"><?php echo htmlspecialchars($message); ?></div></div><?php endif; ?>
                        <div class="col-12 d-flex flex-wrap gap-2"><button type="submit" name="update" class="btn btn-primary">Save Changes</button><a href="view_events.php" class="btn btn-outline-secondary">Cancel</a></div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php include '../includes/footer.php'; ?>
</body>
</html>