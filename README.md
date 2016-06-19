Treasure hunt with beacons
==========================

Trello
------

    https://trello.com/b/u3Snx8Zd/treasure-hunt-app

Mobile Application
------------------

### Installation

You need to have react-cli installed.

Go to `app` directory and execute `npm install`.


Backend Application
-------------------

### Step 0: Move to the application directory

After cloning the repository, change the current directory to `backend/`:
 
    $ cd backend/

### Step 1: Create the MySQL database

Run the following CLI command to install the database.

    $ mysql -u<user> -h<hostname> -p < data/database.sql

Change the <param> placeholders with your local credentials values.

### Step 2: Install the PHP server application

Run the following commands to install the backend application. Make sure
to have Composer installer available in the `backend/` directory.

    $ php composer.phar install
    $ cp conf/settings.php.dist conf/settings.php

### Step 3: Configure you MySQL database credentials

Update the `conf/settings.php` file to configure database access:

    <?php
    
    $conf['database'] = [
        'driver'   => 'pdo_mysql',
        'dbname'   => 'treasure_hunt',
        'host'     => 'localhost',
        'user'     => 'root',
        'password' => null,
        'port'     => 3306,
        'charset'  => 'utf-8',
    ];
    
    return $conf;

### Step 4: Run the PHP built-in Web Server

Run the following commands to start the built-in PHP web server:

    $ cd web/
    $ php -S localhost:8000

Open the application in the web browser with the folling HTTP address:

    http://localhost:8000

Application should show up!

