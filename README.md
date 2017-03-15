### Run it:

1. git clone https://github.com/ilhamarrouf/slimfw-skeleton.git
2. cd slimfw-skeleton/
3. composer install
4. rename file phinx.yml.example menjadi phinx.yml dan kemudian konfigurasikan
5. rename file app/settings.php.example menjadi app/settings.php dan kemudian konfigurasikan
6. php -S localhost:8000 -t public/

## Key directories

* `app`     : Application container and configuration
* `database`: Database migration management
* `src`     : All class files within the `App` namespace
* `views`   : Twig template files
* `public`  : Webserver root
* `vendor`  : Composer dependencies