## Product register

Project for a product register application, where products and categories can be updated based on CSV import.

## Install project

I assume that you already have PHP 7.1+ and MySQL or MariaDB installed.

First clone this repository, install the dependencies, and setup your .env file.

```
git clone https://github.com/isu873/product-register
cp .env.example .env
```

After that install dependencies via composer

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

Finally, start the web server

```
php artisan serve
```

## Further ideas, improvements

1. If this tool is publicly available, then should add authentication for product csv import page, xml feed can be left
   public if necessary.
2. If it's an internal tool, should be also consider to add authentication, not everyone needs to be able to modify
   products
3. In both cases consider add logging
4. If the CSV file is too large, it can be processed by a queued job in the background, prevent blocking the user.
5. Should add unit and feature test to ensure code reliability
6. When requirements change, code should be refactored to separate csv import, product and category handling, based on
   SOLID
