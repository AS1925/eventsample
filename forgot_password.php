<?php

include("includes/db.php");

$msg="";

if(isset($_POST['reset']))
{
    $email=$_POST['email'];
    $phone=$_POST['phone'];

    $password=$_POST['password'];
    $confirm_password=$_POST['confirm_password'];

    if($password != $confirm_password)
    {
        $msg="Passwords do not match";
    }
    else
    {
        $check=mysqli_query($conn,"
        SELECT *
        FROM users
        WHERE email='$email'
        AND phone='$phone'
        ");

        if(mysqli_num_rows($check)>0)
        {
            $hashed_password=password_hash(
                $password,
                PASSWORD_DEFAULT
            );

            mysqli_query($conn,"
            UPDATE users
            SET password='$hashed_password'
            WHERE email='$email'
            AND phone='$phone'
            ");

            $msg="Password Updated Successfully";
        }
        else
        {
            $msg="Invalid Email or Phone Number";
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
</head>
<body>

<h2>Forgot Password</h2>

<form method="POST">

Email <br>
<input type="email"
name="email"
required>

<br><br>

Phone Number <br>
<input type="text"
name="phone"
required>

<br><br>

New Password <br>
<input type="password"
name="password"
required>

<br><br>

Confirm Password <br>
<input type="password"
name="confirm_password"
required>

<br><br>

<input type="submit"
name="reset"
value="Reset Password">

</form>

<br>

<?php echo $msg; ?>

<br><br>

<i class="fa-solid fa-right-to-bracket"></i><a href="login.php">Back Login</a>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
        <script src="script.js"></script>
</body>
</html>