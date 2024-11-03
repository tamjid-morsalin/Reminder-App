Clone the repository with git clone
Copy .env.example file to .env and edit database credentials there
Run: composer install
Run: php artisan key:generate
Run: php artisan migrate --seed (it has some seeded data for your testing)
That's it: launch the main URL.
    - http://127.0.0.1:8001/login
You can login to adminpanel with default credentials admin@admin.com - password
