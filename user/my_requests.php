<?php
session_start();
include("../includes/access_control.php");
require_role("user");
include("../includes/db.php");

$user_id = (int)$_SESSION['user_id'];
$statement = $conn->prepare("SELECT id, event_type, event_date, venue, guests, status FROM service_requests WHERE user_id = ? ORDER BY id DESC");
$statement->bind_param("i", $user_id);
$statement->execute();
$requests = $statement->get_result();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>My Requests - EventEase</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="../assets/css/style.css">
	<link rel="icon" href="../events/logo.png" type="image/png">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
</head>
<body>
	<?php include '../includes/navbar.php'; ?>
	<div class="container py-5">
		<div class="row g-4">
			<div class="col-lg-3">
				<?php include '../includes/user_sidebar.php'; ?>
			</div>
			<div class="col-lg-9">
				<div class="card border-0 shadow-sm rounded-4 p-4">
					<div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-3">
						<div>
							<h1 class="h3 fw-bold mb-1">My Service Requests</h1>
							<p class="text-muted mb-0">Review the status of your event service requests.</p>
						</div>
						<a href="service_request.php" class="btn btn-primary">New Request</a>
					</div>
					<?php if ($requests->num_rows === 0): ?>
						<div class="text-center py-5">
							<i class="fa-solid fa-clipboard-list text-primary fs-2 mb-3"></i>
							<h2 class="h5 fw-semibold">No requests yet</h2>
							<p class="text-muted">Your service requests will appear here after you submit one.</p>
							<a href="service_request.php" class="btn btn-outline-primary">Request a Service</a>
						</div>
					<?php else: ?>
						<div class="table-responsive">
							<table class="table align-middle modern-table">
								<thead>
									<tr><th>Event Type</th><th>Date</th><th>Venue</th><th>Guests</th><th>Status</th></tr>
								</thead>
								<tbody>
									<?php while ($request = $requests->fetch_assoc()): ?>
										<tr>
											<td><?php echo htmlspecialchars($request['event_type']); ?></td>
											<td><?php echo htmlspecialchars($request['event_date']); ?></td>
											<td><?php echo htmlspecialchars($request['venue']); ?></td>
											<td><?php echo (int)$request['guests']; ?></td>
											<td><span class="badge bg-soft-primary text-primary"><?php echo htmlspecialchars($request['status']); ?></span></td>
										</tr>
									<?php endwhile; ?>
								</tbody>
							</table>
						</div>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
	<?php include '../includes/footer.php'; ?>
</body>
</html>
