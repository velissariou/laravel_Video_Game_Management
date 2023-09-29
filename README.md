# Instructions

In order to get the app to load first you need to make sure these are installed:
- PHP 8+
- Composer
- SQLite

Next you need to go to `.env` file and change the location of the SQLite database to match your system's.

~~~
DB_CONNECTION=sqlite
DB_DATABASE=<your-path>/database/database.sqlite
DB_FOREIGN_KEYS=true
~~~

A small DB is included but even if it is removed you can run:

~~~
php artisan migrate
~~~

inside your app's home and a prompt to create a new DB will appear.

---

After cloning the repository and installing dependencies you need to run:

~~~
php artisan migrate
php artisan serve
~~~

And your server will listen in `https://127.0.0.1:8000` by default. From there you can `Register` or `Login` after registering and then proceed with pressing `Video Games Index Page` button to proceed with creating, viewing, updating or deleting video games.