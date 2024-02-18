
CREATE TABLE IF NOT EXISTS notes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    description TEXT,
    date DATE,
    time TIME,
    status ENUM('erledigt', 'nicht erledigt') NOT NULL DEFAULT 'nicht erledigt'
    );
