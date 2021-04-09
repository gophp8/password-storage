# GoPHP8 - Password Management / Storage

This is a simple project where you can store your password into 1 place to manage.

There're plenty services out there, I know. But it's good and simple project where we can practice:

- PHP8
- Laravel 8.x

## Database

For instance, I'm going to use `SQLite` in the localhost

I think we can switch to any databases if we want, PDO you know. Super amazing.

Local configuration:
```dotenv
DB_CONNECTION=sqlite
DB_DATABASE=./storage/database.sqlite
```

## Tables

We won't use Laravel's built-in Authentication. So that's why you won't find any migrations related to that.

We will have:

- `master_settings` which basically a key/value storage to store access password and backup password
- `passwords` to save passwords
- `password_histories` to save the changes of the password

## Run the project

### Installation
```bash
cd <to_your_project_root>
composer install
cp .env.example .env

# Before this step, edit your env information

php artisan key:generate
php artisan migrate
```

### Test

Visit your **localhost**, mine is `http://localhost/password-storage/public`

## Copyright
All right reserved by GoPHP8 2021.
