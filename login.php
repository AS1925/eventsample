<?php session_start(); 
include("includes/db.php");
$message="";
if(isset($_POST['login']))
    {
        $email=$_POST['email'];
        $password=$_POST['password'];
        $query=mysqli_query($conn,"SELECT * FROM users WHERE email='$email'");
        if(mysqli_num_rows($query)>0){
            $user=mysqli_fetch_assoc($query);
            if(password_verify($password,$user['password']))
                {
                    $_SESSION['user_id']=$user['id'];
                    $_SESSION['user_name']=$user['name'];
                    $_SESSION['role']=$user['role'];
                   if($user['role']=='admin')
                    {
                        header("Location:admin/dashboard.php");
                    }
                    else{
                        header("Location:user/dashboard.php");
                    }
                    exit();
                }
                else
                    {
                        $message="Incococoderrect Password!";
                    }
        }
        else
            {
                $message="Email not found!";
            }
    }
?>
<!DOCTYPE html>
<html>
    <head>
         <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="../assets/css/style.css">
        <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
        <title>Login-Event Ease</title>
    </head>
    <body>
        <form method="POST">
            <label>Email:</label><br>
            <input type="email" name="email" required><br><br>
            <label>Password:</label><br>
            <input type="password" name="password" required><br><br>
            <input type="submit" name="login" value="Login">
        </form>
        <br>
        <?php echo $message; ?>
        <br><br>
        <i class="fa-solid fa-person-circle-plus"></i><a href="register.php">Create New Account</a>
        <i class="fa-solid fa-key"></i><a href="forgot_password.php">Forgot password? </a>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
        <script src="script.js"></script>
    </body>
</html>