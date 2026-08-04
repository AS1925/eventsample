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
                $message="Registration Failed!";
            }
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
        <title>User Registration - Event Ease</title>
    </head>
    <body class="auth-page">
        <?php include 'includes/navbar.php'; ?>
        <div class="auth-page">
            <div class="container py-5">
                <div class="row auth-card shadow-lg overflow-hidden">
                    <div class="col-lg-6 p-4 p-lg-5 bg-white">
                        <div class="text-center mb-4">
                        <div class="brand-pill mb-3"><i class="fa-solid fa-user-plus"></i> EventEase</div>
                        <h3 class="fw-bold mb-2">Create your account</h3>
                        <p class="text-muted">Join thousands of event planners and guests</p>
                    </div>
                    <form method="POST" class="auth-form">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Full Name</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fa-solid fa-user"></i></span>
                                    <input type="text" name="name" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Phone Number</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fa-solid fa-phone"></i></span>
                                    <input type="tel" name="phone" class="form-control" pattern="[0-9]{10}" maxlength="10" required>
                                </div>
                            </div>
                            <div class="col-12">
                                <label class="form-label">Email Address</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fa-solid fa-envelope"></i></span>
                                    <input type="email" name="email" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-12">
                                <label class="form-label">Password</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fa-solid fa-lock"></i></span>
                                    <input type="password" name="password" class="form-control" required>
                                </div>
                            </div>
                        </div>
                        <?php if($message != ""): ?>
                            <div class="alert <?php echo strpos($message,'Successful') !== false ? 'alert-success' : 'alert-danger'; ?> rounded-4 mt-3" role="alert"><?php echo $message; ?></div>
                        <?php endif; ?>
                        <button type="submit" name="register" class="btn btn-primary w-100 mt-3">Create Account</button>
                    </form>
                    <div class="text-center mt-4">
                        <a href="login.php" class="text-decoration-none"><i class="fa-solid fa-right-to-bracket me-2"></i>Already have an account? Login</a>
                    </div>
                </div>
                <div class="col-lg-6 d-none d-lg-flex auth-illustration align-items-center justify-content-center p-5">
                    <div class="text-center text-white">
                        <div class="icon-badge mb-4"><i class="fa-solid fa-calendar-days"></i></div>
                        <h2 class="fw-bold mb-3">Plan Smarter</h2>
                        <p class="mb-0">Create an account to register for events and request premium services in just a few clicks.</p>
                    </div>
                </div>
            </div>
        </div>
        <?php include 'includes/footer.php'; ?>
    </body>
</html>