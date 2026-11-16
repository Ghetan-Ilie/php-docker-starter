-- Runs automatically once, the first time the database is created.
SET NAMES utf8mb4;

CREATE TABLE IF NOT EXISTS messages (
    id         INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    author     VARCHAR(100) NOT NULL,
    content    VARCHAR(500) NOT NULL,
    created_at TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO messages (author, content) VALUES
    ('Admin',  'Welcome! The database is working.'),
    ('Maria',  'My first message saved in MySQL.'),
    ('Andrew', 'PHP, MySQL and CloudBeaver are running in Docker.');
