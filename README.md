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

Also please note that User and account have been separated into two different models/tables, since I felt that login
and various details about the user would be separate from the account, supported by the notion that one user would be
able to have more than one account.

The whole database is written using migrations, so you can use whatever database you already have installed. 
Personally I use Postgres at home, and MySQL/MariaDB at work, alternatively for this test SQLite would make
perfect sense.

Also considering Laravel versus Lumen, then Lumen would have made much more sense, but since I imagined that
this would end up being a much larger system, and I suspect that you wanted to see my Laravel skills :-) (and also I 
want to use Form Requests, which Lumen does not have, and last time I checked couldn't be added).

## Endpoints and testing
The endpoints where made and tested using TDD, (PHPUnit).

I have forced that returned data to be a json response, since it sometimes becomes a little complicated to convince
Laravel that its an XHR call without setting the correct headers (jQuery suffers from this) and since this is an API 
endpoint, then I felt that would be ok. Throwing exceptions have not been forced into json responses though, and
although it probably should be, then you would not get the built in logging of thrown Exceptions.

I placed the tests in the Features folder, rather than Unit tests, because I was testing RESTFUL verbs 
(post, get, delete), rather than individual functions.

I've tried to tidy up the test I used, i.e. deleting the data created for the tests, I took advantage of 
"on delete cascade".
