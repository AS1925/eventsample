<?php

session_start();
include("../includes/db.php");

if(!isset($_SESSION['user_id']) || $_SESSION['role']!="admin")
{
    header("Location: ../login.php");
    exit();
}

$users = mysqli_fetch_assoc(
    mysqli_query($conn,"SELECT COUNT(*) AS total FROM users")
);

$events = mysqli_fetch_assoc(
    mysqli_query($conn,"SELECT COUNT(*) AS total FROM events")
);

$registrations = mysqli_fetch_assoc(
    mysqli_query($conn,"SELECT COUNT(*) AS total FROM registrations")
);

$requests = mysqli_fetch_assoc(
    mysqli_query($conn,"SELECT COUNT(*) AS total FROM service_requests")
);

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
    <title>Reports</title>
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
                    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4">
                        <div>
                            <h3 class="fw-bold mb-1">System Reports</h3>
                            <p class="text-muted mb-0">A clear snapshot of platform activity.</p>
                        </div>
                        <button onclick="window.print()" class="btn btn-outline-primary">Print Report</button>
                    </div>
                    <div class="table-responsive">
                        <table class="table modern-table align-middle">
                            <thead><tr><th>Report Name</th><th>Total Count</th></tr></thead>
                            <tbody>
                                <tr><td>Total Users</td><td><?php echo $users['total']; ?></td></tr>
                                <tr><td>Total Events</td><td><?php echo $events['total']; ?></td></tr>
                                <tr><td>Total Registrations</td><td><?php echo $registrations['total']; ?></td></tr>
                                <tr><td>Total Service Requests</td><td><?php echo $requests['total']; ?></td></tr>
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