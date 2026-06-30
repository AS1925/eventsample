<?php
session_start();
include("../includes/db.php");

if(!isset($_SESSION['user_id']))
{
    header("Location: ../login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

$result = mysqli_query($conn,"
SELECT *
FROM users
WHERE id='$user_id'
");

$user = mysqli_fetch_assoc($result);

$msg = "";

if(isset($_POST['update']))
{
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $check=mysqli_query($conn," SELECT * FROM users WHERE email='$email' AND id!='$user_id'");
    if(mysqli_num_rows($check)>0)
        {
            $msg="Email Already Exists";
        }
    else{
    $update = mysqli_query($conn,"
    UPDATE users
    SET
    name='$name',
    email='$email',
    phone='$phone'
    WHERE id='$user_id'
    ");

    if($update)
    {
        $_SESSION['user_name'] = $name;

        $msg = "Profile Updated Successfully";

        $result = mysqli_query($conn,"
        SELECT *
        FROM users
        WHERE id='$user_id'
        ");

        $user = mysqli_fetch_assoc($result);
    }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <title>Profile</title>
</head>
<body>

<h2>My Profile</h2>

<form method="POST">

Name <br>
<input type="text"
name="name"
value="<?php echo $user['name']; ?>"
required>

<br><br>

Email <br>
<input type="email"
name="email"
value="<?php echo $user['email']; ?>"
required>

<br><br>

Phone <br>
<input type="text"
name="phone"
value="<?php echo $user['phone']; ?>"
required>

<br><br>

<input type="submit"
name="update"
value="Update Profile">

</form>

<br>

<?php echo $msg; ?>

<br><br>

<a href="dashboard.php">Back Dashboard</a>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
        <script src="script.js"></script>
</body>
</html>