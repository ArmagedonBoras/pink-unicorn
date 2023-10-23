The Pink Unicorn is here!

How to set up locally:

* Read https://laravel.com/docs/10.x first page for an overview of options for preferred environment:
  * Local install with lamp/xampp/mamp or similar package
  * Docker, (via Laravel Sail?)
  * WSL2 with a linux distribution of your choice
* Install in your preferred environment:
  * PHP >= 8.1
  * Mysql database
  * Optionally, a web server software like apache2 or nginx
  * Composer (https://getcomposer.org/)
* Clone this repository
* Run Composer update by `composer update`
* Copy example.env to .env
* generate an app key by `php artisan key:generate` 
* edit the .env:
  * Edit the Mysql database connection information:
    * DB_CONNECTION=mysql
    * DB_HOST=127.0.0.1
    * DB_PORT=3306
    * DB_DATABASE=
    * DB_USERNAME=
    * DB_PASSWORD=
  * Edit the filemaker connection information:
    * FM_HOST=
    * FM_DATABASE=
    * FM_USERNAME=
    * FM_PASSWORD=
    * FM_PREFIX=
    * FM_VERSION=vLatest
    * FM_PROTOCOL=https
  * If you have a web server software available, set the the hostname you have configured in .env:
    * APP_URL=
* Create tables and seed default data by `php artisan reseed` (custom artisan command)
* Fill in with Article data by `php artisan db:seed ArticleSeeder` 
* If you don't have a local web server, you can start the php internal server `php artisan serve` 

The database seeder is set up with:
  * a bunch of default pages
  * a few current users (Örjan & Niklas, please add your own if you are not them...)
  * a bunch of default roles
  * a bunch of menu items for what is developed

Laravel is set up with this boilerplate:
  * Jetstream with Livewire
  * Bootstrap 5 with Bootstrap Icons
  * Summernote Rich Text Editor

  These models are created:
 | Model | Status | Usage |
 | ----------- | ----------- | ----------- | 
 | User | Functional | Maintains login, permissions and roles |
 | Event | | For Event handling - Booking of rooms and sign up for events  |
 | Room | | Rooms to be booked for events |  |
 | Page | Functional | Static pages |
 | Menu | Functional | Menu items |
 | Tag | Functional | Categorized Tagging |
 | Key | | Key management |
 | Locker | | Locker management |
 | Payment | | Payment management |
 | Profile | | Local cache from Membrum and additional data of a member |
 | Article | | News articles on front page |
 | Gamification => Point | | Possible points to be rewarded |
 | Gamification => Badge | | Possible badges to be earned |
 | Gamification => Achievement | | A rewarded point for performing something |
 | Fortnox => * | Functional | Link to Fortnox bookkeeping system |
 | Filemaker => FMMemberList | Functional | Link to Membrum database for member listing |
 | Filemaker => FMMemberEdit | Functional | Link to Membrum database for member information |

Naming conventions
  * Fields referencing another database table is named <entity>_id unless other conventions below says otherwise
  * Date, Time and Datetime and similar fields always end with _at (example: changed_at)
  * References to a user ends with _by if the user has another functionality that owning the entity (example: changed_by)
