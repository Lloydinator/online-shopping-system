# Simple Online Shopping System

This app is a simple online shopping system that allows users to sell one item at a time. Buyers can also set their own discounts on the items that they buy.

## Installation

- On your computer, clone this code to your device by running `git clone git@github.com:Lloydinator/` in your terminal.
- In your terminal, navigate to the project folder and install all dependencies by running `composer install`. 
- To get the project up and running, in one terminal window, run `php artisan serve` (Laravel's server). In another, run `npm install && npm run dev` (Vite and frontend).
- Create a **.env** file by running `cp .env.example .env`. 
- In your terminal, create a key by running `php artisan key:generate`.

## Data
- Create a MySQL database. 
- Put the name of the database you created beside `DB_DATABASE` in the **.env** file. Ensure you also put the correct credentials for using your MySQL database.
- Run `php artisan migrate --seed` to create the tables and seed data.

## Tests
- Create an SQLite database in the **database/** folder named **testdb.sqlite**.
- In your terminal, run `php artisan test`. There should be no failures.

## Notes
- This project is using Laravel Breeze. Currently, only backend is done.
- The `register` route is disabled. A user can log in with one of the seeded people in **database/seeders**, or you can create your own user to log in with. 
