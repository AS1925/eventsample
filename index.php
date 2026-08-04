<?php
session_start();
include("includes/db.php");

/* Upcoming Events */
$query = mysqli_query($conn, "
SELECT *
FROM events
ORDER BY event_date ASC
LIMIT 3
");

/* Statistics */

$total_events = mysqli_fetch_assoc(
    mysqli_query($conn, "
SELECT COUNT(*) AS total
FROM events
")
);

$total_users = mysqli_fetch_assoc(
    mysqli_query($conn, "
SELECT COUNT(*) AS total
FROM users
")
);

$total_registrations = mysqli_fetch_assoc(
    mysqli_query($conn, "
SELECT COUNT(*) AS total
FROM registrations
")
);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EventEase - Event Management & Service Booking</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" href="events/logo.png" type="image/png">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
</head>

<body>
    <?php include 'includes/navbar.php'; ?>
    <section class="hero">

        <div class="container">

            <div class="row align-items-center">

                <div class="col-lg-6">

                    <h5 class="hero-sub">

                        WELCOME TO EVENTEASE

                    </h5>

                    <h1 class="hero-title">

                        Creating

                        <span>

                            Unforgettable

                        </span>

                        Moments

                    </h1>

                    <p class="hero-text">

                        Plan your weddings,
                        birthdays,
                        corporate meetings
                        and celebrations effortlessly.

                        Book decorations,
                        photography,
                        DJ,
                        catering,
                        and much more
                        all in one place.

                    </p>

                    <div class="mt-4">

                        <a href="events.php" class="btn btn-warning btn-lg">

                            Explore Events

                        </a>

                        <a href="register.php" class="btn btn-light btn-lg ms-2">

                            Get Started

                        </a>

                    </div>

                </div>

                <div class="col-lg-6 text-center">

                    <img src="events/event1.png" class="img-fluid hero-image">

                </div>

            </div>

        </div>

    </section>
    <!--================ ABOUT ================-->

    <section class="about-section py-5" id="about">

        <div class="container">

            <div class="text-center mb-5">

                <h6 class="section-subtitle">
                    ABOUT US
                </h6>

                <h2 class="section-title">
                    Making Every Celebration
                    <span>Extraordinary</span>
                </h2>

                <p class="section-text">

                    EventEase is an online Event Management &
                    Service Booking platform designed to make
                    planning effortless.

                    From weddings and birthdays to corporate
                    events, we connect customers with trusted
                    services like decoration, photography,
                    catering, DJ, and stage setup—all in one
                    place.

                </p>

            </div>

            <div class="row align-items-center">

                <div class="col-lg-6">

                    <img src="events/about.jpg" class="img-fluid rounded-4 shadow-lg">

                </div>

                <div class="col-lg-6">

                    <div class="glass-card">

                        <h3>Why EventEase?</h3>

                        <p>

                            We simplify the entire event planning
                            process through a secure and user-friendly
                            platform.

                            Whether you're organizing a birthday,
                            wedding, corporate seminar, or cultural
                            event, EventEase helps you manage everything
                            efficiently.

                        </p>

                        <div class="row mt-4">

                            <div class="col-6 mb-3">

                                <div class="feature-box">

                                    <i class="fas fa-calendar-check"></i>

                                    <h5>Easy Booking</h5>

                                </div>

                            </div>

                            <div class="col-6 mb-3">

                                <div class="feature-box">

                                    <i class="fas fa-user-shield"></i>

                                    <h5>Secure Platform</h5>

                                </div>

                            </div>

                            <div class="col-6">

                                <div class="feature-box">

                                    <i class="fas fa-star"></i>

                                    <h5>Trusted Services</h5>

                                </div>

                            </div>

                            <div class="col-6">

                                <div class="feature-box">

                                    <i class="fas fa-headset"></i>

                                    <h5>24×7 Support</h5>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </section>
    <!--================ SERVICES ================-->

    <section class="services-section py-5" id="services">

        <div class="container">

            <div class="text-center mb-5">

                <h6 class="section-subtitle">
                    OUR SERVICES
                </h6>

                <h2 class="section-title">
                    Everything You Need For A
                    <span>Perfect Event</span>
                </h2>

                <p class="section-text">

                    From venue decoration to photography,
                    EventEase provides complete event planning
                    services under one platform.

                </p>

            </div>

            <div class="row g-4">

                <div class="col-lg-4 col-md-6">

                    <div class="service-card">

                        <div class="service-icon">

                            <i class="fas fa-ring"></i>

                        </div>

                        <h3>Wedding Planning</h3>

                        <p>

                            Complete wedding planning including
                            decoration, stage setup,
                            photography and catering.

                        </p>

                    </div>

                </div>

                <div class="col-lg-4 col-md-6">

                    <div class="service-card">

                        <div class="service-icon">

                            <i class="fas fa-birthday-cake"></i>

                        </div>

                        <h3>Birthday Events</h3>

                        <p>

                            Celebrate birthdays with beautiful
                            decorations, cakes,
                            music and entertainment.

                        </p>

                    </div>

                </div>

                <div class="col-lg-4 col-md-6">

                    <div class="service-card">

                        <div class="service-icon">

                            <i class="fas fa-camera"></i>

                        </div>

                        <h3>Photography</h3>

                        <p>

                            Professional photographers
                            to capture every beautiful
                            moment of your event.

                        </p>

                    </div>

                </div>

                <div class="col-lg-4 col-md-6">

                    <div class="service-card">

                        <div class="service-icon">

                            <i class="fas fa-utensils"></i>

                        </div>

                        <h3>Catering</h3>

                        <p>

                            Delicious food menus with
                            professional catering
                            services.

                        </p>

                    </div>

                </div>

                <div class="col-lg-4 col-md-6">

                    <div class="service-card">

                        <div class="service-icon">

                            <i class="fas fa-music"></i>

                        </div>

                        <h3>DJ & Music</h3>

                        <p>

                            Professional DJ,
                            sound systems
                            and live music arrangements.

                        </p>

                    </div>

                </div>

                <div class="col-lg-4 col-md-6">

                    <div class="service-card">

                        <div class="service-icon">

                            <i class="fas fa-lightbulb"></i>

                        </div>

                        <h3>Lighting & Stage</h3>

                        <p>

                            Creative lighting,
                            LED walls and
                            modern stage setup.

                        </p>

                    </div>

                </div>

            </div>

        </div>

    </section>
    <!--================ STATISTICS ================-->

<section class="stats-section">

<div class="container">

<div class="row text-center">

<div class="col-lg-3 col-6">

<div class="stat-box">

<i class="fas fa-calendar-check"></i>

<h2 class="counter">

<?php echo $total_events['total']; ?>

</h2>

<p>Total Events</p>

</div>

</div>

<div class="col-lg-3 col-6">

<div class="stat-box">

<i class="fas fa-users"></i>

<h2 class="counter">

<?php echo $total_users['total']; ?>

</h2>

<p>Registered Users</p>

</div>

</div>

<div class="col-lg-3 col-6">

<div class="stat-box">

<i class="fas fa-ticket-alt"></i>

<h2 class="counter">

<?php echo $total_registrations['total']; ?>

</h2>

<p>Bookings</p>

</div>

</div>

<div class="col-lg-3 col-6">

<div class="stat-box">

<i class="fas fa-headset"></i>

<h2>

24/7

</h2>

<p>Support</p>

</div>

</div>

</div>

</div>

</section>
<!--================ UPCOMING EVENTS =================-->

<section class="upcoming-events py-5" id="events">

<div class="container">

<div class="text-center mb-5">

<h6 class="section-subtitle">
UPCOMING EVENTS
</h6>

<h2 class="section-title">

Discover Our

<span>Upcoming Events</span>

</h2>

<p class="section-text">

Register now and be a part of exciting
events organized by EventEase.

</p>

</div>

<div class="row">

<?php

while($row=mysqli_fetch_assoc($query))
{

$registered=mysqli_fetch_assoc(

mysqli_query($conn,"
SELECT COUNT(*) AS total
FROM registrations
WHERE event_id='".$row['id']."'
")

);

$available=
$row['max_participants']
-
$registered['total'];

?>

<div class="col-lg-4 mb-4">

<div class="event-card">

<img
src="events/<?php echo $row['image'];?>"
class="event-img">

<div class="event-content">

<span class="badge bg-warning">

<?php echo $row['event_type'];?>

</span>

<h3>

<?php echo $row['event_name'];?>

</h3>

<p>

<?php echo substr($row['description'],0,90);?>

...

</p>

<div class="event-info">

<p>

<i class="fas fa-calendar"></i>

<?php echo $row['event_date'];?>

</p>

<p>

<i class="fas fa-location-dot"></i>

<?php echo $row['venue'];?>

</p>

<p>

<i class="fas fa-users"></i>

Seats Left:

<?php echo $available;?>

</p>

</div>

<a

<?php

if(isset($_SESSION['user_id']))
{

?>

<a
href="register_event.php?id=<?php echo $row['id'];?>"
class="btn btn-warning w-100">

Register Now

</a>

<?php

}

else

{

?>

<a
href="login.php"
class="btn btn-primary w-100">

Login to Register

</a>

<?php

}

?>

</a>

</div>

</div>

</div>

<?php

}

?>

</div>

</div>

</section>
<!--================ GALLERY =================-->

<section class="gallery-section py-5">

<div class="container">

<div class="text-center mb-5">

<h6 class="section-subtitle">

OUR GALLERY

</h6>

<h2 class="section-title">

Captured

<span>Memories</span>

</h2>

<p class="section-text">

A glimpse of our successful events,
beautiful decorations,
and unforgettable celebrations.

</p>

</div>

<div class="row g-4">

<div class="col-lg-3 col-md-6">

<div class="gallery-card">

<img src="events/g1.jpg">

<div class="overlay">

<i class="fas fa-search-plus"></i>

</div>

</div>

</div>

<div class="col-lg-3 col-md-6">

<div class="gallery-card">

<img src="events/g2.jpg">

<div class="overlay">

<i class="fas fa-search-plus"></i>

</div>

</div>

</div>

<div class="col-lg-3 col-md-6">

<div class="gallery-card">

<img src="events/g3.jpg">

<div class="overlay">

<i class="fas fa-search-plus"></i>

</div>

</div>

</div>

<div class="col-lg-3 col-md-6">

<div class="gallery-card">

<img src="images/gallery/gallery4.jpg">

<div class="overlay">

<i class="fas fa-search-plus"></i>

</div>

</div>

</div>

<div class="col-lg-3 col-md-6">

<div class="gallery-card">

<img src="images/gallery/gallery5.jpg">

<div class="overlay">

<i class="fas fa-search-plus"></i>

</div>

</div>

</div>

<div class="col-lg-3 col-md-6">

<div class="gallery-card">

<img src="images/gallery/gallery6.jpg">

<div class="overlay">

<i class="fas fa-search-plus"></i>

</div>

</div>

</div>

<div class="col-lg-3 col-md-6">

<div class="gallery-card">

<img src="images/gallery/gallery7.jpg">

<div class="overlay">

<i class="fas fa-search-plus"></i>

</div>

</div>

</div>

<div class="col-lg-3 col-md-6">

<div class="gallery-card">

<img src="images/gallery/gallery8.jpg">

<div class="overlay">

<i class="fas fa-search-plus"></i>

</div>

</div>

</div>

</div>

</div>

</section>
<!--================ TESTIMONIALS =================-->

<section class="testimonial-section py-5">

<div class="container">

<div class="text-center mb-5">

<h6 class="section-subtitle">
TESTIMONIALS
</h6>

<h2 class="section-title">

What Our

<span>Clients Say</span>

</h2>

<p class="section-text">

Hear from customers who trusted
EventEase to make their celebrations
memorable.

</p>

</div>

<div id="testimonialCarousel"
class="carousel slide"
data-bs-ride="carousel">

<div class="carousel-inner">

<!-- Testimonial 1 -->

<div class="carousel-item active">

<div class="testimonial-card">

<img src="images/client1.jpg"
class="client-img">

<h4>Priya Sharma</h4>

<p class="client-role">

Wedding Client

</p>

<div class="stars">

★★★★★

</div>

<p>

"The decoration and photography
were outstanding.
Everything was perfectly organized."

</p>

</div>

</div>

<!-- Testimonial 2 -->

<div class="carousel-item">

<div class="testimonial-card">

<img src="images/client2.jpg"
class="client-img">

<h4>Rahul Kumar</h4>

<p class="client-role">

Corporate Event

</p>

<div class="stars">

★★★★★

</div>

<p>

"Our annual meeting was managed
professionally from start to finish.
Highly recommended."

</p>

</div>

</div>

<!-- Testimonial 3 -->

<div class="carousel-item">

<div class="testimonial-card">

<img src="images/client3.jpg"
class="client-img">

<h4>Ananya</h4>

<p class="client-role">

Birthday Celebration

</p>

<div class="stars">

★★★★★

</div>

<p>

"The booking process was simple,
and the decorations exceeded
our expectations."

</p>

</div>

</div>

</div>

<button
class="carousel-control-prev"
type="button"
data-bs-target="#testimonialCarousel"
data-bs-slide="prev">

<span class="carousel-control-prev-icon"></span>

</button>

<button
class="carousel-control-next"
type="button"
data-bs-target="#testimonialCarousel"
data-bs-slide="next">

<span class="carousel-control-next-icon"></span>

</button>

</div>

</div>

</section>
<!--================ CONTACT =================-->

<section class="contact-section py-5" id="contact">

<div class="container">

<div class="text-center mb-5">

<h6 class="section-subtitle">

CONTACT US

</h6>

<h2 class="section-title">

Let's Plan Your

<span>Next Event</span>

</h2>

<p class="section-text">

Have questions or need assistance?
Our team is ready to help you create unforgettable experiences.

</p>

</div>

<div class="row">

<div class="col-lg-5">

<div class="contact-info">

<div class="info-box">

<i class="fas fa-location-dot"></i>

<div>

<h5>Office</h5>

<p>Chennai, Tamil Nadu, India</p>

</div>

</div>

<div class="info-box">

<i class="fas fa-phone"></i>

<div>

<h5>Phone</h5>

<p>+91 98765 43210</p>

</div>

</div>

<div class="info-box">

<i class="fas fa-envelope"></i>

<div>

<h5>Email</h5>

<p>support@eventease.com</p>

</div>

</div>

<div class="info-box">

<i class="fas fa-clock"></i>

<div>

<h5>Working Hours</h5>

<p>Mon - Sat : 9 AM - 7 PM</p>

</div>

</div>

</div>

</div>

<div class="col-lg-7">

<div class="contact-card">

<h3>Need Event Services?</h3>

<p>

To request decoration,
photography,
DJ,
lighting,
or catering services,

please login and submit a
Service Request through your dashboard.

</p>

<a href="login.php"
class="btn btn-warning btn-lg mt-3">

Request a Service

</a>

</div>

</div>

</div>

</div>

</section>
<?php include 'includes/footer.php'; ?>
</body>