#   WEB BLOGGER

##### This is a web blogging platform built with scalability, proper error handling and efficient handling of high traffic in mind.

##  Compatibility
-   PHP 8.0 +
-   MySQL 8.0+
##  Installation

The following steps should be taken to install the application on your machine

*   Clone the git repository via the command line interface or download the repository entirely
```shell
https://github.com/mastjoe/web-blogger.git
```
*   Set up a **.env** configuration file from **.env.example** in the project root directory

*   Install project depedencies using the command ```composer install```.
    
    Before running the above command ensure to have the latest version of composer installed on your device. Get composer manager from [composer](https://getcomposer.org/download/)

*   Generate application key using the command, 
```shell 
php artisan key:generate
```

*   Update the **.env** configuration file correctly with your **MySQL**  database credentials.

*   Run migrations and seeders, 
```shell
php artisan migrate:fresh --seed
```

### Docker Setup

Alternatively the application can also be setup on docker conveniently via [Laravel Sail](https://laravel.com/docs/9.x/sail#installing-sail-into-existing-applications)

## Set Up Queue

-   Queue system is useful in the application, ensure proper configuration on **.env** file. `QUEUE_CONNECTION` should preferrably be set to `QUEUE_CONNECTION=database`
- Run the command
```shell
php artisan queue:work --queue=high,default
```

##  Import Feed Post
-   To pull and update blog post from external feed, set up Task scheduler,
```shell
    php artisan schedule:work
```
-   The schedule, at the background runs the command
```shell
    php artisan pull:feed
```
The ```php artisan pull:feed``` command can be run exclusively to the schedule.

##  Testing

To test the application use the command
```shell
php artisan test
```

## Packages
The project uses [Laravel Fortify](https://laravel.com/docs/9.x/fortify) for authentication Package.
