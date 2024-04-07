# Clearance Application
This is a replica application inspired by the Travel Permits system used by the Government of Uganda through the Ministry of Work & Transport in the 2021 lockdown period that run from June 2021 - August 2021. <br>
The system was used to issue travel permits to individuals who wanted to travel for purposes such as medical, work, burials, farming, etc in a bid to avoid congestion at the Ministry of Works & Transport Office, hence reducing the further spread of the CORONA Virus.<br>
The main users of this system were organisations(private, government entities, farms, etc) who were assigned an administrator account that was used to submit applications on behalf of other employees
Applications for the Travel permits were run through an individual's organisation and shared as PDF documents.

## Systenm Features
 - User authentication
 - Create organisation account
 - Delete organisation account
 - Add organisation Personnel / apply for permits
 - Edit personnel information/application
 - Delete personnel
 - Approve/reject Personnel permit applications
 - Batch approval/rejection
 - Generate and download permit PDF file
 - Search for a vehicle/number plate
 - Export CSV

## Get Started
1. Clone the application by running
```cmd
git clone https://github.com/Meakelvis/permissions.git
```
2. Install dependencies
```cmd
composer install
```
3. Make a copy of the .env.example and rename it to .env
4. Generate application key
```php
php artisan key:generate
```
5. Create a database in MySQL and update the following database variables in the .env file
```
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=
DB_USERNAME=
DB_PASSWORD=
```
6. Install and setup Mailhog. To set it up on your machine, check out the [official documentation](https://github.com/mailhog/MailHog).
6. Update the following email variables in the .env file to your
```
MAIL_MAILER=smtp
MAIL_HOST=127.0.0.1
MAIL_PORT=1025
MAIL_FROM_ADDRESS=admin@admin.com
```
7. Migrate and seed the database
```php
php artisan migrate:seed
```
This will create a super user with the following credentials
```
Email: elviskamweya@gmail.com
Password: password
```
8. Run the development server
```cmd
php artisan serve
```
9. Open a browser and go to http://127.0.0.1:800 to sign in and explore the application.


Cheers, enjoy.