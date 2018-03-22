# RestIgniter CRUD
A fork of [CodeIgniter Rest Server](https://github.com/chriskacerguis/codeigniter-restserver) that has been enhanced for ease of use mainly CRUD operations for developing your own RESTful API. This project will also include a CMS in the future versions.

## Requirements
+ PHP 5.4 or greater

## Setup
These files are excluded or untouched in the version control of this project and so you need to edit them with your respective environment variables.
+ Modify `application/config/config.php`
+ Modify `application/config/database.php`

## Migrate
Go to your `application/migrations/` folder and add or modify your migration classes there.

Migrations are automatically enabled in the `application/migration.php` file (because I enabled it). Though I recommend to set `$config['migration_enabled'] = TRUE;` to `FALSE` when your application is in _production mode_ or after you have migrated your database.

### How to use migrations
This repo comes with a Migration controller by default. You can add more commands to the controller as you wish. You can find it in the `application/controllers` folder.

Here are the built-in commands that comes with this repo. Replace `http://localhost/your_site` with your base url.


* __Latest__  
`http://localhost/your_site/migrate`
`http://localhost/your_site/migrate/latest`  
Access this in your browser to perform your migrations to the latest available migration.
* __Reset__   
`http://localhost/your_site/migrate/reset`  
Use this to roll back all migrations. (Usually removes all data in the database)
* __Refresh__  
`http://localhost/your_site/migrate/refresh`  
Perform `reset` then `latest`


## Development reminders
+ Make sure you customize your `application/config/routes.php` and set up your API routes there manually since Codeigniter uses the _magic routing_. Most of the time, you will have to have more control in your routes for a more pragmatic RESTful design.
+ In uploading, you can set your `DEFAULT_FOLDER_PERMISSIONS` constant in `application/config/constants.php`

## TODO:
+ Integrate create folder in core upload class
+ Documentation of MY_Controller
