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

<html>
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
<body>

<h2>Update Status</h2>

<form method="POST">

<select name="status">

<option
<?php if($row['status']=="Pending") echo "selected"; ?>>
Pending
</option>

<option
<?php if($row['status']=="Approved") echo "selected"; ?>>
Approved
</option>

<option
<?php if($row['status']=="Completed") echo "selected"; ?>>
Completed
</option>

<option
<?php if($row['status']=="Rejected") echo "selected"; ?>>
Rejected
</option>

</select>

<br><br>

<input type="submit"
name="update"
value="Update">

</form>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
        <script src="script.js"></script>
</body>
</html>