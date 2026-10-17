<?php

session_start();
include("../includes/access_control.php");
require_role("user");
include("../includes/db.php");

$msg="";

if(isset($_POST['submit']))
{
    $user_id=(int)$_SESSION['user_id'];

    $event_type=$_POST['event_type'];
    $event_date=$_POST['event_date'];
    $venue=$_POST['venue'];
    $guests=(int)$_POST['guests'];

    $decoration=$_POST['decoration'];
    $photography=$_POST['photography'];
    $catering=$_POST['catering'];
    $dj=$_POST['dj'];

    $additional_requirements=$_POST['additional_requirements'];

    $statement=$conn->prepare("INSERT INTO service_requests (user_id, event_type, event_date, venue, guests, decoration, photography, catering, dj, additional_requirements) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $statement->bind_param("isssisssss", $user_id, $event_type, $event_date, $venue, $guests, $decoration, $photography, $catering, $dj, $additional_requirements);

    if($statement->execute())
    {
        $msg="Service Request Submitted Successfully";
    }
    else
    {
        $msg="Service request could not be submitted. Please try again.";
    }
}
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
    <title>Service Request</title>
</head>
<body>
    <?php include '../includes/navbar.php'; ?>
    <div class="container py-5">
        <div class="row g-4">
            <div class="col-lg-3">
                <?php include '../includes/user_sidebar.php'; ?>
            </div>
            <div class="col-lg-9">
                <div class="card border-0 shadow-sm rounded-4 p-4 p-lg-5">
                    <div class="text-center text-md-start mb-4">
                        <h3 class="fw-bold mb-2">Event Service Request</h3>
                        <p class="text-muted mb-0">Tell us about your vision and we’ll help you plan it beautifully.</p>
                    </div>
                    <form method="POST" class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Event Type</label>
                            <select name="event_type" class="form-select" required>
                                <option>Wedding</option>
                                <option>Birthday</option>
                                <option>Reception</option>
                                <option>Corporate</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Event Date</label>
                            <input type="date" name="event_date" min="<?php echo date('Y-m-d'); ?>" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Venue</label>
                            <input type="text" name="venue" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Number of Guests</label>
                            <input type="number" name="guests" min="1" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Decoration</label>
                            <select name="decoration" class="form-select"><option>Yes</option><option>No</option></select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Photography</label>
                            <select name="photography" class="form-select"><option>Yes</option><option>No</option></select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Catering</label>
                            <select name="catering" class="form-select"><option>Yes</option><option>No</option></select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">DJ</label>
                            <select name="dj" class="form-select"><option>Yes</option><option>No</option></select>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Additional Requirements</label>
                            <textarea name="additional_requirements" class="form-control" rows="4"></textarea>
                        </div>
                        <?php if($msg != ""): ?><div class="col-12"><div class="alert <?php echo strpos($msg, 'Successfully') !== false ? 'alert-success' : 'alert-danger'; ?> rounded-4 mb-0" role="alert"><?php echo htmlspecialchars($msg); ?></div></div><?php endif; ?>
                        <div class="col-12"><button type="submit" name="submit" class="btn btn-primary">Submit Request</button></div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php include '../includes/footer.php'; ?>
</body>
</html>