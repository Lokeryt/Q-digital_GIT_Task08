CREATE TABLE IF NOT EXISTS versions
(
      id INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
      name VARCHAR(255) NOT NULL,
      created TIMESTAMP DEFAULT current_timestamp,
      primary key (id)
)
ENGINE = innodb
AUTO_INCREMENT = 1
CHARACTER SET utf8
COLLATE utf8_general_ci;