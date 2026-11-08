CAMPUSCONNECT - ACTIVITY 1 (SIGN IN AND REGISTER)
=================================================

FILES
-----
index.php       Sign In page
register.php    Registration page
config.php      MySQL database connection
dashboard.php   Page shown after successful sign in
logout.php      Signs the user out
style.css       Website design
database.sql    Database and users table setup

HOW TO RUN USING XAMPP
----------------------
1. Install and open XAMPP.
2. Start Apache and MySQL.
3. Copy the CampusConnect_PHP folder into:
   C:\xampp\htdocs\
4. Open http://localhost/phpmyadmin in your browser.
5. Click the Import tab and import database.sql.
6. Check config.php. The default XAMPP MySQL username is root
   and the password is blank. Change these if your setup differs.
7. Visit:
   http://localhost/CampusConnect_PHP/

HOW TO TEST
-----------
1. Click Register.
2. Enter your full name, username, password and confirm password.
3. Click Create Account.
4. Go to Sign In and enter the account details you registered.
5. You should arrive at the Student Dashboard.
6. Click Sign Out to return to the Sign In page.

NOTE
----
This is a PHP + MySQL project, matching the separate-file approach
shown in the teacher's video. Passwords are stored as secure hashes.
