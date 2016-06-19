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

API Documentation
-----------------

### User Registration

Request payload:

```http
POST /users HTTP/1.1
Host: localhost:8000
Accept: application/json
Content-Type: application/json

{
    "username": "jsmith"
}
```

Response payload:

```http
HTTP/1.1 201 Created
Host: localhost:8000
Connection: close
Content-Type: application/json
Cache-Control: no-cache
Date: Sun, 19 Jun 2016 14:48:47 GMT

{"uuid":"86ea34e5-40dd-48b7-a319-e755fd5468a4","username":"jsmith","registered_at":"2016-06-19 16:48:47"}
```

### Create New Game

Request payload:

```http
POST /games HTTP/1.1
Host: localhost:8000
Accept: application/json
Content-Type: application/json

{
    "label": "Game #1"
}
```

Response payload:

```http
HTTP/1.1 201 Created
Host: localhost:8000
Connection: close
Content-Type: application/json
Cache-Control: no-cache
Date: Sun, 19 Jun 2016 15:23:05 GMT

{"uuid":"c2a25832-008f-4bfa-9f9c-af9a072a29d5","label":"Game 1","created_at":"2016-06-19 17:23:05"}
```

### Join a  Game

Request payload:

```http
POST /user/86ea34e5-40dd-48b7-a319-e755fd5468a4/games HTTP/1.1
Host: localhost:8000
Accept: application/json
Content-Type: application/json

{
    "game": "c2a25832-008f-4bfa-9f9c-af9a072a29d5"
}
```

Response payload:

```http
HTTP/1.1 201 Created
Host: localhost:8000
Connection: close
Content-Type: application/json
Cache-Control: no-cache
Date: Sun, 19 Jun 2016 16:00:04 GMT

{"uuid":"47f9a9a3-3062-4beb-9243-16693ea8851a","user_uuid":"86ea34e5-40dd-48b7-a319-e755fd5468a4","game_uuid":"c2a25832-008f-4bfa-9f9c-af9a072a29d5","started_at":"2016-06-19 18:00:04","score":0}
```
