<?php
function require_role($required_role)
{
    if (!isset($_SESSION['user_id'])) {
        header("Location: ../login.php");
        exit();
    }

    $role = $_SESSION['role'] ?? "";
    if ($role !== $required_role) {
        $dashboard = $role === 'admin'
            ? "../admin/dashboard.php"
            : "../user/dashboard.php";
        header("Location: " . $dashboard);
        exit();
    }
}