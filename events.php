<?php session_start();
include("includes/db.php");
if(isset($_GET['search']))
    {
        $search=trim($_GET['search']);
        $query=mysqli_query($conn,"SELECT * FROM events WHERE event_name LIKE '%$search%' OR event_type LIKE '%$search%' ORDER BY event_date ASC");
    }
    else {
        $query=mysqli_query($conn,"SELECT * FROM events ORDER BY event_date ASC");
    }
if(mysqli_num_rows($query)==0)
    {
        echo "<h3> No Events Found </h3>";
    }
?>
<html>
    <head>
         <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
        <title>Events</title>
    </head>
    <body>
        <h2>Available Events</h2>
        <form method="GET">
            <input type="text" name="search" placeholder="Search Event">
            <input type="Submit" value="Search">
        </form>
        <br>
        <table border="1" cellpadding="10">
            <tr>
                <th>S.No</th>
                <th>event Name</th>
                <th>Type</th>
                <th>Date</th>
                <th>Time</th>
                <th>Venue</th>
                 <th>Image</th>
                <th>Available Seats</th>
                <th>Actions</th>
            </tr>
            <?php $count=1;
            while($row=mysqli_fetch_assoc($query))
                { 
                  $registered = mysqli_fetch_assoc(
                        mysqli_query($conn,"
                        SELECT COUNT(*) AS total
                        FROM registrations
                        WHERE event_id='".$row['id']."'
                        "));

                        $available =
                        $row['max_participants']
                        -
                        $registered['total'];  
                    ?>
                    <tr>
                        <td><?php echo $count++;?></td>
                        <td><?php echo $row['event_name'];?></td>
                        <td><?php echo $row['event_type']; ?></td>
                        <td><?php echo $row['event_date']; ?></td>
                        <td><?php echo $row['event_time']; ?></td>
                        <td><?php echo $row['venue']; ?> </td>
                        <td><?php if($row['image']=="") 
                        {
                            echo "No Image";
                        }
                        else
                            {
                            ?>
                                <img src="events/<?php echo $row['image'];?>" width="120" height="80"> <?php } ?> </td>
                        <td><?php echo $available;?></td>
                        <td> <?php if($available<=0)
                        {
                            echo "Event Full";}
                        else {
                            if(isset($_SESSION['user_id']))
                        {?>
                        <a href="register_event.php?id=<?php echo $row['id'];?>">Register</a> <br>
                        Seats Left:<?php echo $available; ?>
                    <?php }
                    else {
                        echo "Login Required";
                    } 
                    }?></td>
                    </tr>
                    <?php 
                }?>
        </table>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
        <script src="script.js"></script>
    </body>
</html>