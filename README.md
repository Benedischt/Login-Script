#A Login-Script wich can be used for Login with Google Authenticator.

Included:
- Page - Login User with entrys of Database Table (index.php)
- Page - Create new Google Keys for users in Database Table (create_g_key.php)
- Page - Check if the Login success (session.php)
- SQL File - Insert into your Database (example.sql)

Todo:
1. Download all the files and Upload it into you Web Server.
2. Create a new Database and Insert the SQL Querys from example.sql.
3. Edit the SQL Data in assets/config.php called SQL_HOST, SQL_USER, SQL_PASS, SQL_DB.
4. Create a new Google Auth TAN with the create_g_key.php file.
5. Copy The Link with is Displayed if you hit the "Create Key" Button.
6. Open it and scan the QR-Code with your Auth APP on yout Phone/Desktop/Tablet.
7. Test your Login with Username (example) - Password (example) - TAN (Your Key from your Mobile Device)

Sorry for my bad English :-D
