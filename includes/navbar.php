<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$base_path = (strpos($_SERVER['PHP_SELF'], '/admin/') !== false || strpos($_SERVER['PHP_SELF'], '/user/') !== false) ? '../' : '';
$logo_path = $base_path . 'events/logo.png';
$home_link = $base_path . 'index.php';
$events_link = $base_path . 'events.php';
$about_link = $base_path . 'about.php';
$contact_link = $base_path . 'contact.php';
$login_link = $base_path . 'login.php';
$register_link = $base_path . 'register.php';
$logout_link = $base_path . 'logout.php';
$dashboard_link = isset($_SESSION['role']) && $_SESSION['role'] === 'admin'
    ? $base_path . 'admin/dashboard.php'
    : $base_path . 'user/dashboard.php';
$current_page = basename($_SERVER['PHP_SELF']);
$logged_in = isset($_SESSION['user_id']);
$is_admin = $logged_in && isset($_SESSION['role']) && $_SESSION['role'] === 'admin';
?>
<nav class="navbar navbar-expand-lg navbar-dark sticky-top custom-nav <?php echo $is_admin ? 'admin-nav' : ''; ?>">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center" href="<?php echo $home_link; ?>">
            <img src="<?php echo $logo_path; ?>" width="48" height="48" class="me-2 rounded-circle" alt="EventEase logo">
            <span class="logo-text">EventEase</span>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainMenu" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="mainMenu">
            <ul class="navbar-nav ms-auto align-items-lg-center gap-lg-2">
                <?php if ($is_admin): ?>
                    <li class="nav-item"><a class="nav-link <?php echo strpos($_SERVER['PHP_SELF'], '/admin/') !== false ? 'active' : ''; ?>" href="<?php echo $base_path; ?>admin/dashboard.php"><i class="fa-solid fa-gauge-high me-1"></i>Admin Console</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?php echo $home_link; ?>"><i class="fa-solid fa-arrow-up-right-from-square me-1"></i>View Site</a></li>
                    <li class="nav-item ms-lg-3"><a class="btn btn-warning btn-sm" href="<?php echo $logout_link; ?>" onclick="return confirm('Are you sure you want to logout?')"><i class="fa-solid fa-right-from-bracket me-2"></i>Logout</a></li>
                <?php else: ?>
                <li class="nav-item"><a class="nav-link <?php echo $current_page === 'index.php' ? 'active' : ''; ?>" href="<?php echo $home_link; ?>"><i class="fa-solid fa-house me-1"></i>Home</a></li>
                <li class="nav-item"><a class="nav-link <?php echo $current_page === 'about.php' ? 'active' : ''; ?>" href="<?php echo $about_link; ?>"><i class="fa-solid fa-circle-info me-1"></i>About</a></li>
                <li class="nav-item"><a class="nav-link <?php echo $current_page === 'events.php' ? 'active' : ''; ?>" href="<?php echo $events_link; ?>"><i class="fa-solid fa-calendar-days me-1"></i>Events</a></li>
                <li class="nav-item"><a class="nav-link <?php echo $current_page === 'contact.php' ? 'active' : ''; ?>" href="<?php echo $contact_link; ?>"><i class="fa-solid fa-envelope me-1"></i>Contact</a></li>
                <?php if ($logged_in): ?>
                    <li class="nav-item ms-lg-3"><a class="btn btn-outline-light btn-sm" href="<?php echo $dashboard_link; ?>"><i class="fa-solid fa-gauge me-2"></i><?php echo $_SESSION['role'] === 'admin' ? 'Admin Console' : 'Dashboard'; ?></a></li>
                    <li class="nav-item ms-2"><a class="btn btn-warning btn-sm" href="<?php echo $logout_link; ?>" onclick="return confirm('Are you sure you want to logout?')"><i class="fa-solid fa-right-from-bracket me-2"></i>Logout</a></li>
                <?php else: ?>
                    <li class="nav-item ms-lg-3"><a class="btn btn-outline-light btn-sm" href="<?php echo $login_link; ?>"><i class="fa-solid fa-right-to-bracket me-2"></i>Login</a></li>
                    <li class="nav-item ms-2"><a class="btn btn-warning btn-sm" href="<?php echo $register_link; ?>"><i class="fa-solid fa-user-plus me-2"></i>Register</a></li>
                <?php endif; ?>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>
<main class="page-shell">
