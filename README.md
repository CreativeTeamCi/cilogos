# Ci-logos

This is an open source project where you can download for free a hight quality logos of Ivory Coast companies. You can visit the wesite at [ci-logos.com](https://ci-logos.com).
## Getting Started

Ci-logos is a simple web app built with Laravel. Follow the instructions below to set up the project on your local machine for development and testing purposes.
## Deployement
- Clone the main branch with
    `$ git clone --branch master https://github.com/CreativeTeamCi/cilogos.git`
- Then install all packages in project directory with
    `$ composer install`
- Wait for all packages to be installed and now opent and configure the .env file for the database email sending
```js
...
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=cilogos
DB_USERNAME=root
DB_PASSWORD=
...
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS=null
MAIL_FROM_NAME="${APP_NAME}"
...
```
- Launch fresh migration with seeders
    `$ php artisan migrate:fresh --seed`
    
- Launch command to creating the symbolic link
    `$ php artisan storage:link
- Run the server
    `$ php artisan serve`

## Authors
* [**Michael Yves SANA**](https://github.com/SanaMichael)
* [**Euphrate André ATCHORI**](https://github.com/andreatchori) 
* [**N'Gana Alhassane SORO**](https://github.com/AlhassaneSoro)
