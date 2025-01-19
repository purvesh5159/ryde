#Project setup instructions:

# Ryde Backend Developer Test

## Overview

This repository contains the backend API for the **Ryde** platform, built using **Laravel 9** and **MongoDB**. The project allows for user management, authentication, and the ability to manage friends and user locations, as outlined in the test specifications.

## Tech Stack

- **Backend Framework**: Laravel 9
- **Database**: MongoDB
- **Authentication**: Laravel Sanctum (for API token authentication)
- **API Documentation**: Swagger

## Features

- User management (CRUD operations)
- User authentication (Registration, Login, Logout)
- Add and remove friends (Friendship management)
- Retrieve nearby friends based on geographical coordinates
- API documentation via Swagger UI

## Prerequisites

Before running this project, make sure you have the following installed:

- PHP >= 8.0
- Composer
- Laravel 9.x
- MongoDB
- Node.js (for Swagger UI generation)

## Step-by-Step Setup

### 1. Clone the Repository

Clone the repository to your local machine:

git clone https://github.com/purvesh5159/ryde.git

cd ryde
2. Install Dependencies

DB_CONNECTION=mongodb
DB_HOST=127.0.0.1
DB_PORT=27017
DB_DATABASE=ryde_db
Set up any other environment variables as needed (for example, mail configuration).

4. Generate Application Key
Generate the application key for encryption:

5. Run Migrations
Since we're using MongoDB, you don’t need traditional SQL migrations, but make sure the collections are properly set up by running the migrations:
php artisan migrate

6. Generate Swagger Documentation
If you haven't installed Swagger-Lume yet, follow these steps:

Install Swagger-Lume:
composer require "darkaonline/swagger-lume"
Publish the Swagger configuration file:

php artisan vendor:publish --provider="SwaggerLume\ServiceProvider"
Generate the Swagger documentation:

php artisan swagger-lume:generate
7. Start the Development Server
Run the application locally using the following command:

php artisan serve
This will start the server at http://127.0.0.1:8000.

8. Access the Swagger API Documentation
You can access the Swagger API documentation via the following URL:

Swagger API Documentation

9. Testing the API
You can test the API using tools like Postman or cURL to make requests to the following endpoints:

POST /api/register - Register a new user
POST /api/login - Login a user
POST /api/logout - Logout a user
GET /api/users - List all users
POST /api/users/{id}/add-friend - Add a friend
POST /api/users/{id}/remove-friend - Remove a friend
GET /api/users/{username}/nearby-friends - Get nearby friends based on coordinates

10. Unit Testing
Run the unit tests to ensure everything is working as expected:
php artisan test

API Documentation
The API documentation is available through Swagger UI. Here is the link to the documentation:
http://127.0.0.1:8000/api/documentation
