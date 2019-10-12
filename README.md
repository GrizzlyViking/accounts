# ACCOUNT TRANSACTION TEST

### Installation
fetch the repository from github
```
git clone git@github.com:GrizzlyViking/accounts.git .
```
install the packages via composer
```
composer install
```
Remember to copy `.env.example` to `.env` and afterwards do a
```
 php artisan key:generate
``` 
In whichever database your using create a database and update the `.env` accordingly and then do a 
```
php artisan migrate --seed
```
_(the `--seed` adds some test data, provided via "faker")_

#### Comments on installation and structure.
The user, account and transactions have only the required information demanded of the test. I.e. things like 
address and contact details would have been normal to include.

The whole database is written using migrations, so you can use whatever database you already have installed. 
Personally I use Postgres at home, and MySQL/MariaDB at work, alternatively for this test SQLite would make
perfect sense.

Also considering Laravel versus Lumen, then Lumen would have made much more sense, but since I imagined that
this would end up being a much larger system, and I suspect that you wanted to see my Laravel skills :-) (and also I 
want to use Form Requests, which Lumen does not have, and last time I checked couldn't be added).

