-- Run once against the EventEase sakthi database to enable editable page copy and event reviews.

CREATE TABLE IF NOT EXISTS page_content (
    content_key VARCHAR(100) NOT NULL,
    content_value TEXT NOT NULL,
    updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (content_key)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE IF NOT EXISTS event_reviews (
    id INT NOT NULL AUTO_INCREMENT,
    event_id INT NOT NULL,
    user_id INT NOT NULL,
    rating TINYINT NOT NULL,
    review_text TEXT NOT NULL,
    status ENUM('Pending', 'Published', 'Rejected') NOT NULL DEFAULT 'Pending',
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id),
    UNIQUE KEY unique_event_review (event_id, user_id),
    KEY event_review_status (status),
    KEY event_review_user (user_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT IGNORE INTO page_content (content_key, content_value) VALUES
('home_hero_eyebrow', 'WELCOME TO EVENTEASE'),
('home_hero_title', 'Creating'),
('home_hero_highlight', 'Unforgettable'),
('home_hero_suffix', 'Moments'),
('home_hero_description', 'Plan your weddings, birthdays, corporate meetings and celebrations effortlessly. Book decorations, photography, DJ, catering, and much more all in one place.'),
('home_about_title', 'Making Every Celebration'),
('home_about_highlight', 'Extraordinary'),
('home_about_description', 'EventEase is an online event management and service booking platform designed to make planning effortless. From weddings and birthdays to corporate events, we connect customers with trusted services like decoration, photography, catering, DJ, and stage setup, all in one place.'),
('about_title', 'Crafting polished experiences for every celebration.'),
('about_description', 'EventEase combines event discovery, registration, and service requests into one elegant platform designed for modern planners and guests.');
