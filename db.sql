-- Create the database
CREATE DATABASE IF NOT EXISTS museum_management;
USE museum_management;

-- Create Employees table
CREATE TABLE Employees (
   Id         int PRIMARY KEY AUTO_INCREMENT,
   FirstName  varchar(250) NOT NULL,
   LastName   varchar(250) NOT NULL,
   Sin        int NOT NULL UNIQUE,
   position   varchar(250) NOT NULL
);

-- Create Events table
CREATE TABLE Events (
   Id          int PRIMARY KEY AUTO_INCREMENT,
   title       varchar(250) NOT NULL,
   eventDate   datetime NOT NULL,
   tickets     varchar(250),
   description text,
   image       varchar(250)
);

-- Create Exhibitions table
CREATE TABLE Exhibitions (
   Id          int PRIMARY KEY AUTO_INCREMENT,
   title       varchar(250) NOT NULL,
   startDate   datetime NOT NULL,
   endDate     datetime NOT NULL,
   description text,
   image       varchar(250)
);

-- Create Tours table
CREATE TABLE Tours (
   Id          int PRIMARY KEY AUTO_INCREMENT,
   title       varchar(250) NOT NULL,
   tourDate    datetime NOT NULL,
   audience    varchar(250),
   tourguide   int,
   FOREIGN KEY (tourguide) REFERENCES Employees(Id)
);

-- Create Blogs table
CREATE TABLE Blogs (
   Id          int PRIMARY KEY AUTO_INCREMENT,
   title       varchar(250) NOT NULL,
   description text,
   datePosted  datetime DEFAULT CURRENT_TIMESTAMP,
   author      int,
   FOREIGN KEY (author) REFERENCES Employees(Id)
);

-- Create Users table
CREATE TABLE Users (
   Id          int PRIMARY KEY AUTO_INCREMENT,
   firstname   varchar(25) NOT NULL,
   lastname    varchar(25) NOT NULL,
   email       varchar(100) NOT NULL UNIQUE,
   password    varchar(100) NOT NULL,
   active      ENUM('yes', 'no') DEFAULT 'yes',
   dateAdded   datetime DEFAULT CURRENT_TIMESTAMP
);

-- Insert dummy data into Employees
INSERT INTO Employees (FirstName, LastName, Sin, position) VALUES
('John', 'Smith', 123456789, 'Curator'),
('Emily', 'Johnson', 987654321, 'Tour Guide'),
('Michael', 'Williams', 456123789, 'Event Coordinator'),
('Sarah', 'Brown', 789456123, 'Marketing Manager'),
('David', 'Jones', 321654987, 'Archivist');

-- Insert dummy data into Events
INSERT INTO Events (title, eventDate, tickets, description, image) VALUES
('Ancient Artifacts Night', '2023-06-15 18:00:00', '$20', 'An evening exploring ancient artifacts from around the world', 'ancient.jpg'),
('Science Fair', '2023-07-22 10:00:00', 'Free', 'Interactive science exhibits for all ages', 'science.jpg'),
('Music Under the Stars', '2023-08-05 19:30:00', '$35', 'Outdoor concert featuring classical music', 'music.jpg'),
('Family Day', '2023-09-12 09:00:00', '$10 per family', 'Special activities for families with children', 'family.jpg'),
('Art Workshop', '2023-10-20 14:00:00', '$25', 'Learn painting techniques from local artists', 'art.jpg');

-- Insert dummy data into Exhibitions
INSERT INTO Exhibitions (title, startDate, endDate, description, image) VALUES
('Dinosaurs Unearthed', '2023-06-01 09:00:00', '2023-08-31 17:00:00', 'Interactive dinosaur exhibit with life-sized models', 'dino.jpg'),
('Renaissance Masters', '2023-07-15 09:00:00', '2023-10-15 17:00:00', 'Collection of Renaissance paintings and sculptures', 'renaissance.jpg'),
('Space Exploration', '2023-09-01 09:00:00', '2023-11-30 17:00:00', 'History of space exploration with real artifacts', 'space.jpg'),
('Ancient Egypt', '2023-12-01 09:00:00', '2024-02-28 17:00:00', 'Mummies, hieroglyphs, and treasures from ancient Egypt', 'egypt.jpg'),
('Modern Art', '2024-03-01 09:00:00', '2024-05-31 17:00:00', 'Contemporary art from emerging artists', 'modern.jpg');

-- Insert dummy data into Tours
INSERT INTO Tours (title, tourDate, audience, tourguide) VALUES
('Morning Highlights', '2023-06-10 10:00:00', 'General Public', 2),
('School Group Tour', '2023-06-12 11:30:00', 'Students', 2),
('VIP Collection', '2023-06-15 14:00:00', 'Members', 5),
('Evening Art Walk', '2023-06-20 18:00:00', 'Adults', 2),
('Family Tour', '2023-06-25 13:00:00', 'Families', 2);

-- Insert dummy data into Blogs
INSERT INTO Blogs (title, description, datePosted, author) VALUES
('The Importance of Museum Collections', 'Exploring how museums preserve history...', '2023-05-01 09:15:00', 1),
('Behind the Scenes: Preparing an Exhibition', 'A look at what goes into exhibition planning...', '2023-05-15 11:30:00', 4),
('Art Conservation Techniques', 'How we preserve and restore delicate artworks...', '2023-06-01 14:45:00', 5),
('Engaging Younger Audiences', 'Strategies for making museums appealing to children...', '2023-06-10 10:20:00', 4),
('The Future of Museums', 'How technology is changing the museum experience...', '2023-06-20 16:00:00', 1);

-- Insert dummy data into Users
INSERT INTO Users (firstname, lastname, email, password, active, dateAdded) VALUES
('Admin', 'User', 'admin@museum.com', MD5('password123'), 'yes', '2023-01-01 00:00:00'),
('Regular', 'User', 'user@museum.com', MD5('userpass123'), 'yes', '2023-02-15 10:30:00'),
('Inactive', 'User', 'inactive@museum.com', MD5('inactive123'), 'no', '2023-03-10 14:15:00'),
('Member', 'One', 'member1@museum.com', MD5('member123'), 'yes', '2023-04-05 09:00:00'),
('Member', 'Two', 'member2@museum.com', MD5('member456'), 'yes', '2023-05-20 11:45:00');