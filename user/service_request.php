<?php

session_start();
include("../includes/db.php");

if(!isset($_SESSION['user_id']))
{
    header("Location: ../login.php");
    exit();
}

$msg="";

if(isset($_POST['submit']))
{
    $user_id=$_SESSION['user_id'];

    $event_type=$_POST['event_type'];
    $event_date=$_POST['event_date'];
    $venue=$_POST['venue'];
    $guests=$_POST['guests'];

    $decoration=$_POST['decoration'];
    $photography=$_POST['photography'];
    $catering=$_POST['catering'];
    $dj=$_POST['dj'];

    $additional_requirements=$_POST['additional_requirements'];

    $query=mysqli_query($conn,"
    INSERT INTO service_requests
    (
    user_id,
    event_type,
    event_date,
    venue,
    guests,
    decoration,
    photography,
    catering,
    dj,
    additional_requirements
    )
    VALUES
    (
    '$user_id',
    '$event_type',
    '$event_date',
    '$venue',
    '$guests',
    '$decoration',
    '$photography',
    '$catering',
    '$dj',
    '$additional_requirements'
    )
    ");

    if($query)
    {
        $msg="Service Request Submitted Successfully";
    }
}
?>

<html>
<head>
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
<title>Service Request</title>
</head>
<body>

<h2>Event Service Request</h2>

<form method="POST">

Event Type <br>
<select name="event_type" required>
    <option>Wedding</option>
    <option>Birthday</option>
    <option>Reception</option>
    <option>Corporate</option>
</select>

<br><br>

Event Date <br>
<input type="date" name="event_date" required>

<br><br>

Venue <br>
<input type="text" name="venue" required>

<br><br>

Number of Guests <br>
<input type="number" name="guests" min="1" required>

<br><br>

Decoration <br>
<select name="decoration">
    <option>Yes</option>
    <option>No</option>
</select>

<br><br>

Photography <br>
<select name="photography">
    <option>Yes</option>
    <option>No</option>
</select>

<br><br>

Catering <br>
<select name="catering">
    <option>Yes</option>
    <option>No</option>
</select>

<br><br>

DJ <br>
<select name="dj">
    <option>Yes</option>
    <option>No</option>
</select>

<br><br>

Additional Requirements <br>

<textarea
name="additional_requirements">
</textarea>

<br><br>

<input type="submit" name="submit" value="Submit Request">

</form>

<br>

<?php echo $msg; ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
        <script src="script.js"></script>
</body>
</html>