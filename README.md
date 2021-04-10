# Get to Know Lara

This Project is the backend part of a full-stack mail service application.  
Frontend is written in React.js, please find the link to the repository here:  
https://github.com/vadaszbence/get-to-know-lara-frontend

## Features

1. Log in & Registration
2. View incoming mails in inbox
3. View sent mails 
4. Send mails
5. Mark mails unread
6. Save mails as drafts
7. Reply to mails

## External Technologies used:

1. Sanctum library for authentication: https://github.com/laravel/sanctum
2. Fruitcake for CORS management: https://github.com/fruitcake/laravel-cors

# Getting started

## Installation

Please check the official laravel installation guide for server requirements before you start. [Official Documentation](https://laravel.com/docs/5.4/installation#installation)

Alternative installation is possible without local dependencies relying on [Docker](#docker). 

Clone the repository

    git clone git@github.com:gothinkster/laravel-realworld-example-app.git

Switch to the repo folder

    cd laravel-realworld-example-app

Install all the dependencies using composer

    composer install

Copy the example env file and make the required configuration changes in the .env file

    cp .env.example .env

Generate a new application key

    php artisan key:generate

Generate a new JWT authentication secret key

    php artisan jwt:generate

Run the database migrations (**Set the database connection in .env before migrating**)

    php artisan migrate

Start the local development server

    php artisan serve

You can now access the server at http://localhost:8000
