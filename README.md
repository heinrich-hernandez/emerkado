 <div style="display: flex; flex-direction: column; align-items: center; justify-content: center; text-align: center;">
        <div style="text-align: center;">
            <img src="https://github.com/heinrich-hernandez/emerkado/blob/main/app/icons/eMerkado.icon.png" width="280" height="314" alt="eMerkado" />
            <h2>eMerkado</h2>
        </div>
        <div style="text-align: center;">
            <h4>Tech Stack</h4>
            <div>
                <img src="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/nodejs/nodejs-original-wordmark.svg" height="40" alt="Node.js logo" />
                <img width="12" />
                <img src="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/npm/npm-original-wordmark.svg" height="40" alt="npm logo" />
                <img width="12" />
                <img src="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/php/php-original.svg" height="40" alt="PHP logo" />
                <img width="12" />
                <img src="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/laravel/laravel-original.svg" height="40" alt="Laravel logo" />
                <img width="12" />
                <img src="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/composer/composer-original.svg" height="40" alt="Composer logo" />
                <img width="12" />
                <img src="https://upload.wikimedia.org/wikipedia/commons/0/03/Xampp_logo.svg" height="40" alt="Xampp logo" />
                <img width="12" />
            </div>
        </div>
</div>

-----

### Get Started

Let's start with:

```shell
git clone https://github.com/heinrich-hernandez/emerkado.git
```

Make sure to have node, php and composer installed.


Now let's go to our project directory:

```shell
cd .\emerkado\
```

And then install dependencies:

```shell

composer install

npm install
```

Now let's start debugging:

```shell
composer run dev
```

#### Install and run XAMPP

Open your browser and navigate to http://localhost/phpmyadmin (or similar URL provided by your bundle).

1. Log in (default for XAMPP is root with no password).

2. Click on "New" or "Databases" in the left sidebar.

3. Enter emarkado_db in the "Database name" field.

4. Choose a collation (e.g., <strong>utf8mb4_unicode_ci</strong> is a good general choice for Laravel as it supports emojis and various characters).

5. Click "Create."

Success, now let's go back to our editor and find our .env file inside our application.

Then configure our .env file, find and, replace or uncomment:

```mysql
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=emarkado_db
DB_USERNAME=root
DB_PASSWORD=
```

Note. Please be aware that this is for testing purposes only and not advisable when deploying.

Run Laravel Migrations
Laravel uses migrations to create your database tables.

Open your terminal or command prompt.

Navigate to your Laravel project's root directory.

Run the migrations:

```php
php artisan migrate
```

Finally create your own admin.


-----

### Task List

- [ ] User Registration Form
    -[ ] Review Step Process
        - [ ] Logging

- [x] User Login
    - [x] Admin Login
        - [x] Admin Dashboard
            - [x] Coop Page
                - [x] Create Coop
                - [x] Delete Coop 
                - [x] Approve Coop 
                - [x] Review Coop  
            - [x] Merchant Page
                - [x] Create Merchant
                - [x] Delete Merchant
                - [x] Approve Merchant
            - [x] Buyer Page
                - [x] Create Buyer
                - [x] Delete Buyer
                - [x] Approve Buyer
                - [x] Review Buyer

        (create a condition if profile is dispproved, user should immediately only view and be able to edit their profile.)
    - [x] Coop Login
        - [x] Coop Dashboard
        - [ ] Coop Profile
            - [ ] Coop Profile Edit

    - [x] Merchant Login
        - [x] Merchant Dashboard
        - [ ] Merchant Profile
            - [ ] Merchant Profile Edit
        
    - [x] Buyer Login
        - [x] Buyer Dashboard
        - [ ] Buyer Profile
            - [ ] Buyer Profile Edit

#### End Notes.
This is currently is a work in progress project with lots to debug and optimize.