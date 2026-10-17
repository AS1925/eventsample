<?php session_start();
include("../includes/access_control.php");
require_role("user");
include("../includes/db.php");
$user_id=$_SESSION['user_id'];
$query=mysqli_query($conn,"SELECT registrations.id AS reg_id, events.id AS event_id, events.event_name,events.event_type,events.event_date,events.venue,registrations.status FROM registrations INNER JOIN events ON registrations.event_id=events.id WHERE registrations.user_id='$user_id'");
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
    <title>My Events</title>
</head>
<body>
    <?php include '../includes/navbar.php'; ?>
    <div class="container py-5">
        <div class="row g-4">
            <div class="col-lg-3">
                <?php include '../includes/user_sidebar.php'; ?>
            </div>
            <div class="col-lg-9">
                <div class="card border-0 shadow-sm rounded-4 p-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div>
                            <h3 class="fw-bold mb-1">My Registered Events</h3>
                            <p class="text-muted mb-0">Track registrations and manage cancellations.</p>
                        </div>
                    </div>
                    <?php if (isset($_GET['registered']) && $_GET['registered'] === '1'): ?>
                        <div class="alert alert-success" role="alert">Your event registration is confirmed.</div>
                    <?php endif; ?>
                    <?php if ($query->num_rows === 0): ?>
                        <div class="text-center py-5">
                            <i class="fa-solid fa-calendar-plus text-primary fs-2 mb-3"></i>
                            <h4 class="h5 fw-semibold">No registered events</h4>
                            <p class="text-muted">Browse available events to find your next experience.</p>
                            <a href="../events.php" class="btn btn-primary">Explore Events</a>
                        </div>
                    <?php else: ?>
                    <div class="table-responsive">
                        <table class="table align-middle modern-table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Event</th>
                                    <th>Type</th>
                                    <th>Date</th>
                                    <th>Venue</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $count=1; while($row=mysqli_fetch_assoc($query)){ ?>
                                <tr>
                                    <td><?php echo $count++;?></td>
                                    <td><?php echo htmlspecialchars($row['event_name']);?></td>
                                    <td><?php echo htmlspecialchars($row['event_type']);?></td>
                                    <td><?php echo htmlspecialchars($row['event_date']);?></td>
                                    <td><?php echo htmlspecialchars($row['venue']);?></td>
                                    <td><span class="badge bg-soft-primary text-primary"><?php echo htmlspecialchars($row['status']);?></span></td>
                                    <td class="d-flex flex-wrap gap-2">
                                        <?php if ($row['event_date'] < date('Y-m-d') && $row['status'] === 'Attended'): ?>
                                            <a href="event_review.php?id=<?php echo (int)$row['event_id']; ?>" class="btn btn-outline-primary btn-sm">Review</a>
                                        <?php elseif ($row['event_date'] < date('Y-m-d') && $row['status'] !== 'Cancelled'): ?>
                                            <span class="text-muted small">Attendance pending</span>
                                        <?php elseif ($row['status'] !== 'Cancelled' && $row['status'] !== 'Attended'): ?>
                                            <form method="POST" action="cancel_registration.php" class="m-0">
                                                <input type="hidden" name="id" value="<?php echo (int)$row['reg_id']; ?>">
                                                <button type="submit" class="btn btn-outline-danger btn-sm" onclick="return confirm('Cancel Registration?')">Cancel</button>
                                            </form>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
    <?php include '../includes/footer.php'; ?>
</body>
</html>