# Lukuhaaste Web Application - README
## Table of Contents
<!-- TOC tocDepth:2..3 chapterDepth:2..6 -->

- [Table of Contents](#table-of-contents)
- [Project Description](#project-description)
- [Features](#features)
    - [1. User Registration and Login](#1-user-registration-and-login)
    - [2. Book Logging](#2-book-logging)
    - [3. User Dashboard](#3-user-dashboard)
    - [4. Admin Panel](#4-admin-panel)
    - [5. Public View for Non-Logged Users](#5-public-view-for-non-logged-users)
    - [6. Genre Management](#6-genre-management)
- [Technologies](#technologies)
- [Installation](#installation)
    - [Prerequisites](#prerequisites)
    - [Steps](#steps)
- [Database Structure](#database-structure)
- [User Roles and Permissions](#user-roles-and-permissions)
    - [1. Student/Teacher](#1-studentteacher)
    - [2. Admin](#2-admin)
- [UI/UX](#uiux)
    - [1. Responsive Design](#1-responsive-design)
    - [2. Main Page for Non-Logged Users](#2-main-page-for-non-logged-users)
    - [3. Log a Book Page](#3-log-a-book-page)
- [Licenses](#licenses)
- [Additional Notes](#additional-notes)

<!-- /TOC -->

## Project Description

Lukuhaaste is a web application developed to help students and teachers manage a reading challenge. The platform allows users to log books they have read or listened to during a set period (usually 1-2 months). Users can register, choose a nickname, and start logging books into the system. The challenge encourages users to track their reading progress, rate books, and recommend them to others.

The core functionality includes:
- User registration and login system
- Logging of books, audiobooks, and ratings (1-5 stars)
- A responsive, mobile-first design
- Admin functionalities to manage users and genres
- Visual progress tracking for each user and for the entire challenge

## Features
### 1. User Registration and Login

- Users can register with a nickname and log into the system.

- Users can update or delete their profile and data.

### 2. Book Logging

- Users can log books they have read or audiobooks they have listened to.

- For each book, users can enter the book title, type (book/audiobook), date of reading, page number, and a short review.

- Users can rate books with a 1-5 star rating.

- Books can be marked as recommended or not.

### 3. User Dashboard

- Each user can view their progress in the reading challenge, including the number of books and pages read.

- Users can view their past book entries and update or delete them.

- Personal progress indicators (e.g., books read, pages read) relative to the challenge.

### 4. Admin Panel

- Admins can add new genres to the system.

- Admins can manage users by deleting them or removing their entries.

- Admins can create new reading challenges with start and end dates.

### 5. Public View for Non-Logged Users

- The main page displays an overview of the current reading challenge (number of books and pages read).

- The most popular books and the top-rated books are also displayed.

- Non-logged users can filter books by genre or rating.

- A countdown shows how long the current challenge will last, or when the next challenge will begin.

### 6. Genre Management

- Books can be assigned one or more genres.

- Genres can be created and edited by admins.

## Technologies

This project is built using the following technologies:

- **Backend**: PHP (Laravel Framework)

- **Frontend**: HTML5, CSS3, JavaScript, and Laravel Blade Templating

- **Database**: MySQL

- **Authentication**: Laravel Authentication (Login/Register)

- **UI/UX Design**: Responsive mobile-first design (using CSS Grid, Flexbox, and Bootstrap)

- **Version Control**: Git, GitHub

## Installation
### Prerequisites

1. PHP >= 7.4

2. Composer (for PHP dependency management)

3. MySQL or a compatible database

4. Node.js (optional for front-end assets)

### Steps

1. Clone the repository:
```bash
git clone https://github.com/your-repository/lukuhaaste.git
```
2. Install PHP dependencies:
```bash
cd lukuhaaste
composer install
```
3. Create and set up the ```.env``` file:
```bash
cp .env.example .env
```

4. Generate application key:
```bash
php artisan key:generate
```

5. Set up the database:

- Create a new database in MySQL.

- Configure your .env file with your database credentials.

- Run migrations to create the necessary tables:
```bash
php artisan migrate
```

6. Install front-end dependencies (optional, if using front-end tools like Laravel Mix):
```bash
npm install
npm run dev
```
7. Start the development server:
```bash
php artisan serve
```
## Database Structure

The database consists of the following tables:

1. **users**: Stores user information such as username, email, password, and role (student, teacher, admin).

2. **books**: Stores information about books, including title, author, pages, genre, and review ratings.

3. **genres**: Stores the genres for each book.

4. **book_user**: A pivot table linking users with books they have read.

5. **reviews**: Stores reviews for books (rating and short comments).

6. **reading_challenges**: Stores information about reading challenges, including the start and end dates.

ER Diagram: [Link to ER Diagram] (insert diagram link)
## User Roles and Permissions
### 1. Student/Teacher

- Can log books.

- Can rate and review books.

- Can view their progress on the reading challenge.

### 2. Admin

- Can manage users (delete users, manage user data).

- Can manage books and reviews.

- Can create and manage reading challenges.

- Can add, remove, or update genres.

## UI/UX
### 1. Responsive Design

- The design is mobile-first and fully responsive, ensuring that the web application provides a smooth experience on both desktop and mobile devices.

- The user interface includes a dashboard for tracking reading progress and logging books. The challenge progress is visually represented with graphs and statistics.

### 2. Main Page for Non-Logged Users

- Displays the current reading challenge's statistics (total books read, total pages read).

- Lists the top-rated books, popular books, and recommended books.

- Includes a search feature that allows users to filter books by genre and rating.

### 3. Log a Book Page

- Allows users to log a new book, with input fields for book title, type (book or audiobook), pages, and reviews.

- Includes the option to mark the book as recommended.

## Licenses

- This project is **all rights reserved**. No one is permitted to use, modify, or distribute this code without explicit permission from the author.

## Additional Notes

- If you run into any issues, please open an issue on GitHub and describe the problem.

## Contributors

This project was developed by the following contributors:

[Clara Nuoskala](https://portfolio.nuoskala.com/home)

[Bertrand Anne](https://bertrand14.github.io/)

You can find more information about each contributor's work in the commit history or pull requests.