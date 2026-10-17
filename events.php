<?php session_start();
include("includes/db.php");
$search = isset($_GET['search']) && is_string($_GET['search']) ? trim($_GET['search']) : "";
if ($search !== "") {
    $search_term = "%" . $search . "%";
    $statement = $conn->prepare("SELECT * FROM events WHERE event_date >= CURDATE() AND (event_name LIKE ? OR event_type LIKE ?) ORDER BY event_date ASC");
    $statement->bind_param("ss", $search_term, $search_term);
} else {
    $statement = $conn->prepare("SELECT * FROM events WHERE event_date >= CURDATE() ORDER BY event_date ASC");
}
$statement->execute();
$query = $statement->get_result();
$capacity_statement = $conn->prepare("SELECT COUNT(*) AS total FROM registrations WHERE event_id = ?");
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
        <title>Events - Event Ease</title>
    </head>
    <body>
        <?php include 'includes/navbar.php'; ?>
        <section class="py-5">
            <div class="container">
                <div class="d-flex flex-column flex-lg-row justify-content-between align-items-lg-center gap-3 mb-4">
                    <div>
                        <h2 class="fw-bold mb-2">Available Events</h2>
                        <p class="text-muted mb-0">Browse upcoming experiences and reserve your spot.</p>
                    </div>
                    <form method="GET" class="d-flex gap-2 flex-wrap">
                        <input class="form-control" type="search" name="search" placeholder="Search by event or type" value="<?php echo htmlspecialchars($search); ?>">
                        <button class="btn btn-primary" type="submit">Search</button>
                    </form>
                </div>
                <?php if(mysqli_num_rows($query)==0): ?>
                    <div class="card border-0 shadow-sm rounded-4 p-5 text-center">
                        <h3 class="fw-semibold mb-2">No events found</h3>
                        <p class="text-muted mb-0">Try a different search term or check back soon.</p>
                    </div>
                <?php else: ?>
                    <div class="row g-4">
                        <?php while($row=mysqli_fetch_assoc($query)){ $event_id=(int)$row['id']; $capacity_statement->bind_param("i", $event_id); $capacity_statement->execute(); $registered=$capacity_statement->get_result()->fetch_assoc(); $available=max(0, (int)$row['max_participants'] - (int)$registered['total']); ?>
                            <div class="col-lg-4 col-md-6">
                                <div class="card event-card h-100">
                                    <?php if($row['image']!=''){ ?><img src="events/<?php echo rawurlencode($row['image']); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($row['event_name']); ?>"><?php } else { ?><div class="event-placeholder"><i class="fa-solid fa-calendar-days"></i></div><?php } ?>
                                    <div class="card-body d-flex flex-column">
                                        <div class="d-flex justify-content-between align-items-start gap-2 mb-2">
                                            <h5 class="card-title fw-bold mb-0"><?php echo htmlspecialchars($row['event_name']); ?></h5>
                                            <span class="badge bg-soft-primary text-primary"><?php echo htmlspecialchars($row['event_type']); ?></span>
                                        </div>
                                        <p class="text-muted small mb-3"><?php echo nl2br(htmlspecialchars($row['description'])); ?></p>
                                        <ul class="list-unstyled text-muted small mb-3">
                                            <li><i class="fa-solid fa-calendar me-2"></i><?php echo htmlspecialchars($row['event_date']); ?> at <?php echo htmlspecialchars($row['event_time']); ?></li>
                                            <li><i class="fa-solid fa-location-dot me-2"></i><?php echo htmlspecialchars($row['venue']); ?></li>
                                            <li><i class="fa-solid fa-users me-2"></i><?php echo $available; ?> seats left</li>
                                        </ul>
                                        <div class="mt-auto">
                                            <?php if ($available <= 0): ?>
                                                <span class="badge bg-danger-subtle text-danger">Event Full</span>
                                            <?php elseif (isset($_SESSION['role']) && $_SESSION['role'] === 'user'): ?>
                                                <a href="register_event.php?id=<?php echo $event_id; ?>" class="btn btn-primary w-100">Register Now</a>
                                            <?php elseif (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
                                                <a href="admin/dashboard.php" class="btn btn-outline-primary w-100">Admin Dashboard</a>
                                            <?php else: ?>
                                                <a href="login.php" class="btn btn-outline-primary w-100">Login to Register</a>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                <?php endif; ?>
            </div>
        </section>
        <?php include 'includes/footer.php'; ?>
    </body>
</html>