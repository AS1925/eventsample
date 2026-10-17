<?php

session_start();
include("../includes/access_control.php");
require_role("admin");
include("../includes/db.php");

$registration_statuses = array("Registered", "Attended", "No-show", "Cancelled");
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['registration_id'], $_POST['status']) && is_string($_POST['registration_id']) && ctype_digit($_POST['registration_id']) && in_array($_POST['status'], $registration_statuses, true)) {
    $registration_id = (int)$_POST['registration_id'];
    $status = $_POST['status'];
    $update = $conn->prepare("UPDATE registrations SET status = ? WHERE id = ?");
    $update->bind_param("si", $status, $registration_id);
    $update->execute();
    header("Location: view_registrations.php?updated=1");
    exit();
}

$query = mysqli_query($conn,"
SELECT
registrations.id,
users.name,
users.email,
events.event_name,
events.event_date,
registrations.status

FROM registrations

INNER JOIN users
ON registrations.user_id = users.id

INNER JOIN events
ON registrations.event_id = events.id

ORDER BY registrations.id DESC
");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="icon" href="../events/logo.png" type="image/png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <title>View Registrations</title>
</head>
<body>
    <?php include '../includes/navbar.php'; ?>
    <div class="container py-5">
        <div class="row g-4">
            <div class="col-lg-3">
                <?php include '../includes/admin_sidebar.php'; ?>
            </div>
            <div class="col-lg-9">
                <div class="card border-0 shadow-sm rounded-4 p-4">
                    <h3 class="fw-bold mb-3">Event Registrations</h3>
                    <?php if (isset($_GET['updated'])): ?><div class="alert alert-success" role="status">Attendance status updated.</div><?php endif; ?>
                    <div class="table-responsive">
                        <table class="table align-middle modern-table">
                            <thead><tr><th>S.No</th><th>User Name</th><th>Email</th><th>Event</th><th>Date</th><th>Attendance</th><th>Update</th></tr></thead>
                            <tbody>
                                <?php $count=1; while($row=mysqli_fetch_assoc($query)){ ?>
                                <tr>
                                    <td><?php echo $count++; ?></td>
                                    <td><?php echo htmlspecialchars($row['name']); ?></td>
                                    <td><?php echo htmlspecialchars($row['email']); ?></td>
                                    <td><?php echo htmlspecialchars($row['event_name']); ?></td>
                                    <td><?php echo htmlspecialchars($row['event_date']); ?></td>
                                    <td><span class="badge bg-soft-primary text-primary"><?php echo htmlspecialchars($row['status']); ?></span></td>
                                    <td>
                                        <form method="POST" class="d-flex gap-2 align-items-center">
                                            <input type="hidden" name="registration_id" value="<?php echo (int)$row['id']; ?>">
                                            <label class="visually-hidden" for="registration-status-<?php echo (int)$row['id']; ?>">Attendance status</label>
                                            <select id="registration-status-<?php echo (int)$row['id']; ?>" name="status" class="form-select form-select-sm">
                                                <?php foreach ($registration_statuses as $status): ?><option value="<?php echo htmlspecialchars($status); ?>" <?php echo $row['status'] === $status ? 'selected' : ''; ?>><?php echo htmlspecialchars($status); ?></option><?php endforeach; ?>
                                            </select>
                                            <button type="submit" class="btn btn-outline-primary btn-sm">Save</button>
                                        </form>
                                    </td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include '../includes/footer.php'; ?>
</body>
</html>