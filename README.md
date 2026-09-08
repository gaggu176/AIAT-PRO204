# PHP User Directory

## MariaDB setup

1. Install PHP 8.1+ with the `pdo_mysql` extension enabled.
2. Start MariaDB.
3. Edit the connection values at the top of `db.php`, including the username and password.
4. Start Apache or run `php -S localhost:8000` from this folder.
5. Open the application in your browser.

On the first request, the application connects to MariaDB without selecting a database, creates `user_directory` if it does not exist, then creates the `users` table. The MariaDB account must have permission to create databases. The app supports creating, editing, and deleting users. Email addresses are unique, and all form writes use prepared statements and a CSRF token.