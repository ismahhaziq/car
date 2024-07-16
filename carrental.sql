-- Create User Table
CREATE TABLE `user` (
    `user_id` INT AUTO_INCREMENT PRIMARY KEY,
    `username` VARCHAR(50) NOT NULL,
    `password` VARCHAR(255) NOT NULL,
    `email` VARCHAR(100) NOT NULL,
    `phone` VARCHAR(15),
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Create Car Table
CREATE TABLE `car` (
    `car_id` INT AUTO_INCREMENT PRIMARY KEY,
    `model` VARCHAR(100) NOT NULL,
    `brand` VARCHAR(100) NOT NULL,
    `price_per_day` DECIMAL(10, 2) NOT NULL,
    `description` TEXT,
    `available` BOOLEAN DEFAULT TRUE,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Create Bookings Table
CREATE TABLE `bookings` (
    `booking_id` INT AUTO_INCREMENT PRIMARY KEY,
    `user_id` INT NOT NULL,
    `car_id` INT NOT NULL,
    `pickup_date` DATE NOT NULL,
    `return_date` DATE NOT NULL,
    `status` VARCHAR(50) DEFAULT 'Pending',
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (`user_id`) REFERENCES `user`(`user_id`),
    FOREIGN KEY (`car_id`) REFERENCES `car`(`car_id`)
);

-- Create Payment Table
CREATE TABLE `payment` (
    `payment_id` INT AUTO_INCREMENT PRIMARY KEY,
    `booking_id` INT NOT NULL,
    `amount` DECIMAL(10, 2) NOT NULL,
    `payment_date` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `payment_method` VARCHAR(50),
    `status` VARCHAR(50) DEFAULT 'Completed',
    FOREIGN KEY (`booking_id`) REFERENCES `bookings`(`booking_id`)
);

-- Create Admin Table
CREATE TABLE `admin` (
    `admin_id` INT AUTO_INCREMENT PRIMARY KEY,
    `username` VARCHAR(50) NOT NULL,
    `password` VARCHAR(255) NOT NULL,
    `email` VARCHAR(100) NOT NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
