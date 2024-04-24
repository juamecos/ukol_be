# LAMP Application with Docker

This is a basic LAMP stack environment built using Docker and Docker Compose. It consists of containers for Apache, MySQL, PHP, and phpMyAdmin.
Endpoint for API REST

## Prerequisites

- Docker
- Docker Compose

## Installation

1. **Clone the repository**

   ```bash
   git clone https://github.com/juamecos/ukol_be.git
   cd ukol_be.git
2. **Create environment file**
Copy the example environment file and modify according to your needs:

3. **Start the application**
Use Docker Compose to build and start the containers:

docker-compose up -d

4. **Install PHP dependencies**
Enter the PHP container to install Composer dependencies:

docker exec -it ukol_be-php-1 composer install

## Usage
The application is available at http://127.0.0.1/1.

Access phpMyAdmin at http://127.0.0.1:8080 to manage the database. The phpMyAdmin service is set up to connect to the MariaDB container, using the environment variables defined in your .env file.

## Configuration
Make sure to update your .env file with the appropriate environment variables before starting the application.