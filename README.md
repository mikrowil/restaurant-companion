# restaurant-companion
This is a personal project for demonstrating my knowledge in PHP.  

Hello my name is michael wilson.
This is a test project for demonstrating some of my knowledge in programming, mostly PHP.

* Some of the technologies used are:
	* MySQL
	* Authentication
	* Password hashing
	* Data layer abstraction
	* GET / POST requests and Form verification
	* User sessions 

* Instructions to run:
	* Xampp is required to run this project locally for testing. For instruction to install, [click here](https://www.ionos.ca/digitalguide/server/tools/xampp-tutorial-create-your-own-local-test-server/)
	* Place the project folder inside of htdocs in the xampp folder.
	* The address on a local machine will be "http://localhost/portfolio/index.php".
	* For instructions to install MySql, [click here](https://dev.mysql.com/doc/mysql-installation-excerpt/5.7/en/installing.html)
	* Make sure the config.js has the correct addresses for the api as well as the MySql info.
	* To set up the db run "Type db.sql | mysql -u root -p" from the sql directory.
	* When creating the database use the name "RESTAURANTS"
	
        
				
## MySql

Database used for the storage of the restaurant employees. 

## Authentication

I implemented a verification process to not allow users in the website if they don't have an account. If a user tries to avoid giving credentials, they will be sent to the login screen regardless of where in the website they are trying to enter. Once a user has created an account they will be able to proceed and their session details will be saved for the next time they come to the website.

## Password hashing

Standard hashing for the passwords stored in the database.

## Data Layer abstraction



