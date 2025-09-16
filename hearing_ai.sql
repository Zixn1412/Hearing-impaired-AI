CREATE DATABASE IF NOT EXISTS hearing_ai CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE hearing_ai;

CREATE TABLE IF NOT EXISTS gifs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    path VARCHAR(500) NOT NULL
);

INSERT INTO gifs (name, path) VALUES 
('สวัสดี', 'gifs/สวัสดี.gif'),
('ขอบคุณ', 'gifs/ขอบคุณ.gif'),
('ลาก่อน', 'gifs/ลาก่อน.gif'),
('หิว', 'gifs/หิว.gif'),
('ยินดี', 'gifs/ยินดี.gif'),
('เสียใจ', 'gifs/เสียใจ.gif'),
('โชคดี', 'gifs/โชคดี.gif'),
('ชอบ', 'gifs/ชอบ.gif');
