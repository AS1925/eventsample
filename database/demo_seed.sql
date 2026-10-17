-- Local-only demo fixtures for the EventEase database.
-- Demo User: demo.user@eventease.test / EventEaseDemo2026
-- Demo Admin: demo.admin@eventease.test / EventEaseAdmin2026
-- Demo Signup User: demo.signup@eventease.test / EventEaseSignup2026
-- This script only inserts missing rows and does not overwrite existing records.
-- Run database/admin_features.sql first to create editable content and event review tables.

INSERT INTO users (name, email, phone, password, role)
SELECT 'Demo User', 'demo.user@eventease.test', '0710000001', '$2y$10$jN8VjmE2qSJ5uV98HDqqC.rHIFb8pSYBbIzc5ehS0fhFzFHYW6rFq', 'user'
WHERE NOT EXISTS (SELECT 1 FROM users WHERE email = 'demo.user@eventease.test');

INSERT INTO users (name, email, phone, password, role)
SELECT 'Demo Admin', 'demo.admin@eventease.test', '0710000002', '$2y$10$Coqmaj27iYioyw40XgEIxOHHnHQPuPVaafRwGXjAIvBBvG/TYDwGi', 'admin'
WHERE NOT EXISTS (SELECT 1 FROM users WHERE email = 'demo.admin@eventease.test');

INSERT INTO users (name, email, phone, password, role)
SELECT 'Demo Signup', 'demo.signup@eventease.test', '0710000003', '$2y$10$OlJ18cS/kHOMqnHLD0QAH.d3G0arTSqODICJyvI2XQj9JIf5BiQR.', 'user'
WHERE NOT EXISTS (SELECT 1 FROM users WHERE email = 'demo.signup@eventease.test');

INSERT INTO events (event_name, event_type, event_date, event_time, venue, description, max_participants, image)
SELECT 'EventEase Demo Gala', 'Wedding', '2026-12-15', '18:30:00', 'EventEase Demo Venue', 'A sample future event for testing event details and user dashboards.', 25, 'g1.jpg'
WHERE NOT EXISTS (SELECT 1 FROM events WHERE event_name = 'EventEase Demo Gala' AND event_date = '2026-12-15');

INSERT INTO events (event_name, event_type, event_date, event_time, venue, description, max_participants, image)
SELECT 'EventEase Demo Booking', 'Conference', '2026-12-20', '10:00:00', 'EventEase Demo Hall', 'An open sample event for testing the registration confirmation flow.', 20, 'g2.jpg'
WHERE NOT EXISTS (SELECT 1 FROM events WHERE event_name = 'EventEase Demo Booking' AND event_date = '2026-12-20');

INSERT INTO events (event_name, event_type, event_date, event_time, venue, description, max_participants, image)
SELECT 'EventEase Completed Review Demo', 'Conference', '2026-10-16', '18:00:00', 'EventEase Demo Hall', 'A completed sample event for testing attendance and review approval.', 30, 'g3.jpg'
WHERE NOT EXISTS (SELECT 1 FROM events WHERE event_name = 'EventEase Completed Review Demo' AND event_date = '2026-10-16');

INSERT INTO registrations (user_id, event_id)
SELECT users.id, events.id
FROM users
JOIN events ON events.event_name = 'EventEase Demo Gala' AND events.event_date = '2026-12-15'
WHERE users.email = 'demo.user@eventease.test'
AND NOT EXISTS (
    SELECT 1 FROM registrations
    WHERE registrations.user_id = users.id AND registrations.event_id = events.id
);

INSERT INTO registrations (user_id, event_id, status)
SELECT users.id, events.id, 'Attended'
FROM users
JOIN events ON events.event_name = 'EventEase Completed Review Demo' AND events.event_date = '2026-10-16'
WHERE users.email = 'demo.user@eventease.test'
AND NOT EXISTS (
    SELECT 1 FROM registrations
    WHERE registrations.user_id = users.id AND registrations.event_id = events.id
);

INSERT INTO registrations (user_id, event_id, status)
SELECT users.id, events.id, 'Attended'
FROM users
JOIN events ON events.event_name = 'EventEase Completed Review Demo' AND events.event_date = '2026-10-16'
WHERE users.email = 'demo.signup@eventease.test'
AND NOT EXISTS (
    SELECT 1 FROM registrations
    WHERE registrations.user_id = users.id AND registrations.event_id = events.id
);

INSERT INTO event_reviews (event_id, user_id, rating, review_text, status)
SELECT events.id, users.id, 5, 'The demo event was well organized and enjoyable.', 'Pending'
FROM events
JOIN users ON users.email = 'demo.signup@eventease.test'
WHERE events.event_name = 'EventEase Completed Review Demo'
AND events.event_date = '2026-10-16'
AND NOT EXISTS (
    SELECT 1 FROM event_reviews
    WHERE event_reviews.event_id = events.id AND event_reviews.user_id = users.id
);

INSERT INTO service_requests (user_id, event_type, event_date, venue, guests, decoration, photography, catering, dj, additional_requirements, status)
SELECT users.id, 'Birthday', '2026-12-22', 'EventEase Demo Garden', 60, 'Yes', 'Yes', 'Yes', 'No', 'Seeded request for testing the user and admin request-status flow.', 'Pending'
FROM users
WHERE users.email = 'demo.user@eventease.test'
AND NOT EXISTS (
    SELECT 1 FROM service_requests
    WHERE service_requests.user_id = users.id
    AND service_requests.venue = 'EventEase Demo Garden'
    AND service_requests.event_date = '2026-12-22'
);
