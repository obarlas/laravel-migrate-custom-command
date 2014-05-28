laravel-migrate-custom-command
==============================

Purpose of this package is to create database migration files from custom templates since custom migration templates are not available in Laravel.

Instead of hard coding table names in the migration class, I prefer to use global variables so I can just copy/paste the same creation and foreign key strings to other migration files easily, also I have default columns on my tables so this prevents me from rewriting every database migration file.

Usage
=====

- You must add the package to your app config.

```php
'Obarlas\LaravelMigrateCustomCommand\LaravelMigrateCustomCommandServiceProvider',
```

- In the ```src/stubs``` folder of the package original stubs from the Laravel package can be found, create and copy them to your ```app/views/migration-templates``` folder. Now you can edit the stubs according to your needs.

- Usage is simple

```
php artisan migrate:custom stub_name class_name --table=table_name
```

- ```migrate:custom``` command checks if there is a ```{{table}}``` variable in the stub file, and if no ```--table``` argument is passed it stops.
