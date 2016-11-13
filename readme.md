# Properties tests with Laravel

## Make it work!

It assumes you're using some linux destribution like Ubuntu or fedora, have already installed php, mysql, git and composer.

### Steps

* Clone this repositiry with `git clone git@github.com:Alvarz/user-manager.git`
* `cd user-manager` and `./composer install` or `php composer install`
* You will need create the .env file in order to run the app so `cp .env.example .env` on the command line to create tue `.env` file
* This need a mysql database in order to work, so we need create a new database.
⋅⋅* `mysql -u 'yourUser' -p` and it will ask for your mysql password.
⋅⋅* When the mysql command line apprear create a database like. `CREATE DATABASE IF NOT EXISTS 'inmuebles'`
⋅⋅* in order to logout from mysql. type `exit`
* Now, we need configurate our .env file, open the .env file with your favorite text editor and change
```javascript
DB_DATABASE=inmuebles
DB_USERNAME=yourUser
DB_PASSWORD=yourPassword
```
⋅⋅⋅IMPORTANT remember change your mysql username and password
* Now we need create our tables and fill it with some dummy data, for this with need run `./artisan migrate --seed` or `php artisan migrate --seed`
* If with don¡t have any error, we can run our app, so, in order to do that we need run `./artisan serve` or `php artisan serve`
and visit localhost:8000 in our browser, the default username is `admin@admin.com` and the password is `password`


## License

This is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).
