<?php session_start();
include("../includes/db.php");
if(!isset($_SESSION['user_id']) || $_SESSION['role']!='admin')
    {
        header("Location:../login.php");
        exit();
    }
$query=mysqli_query($conn,"SELECT * FROM events ORDER BY id DESC");
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
    <title>View Events</title>
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
                    <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
                        <div>
                            <h3 class="fw-bold mb-1">Manage Events</h3>
                            <p class="text-muted mb-0">Review your event catalog and update listings.</p>
                        </div>
                        <a href="add_event.php" class="btn btn-primary">Add New Event</a>
                    </div>
                    <div class="table-responsive">
                        <table class="table align-middle modern-table">
                            <thead>
                                <tr><th>ID</th><th>Event</th><th>Type</th><th>Date</th><th>Venue</th><th>Image</th><th>Seats</th><th>Actions</th></tr>
                            </thead>
                            <tbody>
                                <?php while($row = mysqli_fetch_assoc($query)){ ?>
                                <tr>
                                    <td><?php echo $row['id']; ?></td>
                                    <td><?php echo htmlspecialchars($row['event_name']); ?></td>
                                    <td><?php echo htmlspecialchars($row['event_type']); ?></td>
                                    <td><?php echo htmlspecialchars($row['event_date']); ?></td>
                                    <td><?php echo htmlspecialchars($row['venue']); ?></td>
                                    <td><?php if($row['image']!="") { ?><img src="../events/<?php echo $row['image']; ?>" width="90" class="rounded-3"> <?php } else { echo 'No image'; } ?></td>
                                    <td><?php echo $row['max_participants']; ?></td>
                                    <td><a href="edit_event.php?id=<?php echo $row['id']; ?>" class="btn btn-outline-primary btn-sm">Edit</a> <a href="delete_event.php?id=<?php echo $row['id']; ?>" class="btn btn-outline-danger btn-sm" onclick="return confirm('Are you sure want to delete this event?')">Delete</a></td>
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
