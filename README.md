# Store API

A simple Store API to create and manage Stores and Products.

## For local setup:
1. Clone this repository: [https://github.com/Jubeng/store-api](https://github.com/Jubeng/store-api)
2. Go to the directory of the application.
3. If you don't have Laravel and PHP v8.1.6 yet, please install the latest version of Laravel and PHP v8.1.6.
4. For this application I am using Laravel ^10.10.
5. I'm using XAMPP, you can use any application you are comfortable, and start MySQL.
6. The `.env` file was sent through email.
7. Open your terminal, run `composer install`.
8. Create a database for the API: `store_api` for the database.
9. then run `php artisan migrate:fresh` to create the tables.
10. To run the seeders use this commands as follows: 
    - `php artisan db:seed --class=StoreModelSeeder`
    - `php artisan db:seed --class=ProductModelSeeder`
11. in the other terminal, to run the app run `php artisan serve --port=3000`.
12. Go to the provided url. e.g.: http://127.0.0.1:3000/

## Postman Collection
- The Postman collection will be sent to the email also or you can get it here: https://drive.google.com/file/d/1wnipVZTUoZkEBZijdwyeoUoOTckMUh1S/view?usp=sharing
