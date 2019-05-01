DROP DATABASE IF EXISTS vue_students;
CREATE DATABASE IF NOT EXISTS vue_students CHARACTER SET UTF8MB4;

use vue_students;

CREATE TABLE students(
    id INT UNSIGNED AUTO_INCREMENT,
    name VARCHAR(50) NOT NULL,
    email VARCHAR(50) NOT NULL,
    web VARCHAR(100),
    created_at DATETIME DEFAULT NOW(),
    CONSTRAINT pk_students PRIMARY KEY (id),
    CONSTRAINT uk_students UNIQUE (email)
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*INSERT INTO students (NAME,email) VALUES ('Testing Man','testing.man.1930@gmail.com');

UPDATE students SET web = 'https://materializecss.com/grid.html' WHERE id = 1;

SELECT * FROM students WHERE web IS NOT NULL;*/