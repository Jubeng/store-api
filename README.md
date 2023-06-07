# Store API

A simple Store API to create and manage Stores and Products.

## For local setup:
1. Clone this repository: [https://github.com/Jubeng/store-api](https://github.com/Jubeng/store-api)
2. I'm using XAMPP, you can use any application you are comfortable, and start MySQL.
3. The `.env` file was sent through email.
4. Run `composer install`.
5. Create a database for the API: `store_api` for the database.
6. after that, run `php artisan migrate:fresh` to create the tables.
7. in the other terminal, to run the app run `php artisan serve --port=3000`.
8. Go to the provided url. e.g.: http://127.0.0.1:3000/


## Postman Collection
- The Postman collection will be sent to the email also or you can get it here: https://drive.google.com/file/d/1wnipVZTUoZkEBZijdwyeoUoOTckMUh1S/view?usp=sharing
