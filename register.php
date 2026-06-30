<?php include('includes/db.php');
$message="";
if(isset($_POST['register']))
    {
        $name=$_POST['name'];
        $email=$_POST['email'];
        $phone=$_POST['phone'];
        $password=$_POST['password'];
        $hashed_password=password_hash($password,PASSWORD_DEFAULT);
        $check=mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
        if(mysqli_num_rows($check)>0)
            {
                $message="Email already registered";
            }
        else{
            $query="INSERT INTO users(name,email,phone,password) VALUES('$name','$email','$phone','$hashed_password')";
            if(mysqli_query($conn,$query))
                {
                    $message="Registration Successful!";
                }
            else{
                $message="Registartion Failed!";
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
        <title>User Registration- Event Ease </title>
    </head>
    <body>
        <h2> User Registration</h2>
        <form method="POST">
            <label>Name:</label><br>
            <input type="text" name="name" required><br><br>
            <label>Email:</label><br>
            <input type="email"name="email" required><br><br>
            <label>Phone:</label><br>
            <input type="tel"name="phone" pattern="[0-9]{10}" maxlength="10"required><br><br>
            <label>Password:</label><br>
            <input type="password" name="password" required><br><br>
            <input type="submit" name="register" value="Register">
        </form>
        <br>
        <?php echo $message; ?>
        <br><br>
        <i class="fa-solid fa-right-to-bracket"></i><a href="login.php">Already have an account? Login</a>
    </body>
</html>