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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" href="events/logo.png" type="image/png">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <title>Forgot Password - Event Ease</title>
</head>
<body class="auth-page">
    <?php include 'includes/navbar.php'; ?>
    <div>
        <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-5">
                <div class="card border-0 shadow-lg rounded-4 p-4 p-lg-5">
                    <div class="text-center mb-4">
                        <div class="brand-pill mb-3"><i class="fa-solid fa-shield-halved"></i> Secure Reset</div>
                        <h3 class="fw-bold mb-2">Reset your password</h3>
                        <p class="text-muted">Enter your registered details to create a new password.</p>
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
                            <label class="form-label">Phone Number</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fa-solid fa-phone"></i></span>
                                <input type="text" name="phone" class="form-control" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">New Password</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fa-solid fa-lock"></i></span>
                                <input type="password" name="password" class="form-control" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Confirm Password</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fa-solid fa-lock"></i></span>
                                <input type="password" name="confirm_password" class="form-control" required>
                            </div>
                        </div>
                        <?php if($msg != ""): ?>
                            <div class="alert <?php echo strpos($msg,'Successfully') !== false ? 'alert-success' : 'alert-danger'; ?> rounded-4" role="alert"><?php echo $msg; ?></div>
                        <?php endif; ?>
                        <button type="submit" name="reset" class="btn btn-primary w-100 py-2">Reset Password</button>
                    </form>
                    <div class="text-center mt-4">
                        <a href="login.php" class="text-decoration-none"><i class="fa-solid fa-right-to-bracket me-2"></i>Back to login</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include 'includes/footer.php'; ?>
</body>
</html>