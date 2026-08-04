<?php
$active_page = basename($_SERVER['PHP_SELF']);
?>
<div class="sidebar-card">
    <div class="sidebar-brand">
        <h5 class="mb-1">Admin Panel</h5>
        <small class="text-muted">EventEase</small>
    </div>
    <div class="list-group list-group-flush">
        <a href="dashboard.php" class="list-group-item list-group-item-action <?php echo $active_page === 'dashboard.php' ? 'active' : ''; ?>">Dashboard</a>
        <a href="add_event.php" class="list-group-item list-group-item-action <?php echo $active_page === 'add_event.php' ? 'active' : ''; ?>">Add Event</a>
        <a href="view_events.php" class="list-group-item list-group-item-action <?php echo $active_page === 'view_events.php' ? 'active' : ''; ?>">Manage Events</a>
        <a href="view_registrations.php" class="list-group-item list-group-item-action <?php echo $active_page === 'view_registrations.php' ? 'active' : ''; ?>">Registrations</a>
        <a href="view_service_requests.php" class="list-group-item list-group-item-action <?php echo $active_page === 'view_service_requests.php' ? 'active' : ''; ?>">Service Requests</a>
        <a href="reports.php" class="list-group-item list-group-item-action <?php echo $active_page === 'reports.php' ? 'active' : ''; ?>">Reports</a>
        <a href="../logout.php" class="list-group-item list-group-item-action text-danger" onclick="return confirm('Are you sure you want to logout?')">Logout</a>
    </div>
</div>
