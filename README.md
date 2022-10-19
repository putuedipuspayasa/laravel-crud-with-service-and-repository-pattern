# 🛰️ crud repository pattern sample

Laravel API with Repository and Service Pattern

## 🤖 Technologies & Standards

1. [Laravel](https://laravel.com/docs/9.x) `v9`
2. [Laravel Eloquent](https://laravel.com/docs/9.x/eloquent)
3. [Laravel Events](https://laravel.com/docs/9.x/events)
4. [Laravel Queues](https://laravel.com/docs/9.x/queues)
5. [Laravel Task Scheduling](https://laravel.com/docs/9.x/scheduling)
6. [Laravel Testing](https://laravel.com/docs/9.x/testing)
7. [Laravel Sail](https://laravel.com/docs/9.x/sail) <sup><i>optional</i></sup>
8. [PHP PSR2 Coding Style Standard](https://www.php-fig.org/psr/psr-2)
9. [PHPUnit](https://phpunit.de)
10. [PHPStan](https://phpstan.org) (with [Larastan](https://github.com/nunomaduro/larastan) extension)
11. [PgSQL 15.x](https://www.postgresql.org/)

<br/>

## 👨‍💻 Getting Started

Follow one of the following steps to deploy the application at the **development** stage.

### ✔️ Requirements

1. PHP >= `v8.1`
2. Composer `v2`
3. PgSQL Server `v15.0+`
4. [Laravel Homestead](https://laravel.com/docs/9.x/homestead) / [Laravel Valet](https://laravel.com/docs/9.x/valet) <sup><i>optional</i></sup>

#### 🖥️ Installation

1. `composer install`
2. `php artisan key:generate`
3. `php artisan migrate`

> ##### 📝 Informations
>
> -   Make sure that the PHP extensions needed by Laravel `v9` are installed in the local development environment, according to the official [documentation](https://laravel.com/docs/9.x/deployment)
> -   Use `php artisan serve` to open application via PHP Built-in Web Server
> -   Use `php artisan queue:work database` to test the [Queues](https://laravel.com/docs/9.x/queues) feature
> -   Use `php artisan schedule:run` to test the [Task Scheduling](https://laravel.com/docs/9.x/scheduling) feature
> -   Use `php artisan optimize` after development to speed up app performance
> -   Use `php artisan make:repository {repository name}` for make new repository
> -   Use `php artisan make:service {service name}` for make new service
> -   Use `php artisan make:trait {trait name}` for make new trait
