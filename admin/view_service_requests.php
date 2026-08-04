<?php

session_start();
include("../includes/db.php");

if(!isset($_SESSION['user_id']) || $_SESSION['role']!="admin")
{
    header("Location: ../login.php");
    exit();
}

$query=mysqli_query($conn,"
SELECT
service_requests.id,
users.name,
service_requests.event_type,
service_requests.event_date,
service_requests.venue,
service_requests.guests,
service_requests.status

FROM service_requests

INNER JOIN users
ON service_requests.user_id = users.id

ORDER BY service_requests.id DESC
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
    <title>Service Requests</title>
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
                    <h3 class="fw-bold mb-3">Service Requests</h3>
                    <div class="table-responsive">
                        <table class="table align-middle modern-table">
                            <thead><tr><th>S.No</th><th>User</th><th>Event Type</th><th>Date</th><th>Venue</th><th>Guests</th><th>Status</th><th>Action</th></tr></thead>
                            <tbody>
                                <?php $count=1; while($row=mysqli_fetch_assoc($query)){ ?>
                                <tr>
                                    <td><?php echo $count++; ?></td>
                                    <td><?php echo htmlspecialchars($row['name']); ?></td>
                                    <td><?php echo htmlspecialchars($row['event_type']); ?></td>
                                    <td><?php echo htmlspecialchars($row['event_date']); ?></td>
                                    <td><?php echo htmlspecialchars($row['venue']); ?></td>
                                    <td><?php echo htmlspecialchars($row['guests']); ?></td>
                                    <td><span class="badge bg-soft-primary text-primary"><?php echo htmlspecialchars($row['status']); ?></span></td>
                                    <td><a href="update_request_status.php?id=<?php echo $row['id']; ?>" class="btn btn-outline-primary btn-sm">Update Status</a></td>
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