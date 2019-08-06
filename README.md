# Amplitudo CMS

Simple Website CMS based on specifications provided by Amplitudo team 

## Getting Started

These instructions will get you a copy of the project up and running on your local machine for development and testing purposes.

### Prerequisites

As a Laravel project here's which things you will need to install to get it up and running

```
PHP >= 7.1.3
Composer - Dependency Manager for PHP
```

### Installing

A step by step series of examples that tell you how to get a development env running:

After installing composer you are supposed to download and install laravel
```
composer global require laravel/installer
```

Once you have laravel installed and have cloned the project and cd into the directory you are ready to proceed with these steps:

#### Install Composer Dependencies
```
composer install
```

#### Install NPM Dependencies
```
npm install
```

#### Create a copy of your .env file
```
cp .env.example .env
```

#### Generate an app encryption key
```
php artisan key:generate
```


## Populating the database with dummy data

Firstly run the migrations:
```
php artisan migrate
```
and then the seeds to fill the database with dummy data:
```
php artisan db:seed
```

### Logging in as admin or moderator after seeding the data

Admin Credentials

```
username:admin
password:admin
```
Moderator Credentials
```
username:moderator
password:moderator
```
## Authors

* **Stefan Nikocevic** 
