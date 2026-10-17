<?php
$active_page = basename($_SERVER['PHP_SELF']);
?>
<div class="sidebar-card">
    <div class="sidebar-brand">
        <h5 class="mb-1">My Account</h5>
        <small class="text-muted">Welcome, <?php echo isset($_SESSION['user_name']) ? htmlspecialchars($_SESSION['user_name']) : 'User'; ?></small>
    </div>
    <div class="list-group list-group-flush">
        <a href="dashboard.php" class="list-group-item list-group-item-action <?php echo $active_page === 'dashboard.php' ? 'active' : ''; ?>">Dashboard</a>
        <a href="profile.php" class="list-group-item list-group-item-action <?php echo $active_page === 'profile.php' ? 'active' : ''; ?>">Profile</a>
        <a href="my_events.php" class="list-group-item list-group-item-action <?php echo $active_page === 'my_events.php' ? 'active' : ''; ?>">My Events</a>
        <a href="service_request.php" class="list-group-item list-group-item-action <?php echo $active_page === 'service_request.php' ? 'active' : ''; ?>">Service Request</a>
        <a href="my_requests.php" class="list-group-item list-group-item-action <?php echo $active_page === 'my_requests.php' ? 'active' : ''; ?>">My Requests</a>
        <a href="../logout.php" class="list-group-item list-group-item-action text-danger" onclick="return confirm('Are you sure you want to logout?')">Logout</a>
    </div>
</div>
