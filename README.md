# Camagru

A small web application allowing you to make basic photo editing using your webcam and with some predefined images.
Esentially, a basic clone of instagram.

## Requirements

- [XAMP](https://www.apachefriends.org/download.html) or [MAMP](https://bitnami.com/stacks/infrastructure) for running the server side code and the MySQL DB 
- PHP
- JavaScript
- CSS
- HTML
- MySQL

## Install and Run 

- Insure that your [XAMP](https://www.apachefriends.org/download.html) or [MAMP](https://bitnami.com/stacks/infrastructure) server is successfully installed.
- Clear out your htdocs directory and clone this repo inside the htdocs file of your server.
- Add your DB credentials to `config/database.php`.
- Start your server and use this URL to setup the web site `localhost:8080/camagru/config/setup.php`. Be sure to use the port you predefined during your server installation.
- Now go to the root of the site `localhost:8080/camagru`, you will find links to create an account and signin.
- Ensure that your email host is correctly configured on your XAMP or MAMP server via the `php.ini` file.

## Database Management Systems:
- mysql
- PhpMyAdmin

## Design
This application uses a basic Model View design pattern. The model-view derivation combines MVC's view and controller into a single abstraction which is useful for small to medium sized applications. The `app` directory contains all the business logic for the application and then serves up the appropriate views. The user will then interacte with view and connect to the required API and the process will continue.
- `config/` Database creation and DB connection
- `css/` Styling
- `images/` Contains predefined images, user created images and profile pics.
- `includes/` Contains functions used in various parts of the app.
- `javascript/` JavaScript for the frontend
- `views/` Contains some basic views servered by the app
- Futher more the root of the app contains the `index.php`, `globals.php` and the `.htaccess` file. 

## Testing
- Executed tests
  - Used PHP, no external frameworks, config files in correct location. Used PDOs for DB transactions.
  - Webserver starts.
  - Create an account.
  - Log in.
  - Capture picture using the webcam.
  - Visit gallery
  - Change user credentials.
- Expected outcomes
  - Backend written in PHP.
  - No framworks used
  - `database.php` and `setup.php` in `config/`.
  - Used `PDO` for transactions.
  - Webserver starts and gallery is located at the root of the site.
  - Able to register.
  - Able to log in.
  - Able to capture a picture.
  - Able to visit gallery.
  - Able to change credentials.
