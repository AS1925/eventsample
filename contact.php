<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - EventEase</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" href="events/logo.png" type="image/png">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
</head>
<body>
    <?php include 'includes/navbar.php'; ?>
    <section class="py-5">
        <div class="container py-4">
            <div class="row g-4 align-items-stretch">
                <div class="col-lg-5">
                    <div class="card border-0 shadow-sm rounded-4 p-4 h-100">
                        <div class="brand-pill mb-3"><i class="fa-solid fa-headset"></i> Get in touch</div>
                        <h2 class="fw-bold mb-3">We’re here to help with every event detail.</h2>
                        <p class="text-muted">Whether you need help planning a wedding, a corporate meetup, or a private celebration, our team is ready to assist.</p>
                        <div class="d-flex flex-column gap-3 mt-4">
                            <div class="info-box"><i class="fa-solid fa-location-dot"></i><div><h6 class="mb-1">Visit us</h6><p class="mb-0 text-muted">123 Celebration Avenue, Colombo</p></div></div>
                            <div class="info-box"><i class="fa-solid fa-phone"></i><div><h6 class="mb-1">Call us</h6><p class="mb-0 text-muted">+94 71 234 5678</p></div></div>
                            <div class="info-box"><i class="fa-solid fa-envelope"></i><div><h6 class="mb-1">Email</h6><p class="mb-0 text-muted">hello@eventease.com</p></div></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="card border-0 shadow-sm rounded-4 p-4 p-lg-5">
                        <h3 class="fw-bold mb-3">Send a message</h3>
                        <form>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label">Name</label>
                                    <input type="text" class="form-control" placeholder="Your full name">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Email</label>
                                    <input type="email" class="form-control" placeholder="Your email address">
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Subject</label>
                                    <input type="text" class="form-control" placeholder="How can we help?">
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Message</label>
                                    <textarea class="form-control" rows="5" placeholder="Tell us about your plans"></textarea>
                                </div>
                            </div>
                            <button type="button" class="btn btn-primary mt-4">Send Message</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php include 'includes/footer.php'; ?>
</body>
</html>