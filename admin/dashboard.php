<?php 
session_start();
include('../includes/db.php');
if(!isset($_SESSION['user_id']))
    {
        header("Location:../login.php");
        exit();
    }
if($_SESSION['role']!='admin')
    {
        die("Access Denied");
    }
$total_users = mysqli_fetch_assoc(
    mysqli_query($conn,"SELECT COUNT(*) AS total FROM users"));

$total_events = mysqli_fetch_assoc(
    mysqli_query($conn,"SELECT COUNT(*) AS total FROM events")
);

$total_registrations = mysqli_fetch_assoc(
    mysqli_query($conn,"SELECT COUNT(*) AS total FROM registrations")
);

$total_requests = mysqli_fetch_assoc(
    mysqli_query($conn,"SELECT COUNT(*) AS total FROM service_requests")
);
$recent_registrations = mysqli_query($conn, "SELECT registrations.id, users.name, events.event_name, registrations.status FROM registrations INNER JOIN users ON registrations.user_id=users.id INNER JOIN events ON registrations.event_id=events.id ORDER BY registrations.id DESC LIMIT 5");
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
        <title>Admin Dashboard - Event Ease</title>
    </head>
    <body>
        <?php include '../includes/navbar.php'; ?>
        <div class="container py-5">
            <div class="row g-4">
                <div class="col-lg-3">
                    <?php include '../includes/admin_sidebar.php'; ?>
                </div>
                <div class="col-lg-9">
                    <div class="card border-0 shadow-sm rounded-4 p-4 mb-4">
                        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                            <div>
                                <p class="text-primary fw-semibold mb-1">Admin Overview</p>
                                <h2 class="fw-bold mb-1">Welcome, <?php echo htmlspecialchars($_SESSION['user_name']); ?>!</h2>
                                <p class="text-muted mb-0">Monitor events, registrations, and service requests from one dashboard.</p>
                            </div>
                            <a href="add_event.php" class="btn btn-primary">Add New Event</a>
                        </div>
                    </div>
                    <div class="row g-4 mb-4">
                        <div class="col-md-6 col-xl-3"><div class="card stat-card h-100"><div class="icon-badge"><i class="fa-solid fa-users"></i></div><h6 class="text-muted">Total Users</h6><h3 class="fw-bold mb-0"><?php echo $total_users['total']; ?></h3></div></div>
                        <div class="col-md-6 col-xl-3"><div class="card stat-card h-100"><div class="icon-badge"><i class="fa-solid fa-calendar-days"></i></div><h6 class="text-muted">Total Events</h6><h3 class="fw-bold mb-0"><?php echo $total_events['total']; ?></h3></div></div>
                        <div class="col-md-6 col-xl-3"><div class="card stat-card h-100"><div class="icon-badge"><i class="fa-solid fa-ticket-alt"></i></div><h6 class="text-muted">Registrations</h6><h3 class="fw-bold mb-0"><?php echo $total_registrations['total']; ?></h3></div></div>
                        <div class="col-md-6 col-xl-3"><div class="card stat-card h-100"><div class="icon-badge"><i class="fa-solid fa-handshake"></i></div><h6 class="text-muted">Service Requests</h6><h3 class="fw-bold mb-0"><?php echo $total_requests['total']; ?></h3></div></div>
                    </div>
                    <div class="card border-0 shadow-sm rounded-4 p-4">
                        <h5 class="fw-bold mb-3">Recent Registrations</h5>
                        <div class="table-responsive">
                            <table class="table modern-table align-middle">
                                <thead>
                                    <tr><th>#</th><th>User</th><th>Event</th><th>Status</th></tr>
                                </thead>
                                <tbody>
                                    <?php $count=1; while($row=mysqli_fetch_assoc($recent_registrations)){ ?>
                                    <tr><td><?php echo $count++; ?></td><td><?php echo htmlspecialchars($row['name']); ?></td><td><?php echo htmlspecialchars($row['event_name']); ?></td><td><span class="badge bg-soft-primary text-primary"><?php echo htmlspecialchars($row['status']); ?></span></td></tr>
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
