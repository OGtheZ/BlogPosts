# BlogPosts is a simple blog post web app built on Laravel 10, with Breeze and Scout

### Setup

1. After downloading the project, go to the project directory and run: composer install
    1. requires PHP 8.1 or higher and composer installed globally on your system
    2. may require additional PHP extensions to be installed
2. to build assets in the terminal run: npm run build
    1. requires NPM installed
3. Setup .env , database url
    1. the database type used in this project is Postgresql
    2. create a database and add the host, port, user, password and database name
    3. set SCOUT_DRIVER to database to make models searchable in the database
    4. setup mailer data to use password reset functionality. for tests you can use mailtrap.io e.g.
    5. email verification is not enabled in project by default
4. run migrations with the command: php artisan migrate
5. populate the database with the command: php artisan db:seed
    1. this will create:
       1. 5 users, test1@example.com (pw=password) e.g.
       2. 5 blog categories
       3. 15 blog posts, 3 for each category
       4. 75 blog comments, by each user for every blog
6. to locally test application - in the terminal, in the project root directory, run: php artisan serve, to launch local server

### Features
The applications views and features are:
1. list of all blog posts (home route)
2. Log in view for guests
3. register view
4. Categories list view, clickable category names to view posts from the chosen category
5. Open blog post view, with comments and comment form for authenticated users
6. Your blogs list
7. Create blog view
8. Edit blog view
9. Profile edit view (provided by breeze, change password, name, email, delete account)
10. Newest blogs by all users
11. Search bar in the Newest blogs view, to search by title or content
12. Blogs and comments are deletable by the owner, blogs can also be edited
    1. blogs can be edited and deleted from the Your blogs view
    2. comments can be deleted in the open blog post view
