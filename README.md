# Web Application Project

## Project Overview
This project is a web application designed with HTML5, CSS3, PHP, and JavaScript. It implements CRUD operations, user authentication, and an admin panel to manage tasks, users, and messages.

## Features
1. **User Authentication**:
   - Login and Registration functionality.
   - Change password and logout functionality.

2. **Admin Dashboard**:
   - Manage users, tasks, and messages.
   - Add, edit, delete, and fetch functionalities for users and tasks.

3. **User Panel**:
   - View personal tasks and messages.
   - Edit user profile.

4. **Responsive Design**:
   - Fully responsive interface, optimized for different screen sizes.

## File Structure
![image](https://github.com/user-attachments/assets/ccf87faf-16f1-49d4-869e-585ed86c9a16)
![image](https://github.com/user-attachments/assets/7b16cadf-f615-4cc2-ad06-8338fce37457)


## Database Schema
### Tables:
1. **Users**: Stores user data (`id`, `name`, `email`, `password`).
2. **Tasks**: Stores task details (`id`, `userid`, `task`, `status`).
3. **Messages**: Stores user messages (`id`, `content`, `sender_id`, `receiver_id`, `timestamp`).

## Key Functionalities
1. Secure database connection using prepared statements.
2. Form validation for login, registration, and data inputs.
3. Responsive and cross-browser compatible design.

## Instructions to Run
1. Clone the repository.
2. Import the database schema into your MySQL server.
3. Edit `db_connection.php` to include your database credentials.
4. Host files on a local or online server.

## Author Contributions
- **Sana**: Worked on login and registration system, validated user input, and styled the user dashboard.
- **Gulzaib**: Designed and implemented the admin dashboard, created CRUD operations for tasks, and ensured responsiveness.


