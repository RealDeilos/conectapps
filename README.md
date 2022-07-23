
## Conectapps
Steps after git clone: 
- 1 Go to the folder application using cd command on your cmd or terminal
- 2 Run composer install on your cmd or terminal
- 3 Copy .env.example file to .env on the root folder
- 4 Open your .env file and change the database name (DB_DATABASE), username (DB_USERNAME) and password (DB_PASSWORD) field correspond to your configuration.
- 5 Run: php artisan key:generate
- 6 Run: php artisan migrate
- 7 Run: php artisan serve
- 8 Run: curl --request POST http://localhost:8000/posts (route post test, for practical matters Csrf has been excluded in VeryCsrfToken.php file)

About this Project:
App Post Endpoints:
- GET /posts => Get posts in JSON format limit=10, query /posts?page={X} /current page=1
- POST /posts => Store posts in DB from https://jsonplaceholder.typicode.com/posts
- GET /posts/{post} => Get one record filtered by id in JSON format

Run Some Tests
- Run: php artisan test





