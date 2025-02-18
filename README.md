# Chat Application (PHP, JavaScript, MySQL)

## Description
This is a **real-time chat application** built using **PHP, JavaScript, and MySQL**. The application allows users to register, log in, and chat with others in a seamless and interactive interface. Messages are stored in a MySQL database, and AJAX is used to update chat messages without page refresh.

## Features
- ✅ User Registration & Login (Secure authentication with password hashing)
- ✅ One-on-One Private Chat
- ✅ Real-Time Messaging using AJAX
- ✅ Online/Offline User Status Tracking
- ✅ Responsive UI with Bootstrap
- ✅ Message History Stored in MySQL
- ✅ Secure User Sessions

## Technologies Used
- **Backend**: PHP (Core PHP, MySQLi)
- **Frontend**: HTML, CSS, Bootstrap, JavaScript
- **Database**: MySQL
- **Real-Time Updates**: AJAX & jQuery

## Installation & Setup
### 1. Clone the Repository
```sh
git clone https://github.com/sanjay-git-source/chatapp.git
cd chatapp
```

### 2. Setup the Database
- Create a MySQL database (e.g., `chatapp_db`).
- Import the `database.sql` file to create necessary tables.
- Update database credentials in `config.php`:
  ```php
  define('DB_HOST', 'localhost');
  define('DB_USER', 'root');
  define('DB_PASS', '');
  define('DB_NAME', 'chatapp_db');
  ```

### 3. Start the Application
- Place the project inside your local server (`htdocs` for XAMPP).
- Start Apache and MySQL in **XAMPP**.
- Open the browser and go to:
  ```
  http://localhost/chatapp/
  ```

## Usage
1. **Register/Login** to access the chat.
2. Select a user from the contact list to start a conversation.
3. Send and receive messages in real-time.

## Future Enhancements
🚀 Implement WebSockets for real-time messaging
🚀 Add Group Chat Feature
🚀 Implement User Profile Pictures
🚀 Add Typing Indicators

## Contributing
Feel free to **fork this repository** and contribute to its development! 😊



