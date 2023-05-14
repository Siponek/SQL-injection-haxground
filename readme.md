# SQL-injection-haxground

SQL-injection-haxground is a simple, hands-on environment for testing SQL injections. This repository provides a deliberately insecure web application running on PHP and MySQL, which allows you to practice SQL injection techniques in a safe and legal environment.

The project uses Docker for easy setup and isolation. It is written primarily in HTML, PHP, and CSS, with a small amount of JavaScript and Dockerfile configuration.

## Getting Started

To use SQL-injection-haxground, you need to have Docker and Docker Compose installed on your system. Once you have these prerequisites, you can clone the repository and start the application.

```bash
git clone https://github.com/Siponek/SQL-injection-haxground.git
cd SQL-injection-haxground
docker-compose up
```

This will start two Docker containers: one for the web application (built from the `Dockerfile` in the `docker` directory), and one for the MySQL database (configured in `docker-compose.yaml`).

## Usage

Once the application is running, you can access it at `http://localhost:8000` in your web browser. The application provides a login form, which you can attempt to bypass using SQL injection techniques.

If you wish to tinker with SQL-injection-haxground, you can edit the files in the `init` directory, which will be copied into the web application container when it is built. You can then rebuild the container using `docker-compose build`. Or visit `http://localhost:8080` to access the database.

The application includes three versions of the login page: one vulnerable to SQL injection, and one that sanitizes user input to prevent injection. All are accessible from the main index page.

### Vulnerable Login

The vulnerable login page does not sanitize user input before using it in a SQL query, making it susceptible to SQL injection attacks. The PHP code for this page can be found in `login.php`.

For example, you might try inputting the following into the username field:

```sql
' OR '1'='1
```

This will effectively change the SQL query from something like:

```sql
SELECT * FROM users WHERE username = '' AND password = ''
```

to:

```sql
SELECT * FROM users WHERE username = '' OR '1'='1' AND password = ''
```

Since '1'='1' is always true, this will return all users, and the login will be successful regardless of the password.

### Sanitized Login

The sanitized login page uses the `mysqli_real_escape_string()` function to sanitize user input before using it in a SQL query, preventing SQL injection. The PHP code for this page can be found in `login-sanitized.php`.

If you try the same input on the sanitized login page, the `mysqli_real_escape_string()` function will escape the single quotes, making the input safe to use in a SQL query:

```sql
\' OR \'1\'=\'1
```

This will not change the SQL query in a way that allows you to log in without the correct password.

## Caution

Remember, SQL-injection-haxground is intentionally insecure. Never use this code in a production environment, and always ensure you are conducting your testing in a secure and legal manner.

## Contributing

Contributions are welcome! Please feel free to submit a pull request.

## License

Please see the `LICENSE` file for more information.
