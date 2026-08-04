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
                        $message="Incorrect Password!";
                    }
        }
        else
            {
                $message="Email not found!";
            }
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="icon" href="events/logo.png" type="image/png">
        <link rel="stylesheet" href="assets/css/style.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
        <title>Login - Event Ease</title>
    </head>
    <body class="auth-page">
        <?php include 'includes/navbar.php'; ?>
        <div>
            <div class="container py-5">
                <div class="row auth-card shadow-lg overflow-hidden">
                    <div class="col-lg-6 d-none d-lg-flex auth-illustration align-items-center justify-content-center p-5">
                        <div class="text-center text-white">
                            <div class="icon-badge mb-4"><i class="fa-solid fa-calendar-check"></i></div>
                            <h2 class="fw-bold mb-3">Welcome Back</h2>
                            <p class="mb-0">Sign in to manage events, registrations, and service requests with ease.</p>
                        </div>
                    </div>
                    <div class="col-lg-6 p-4 p-lg-5 bg-white">
                        <div class="text-center mb-4">
                        <div class="brand-pill mb-3"><i class="fa-solid fa-bolt"></i> EventEase</div>
                        <h3 class="fw-bold mb-2">Login to your account</h3>
                        <p class="text-muted">Access your dashboard securely</p>
                    </div>
                    <form method="POST" class="auth-form">
                        <div class="mb-3">
                            <label class="form-label">Email Address</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fa-solid fa-envelope"></i></span>
                                <input type="email" name="email" class="form-control" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fa-solid fa-lock"></i></span>
                                <input type="password" id="passwordField" name="password" class="form-control" required>
                                <button class="btn btn-outline-secondary" type="button" id="togglePassword"><i class="fa-solid fa-eye"></i></button>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="rememberMe">
                                <label class="form-check-label" for="rememberMe">Remember me</label>
                            </div>
                            <a href="forgot_password.php" class="text-decoration-none">Forgot password?</a>
                        </div>
                        <?php if($message != ""): ?>
                            <div class="alert alert-danger rounded-4" role="alert"><?php echo $message; ?></div>
                        <?php endif; ?>
                        <button type="submit" name="login" class="btn btn-primary w-100 py-2">Login</button>
                    </form>
                    <div class="text-center mt-4">
                        <a href="register.php" class="text-decoration-none"><i class="fa-solid fa-user-plus me-2"></i>Create New Account</a>
                    </div>
                </div>
            </div>
        </div>
        <?php include 'includes/footer.php'; ?>
    </body>
</html>