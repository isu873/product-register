## Product register

Example project for a product register application, where products and categories can be updated based on CSV import.

## Install project

First clone this repository, install the dependencies, and setup your .env file.

```
git clone https://github.com/isu873/product-register
cp .env.example .env
```

After that install dependecies via composer

```
composer install
```

Edit .env file to setup database connection

```
DB_CONNECTION=mariadb or mysql
DB_HOST=127.0.0.1 (or <your_server_ip>)
DB_PORT=3306 (or <your_server_port>)
DB_DATABASE=<your_database_name>
DB_USERNAME=<your_database_username>
DB_PASSWORD=<your_database_password>
```

And run the initial database migrations.

```
php artisan migrate
```
