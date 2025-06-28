# PHP Project

This is a simple PHP project that includes user authentication (login, signup, logout), a contact form, and basic profile editing functionality. It also features a homepage with sections for services, about us, and projects.

## Features

- User Authentication (Login, Signup, Logout)
- User Profile Editing
- Contact Form
- Responsive Design (Bootstrap)
- Database Integration (MySQL/PDO)

## Setup Instructions

To set up this project, follow these steps:

1.  **Clone the repository (or extract the project files):**
    ```bash
    git clone https://github.com/Ra7imX/Php_Login_Register_Projet.git
    # or extract the provided zip/tar file
    ```

2.  **Database Setup:**
    - Import the `database.sql` file into your MySQL database. This file contains the necessary table structure and initial data.
    - Update the database connection details in `src/config/connection.php` with your database credentials.

3.  **Web Server Configuration:**
    - Ensure you have a PHP-compatible web server (e.g., Apache, Nginx) installed and configured.
    - Point your web server's document root to the `public` directory of this project.

4.  **Access the Application:**
    - Open your web browser and navigate to the URL where your project is hosted (e.g., `http://localhost/` or `http://your_domain.com/`).

## Project Structure

```
. (project root)
├── database/
│   └── database.sql
├── README.md
├── public/
│   ├── css/
│   │   ├── style.css
│   │   └── style1.css
│   ├── images/
│   │   ├── about.jpg
│   │   ├── app-development.png
│   │   ├── background.jpg
│   │   ├── brand.png
│   │   ├── hero-image.png
│   │   ├── project1.jpg
│   │   ├── project2.jpg
│   │   ├── project3.jpg
│   │   ├── project4.jpg
│   │   ├── research.png
│   │   └── ux.png
│   ├── contact.php
│   ├── edit.php
│   ├── home.php
│   ├── index.php
│   ├── login.php
│   ├── logout.php
│   └── signup.php
│   └── forgot.php
└── src/
    └── config/
        └── connection.php
```

## Technologies Used

- PHP
- MySQL
- HTML5
- CSS3
- Bootstrap
- JavaScript

## Contact

For any questions or issues, please contact [abbadabduu@gmail.com].


