<?php

session_start();
include("../includes/db.php");

$id=$_GET['id'];

if(isset($_POST['update']))
{
    $status=$_POST['status'];

    mysqli_query($conn,"
    UPDATE service_requests
    SET status='$status'
    WHERE id='$id'
    ");

    header("Location:view_service_requests.php");
    exit();
}

$result=mysqli_query($conn,"
SELECT * FROM service_requests
WHERE id='$id'
");

$row=mysqli_fetch_assoc($result);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Request Status</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="icon" href="../events/logo.png" type="image/png">
</head>
<body>
    <?php include '../includes/navbar.php'; ?>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="card border-0 shadow-lg rounded-4 p-4 p-lg-5">
                    <div class="text-center mb-4">
                        <h3 class="fw-bold mb-2">Update Request Status</h3>
                        <p class="text-muted mb-0">Change the status for this service request.</p>
                    </div>
                    <form method="POST">
                        <div class="mb-3">
                            <label class="form-label">Status</label>
                            <select name="status" class="form-select">
                                <option value="Pending" <?php if($row['status']=="Pending") echo "selected"; ?>>Pending</option>
                                <option value="Approved" <?php if($row['status']=="Approved") echo "selected"; ?>>Approved</option>
                                <option value="Completed" <?php if($row['status']=="Completed") echo "selected"; ?>>Completed</option>
                                <option value="Rejected" <?php if($row['status']=="Rejected") echo "selected"; ?>>Rejected</option>
                            </select>
                        </div>
                        <button type="submit" name="update" class="btn btn-primary">Update Status</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php include '../includes/footer.php'; ?>
</body>
</html>