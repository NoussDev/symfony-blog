# symfony-blog

`To use the blog`

You have : 
- PHP 7.1 for symfony 4
- composer installed
- Symfony in your computer for run the internal server
- MySql and Apache server (or others)

You must : 
- git clone https://github.com/NoussDev/symfony-blog.git
- cd symfony-blog
- composer install
- php bin/console doctrine:database:create  (look at your .env file to configure the database if you have an error)
- php bin/console doctrine:migrations:migrate
- symfony server:start

and jump to your URL : http://127.0.0.1:8000