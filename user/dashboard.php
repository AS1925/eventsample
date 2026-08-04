<?php session_start();
if(!isset($_SESSION['user_id']))
    {
        header("Location:../login.php");
        exit();
    }
include('../includes/db.php');
$stats = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM registrations WHERE user_id='".$_SESSION['user_id']."'"));
$upcoming = mysqli_query($conn, "SELECT * FROM registrations INNER JOIN events ON registrations.event_id=events.id WHERE registrations.user_id='".$_SESSION['user_id']."' ORDER BY events.event_date ASC LIMIT 1");
$upcoming_event = mysqli_fetch_assoc($upcoming);
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
    <title>User Dashboard - Event Ease</title>
</head>
<body>
    <?php include '../includes/navbar.php'; ?>
    <div class="container py-5">
        <div class="row g-4">
            <div class="col-lg-3">
                <?php include '../includes/user_sidebar.php'; ?>
            </div>
            <div class="col-lg-9">
                <div class="card border-0 shadow-sm rounded-4 p-4 p-lg-5 mb-4">
                    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
                        <div>
                            <p class="text-primary fw-semibold mb-2">Welcome back</p>
                            <h2 class="fw-bold mb-1">Hello, <?php echo htmlspecialchars($_SESSION['user_name']); ?>!</h2>
                            <p class="text-muted mb-0">Here’s an overview of your event activity and next steps.</p>
                        </div>
                        <a href="service_request.php" class="btn btn-primary">Request a Service</a>
                    </div>
                </div>
                <div class="row g-4 mb-4">
                    <div class="col-md-4"><div class="card stat-card h-100"><div class="icon-badge"><i class="fa-solid fa-calendar-check"></i></div><h6 class="text-muted">Registered Events</h6><h3 class="fw-bold mb-0"><?php echo $stats['total']; ?></h3></div></div>
                    <div class="col-md-4"><div class="card stat-card h-100"><div class="icon-badge"><i class="fa-solid fa-bell"></i></div><h6 class="text-muted">Upcoming Event</h6><h3 class="fw-bold mb-0"><?php echo isset($upcoming_event['event_name']) ? htmlspecialchars($upcoming_event['event_name']) : 'None'; ?></h3></div></div>
                    <div class="col-md-4"><div class="card stat-card h-100"><div class="icon-badge"><i class="fa-solid fa-sparkles"></i></div><h6 class="text-muted">Next Step</h6><h3 class="fw-bold mb-0">Stay prepared</h3></div></div>
                </div>
                <div class="row g-4">
                    <div class="col-lg-7">
                        <div class="card border-0 shadow-sm rounded-4 p-4 h-100">
                            <h5 class="fw-bold mb-3">Quick Actions</h5>
                            <div class="d-grid gap-2">
                                <a href="profile.php" class="btn btn-outline-primary text-start"><i class="fa-solid fa-user me-2"></i>Update Profile</a>
                                <a href="my_events.php" class="btn btn-outline-primary text-start"><i class="fa-solid fa-calendar me-2"></i>View My Events</a>
                                <a href="service_request.php" class="btn btn-outline-primary text-start"><i class="fa-solid fa-handshake me-2"></i>Request Services</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5">
                        <div class="card border-0 shadow-sm rounded-4 p-4 h-100">
                            <h5 class="fw-bold mb-3">Upcoming Summary</h5>
                            <?php if(isset($upcoming_event['event_name'])): ?>
                                <p class="fw-semibold mb-2"><?php echo htmlspecialchars($upcoming_event['event_name']); ?></p>
                                <p class="text-muted mb-2"><i class="fa-solid fa-calendar me-2"></i><?php echo $upcoming_event['event_date']; ?> at <?php echo $upcoming_event['event_time']; ?></p>
                                <p class="text-muted mb-0"><i class="fa-solid fa-location-dot me-2"></i><?php echo htmlspecialchars($upcoming_event['venue']); ?></p>
                            <?php else: ?>
                                <p class="text-muted mb-0">No upcoming registrations yet.</p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include '../includes/footer.php'; ?>
</body>
</html>