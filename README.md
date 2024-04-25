# URL Shortener with Laravel, Vue, Tailwind and Inertia.

## Run the application with docker

## Run the terminal

- cd url_shortener
- cp .env.example .env
- composer install
- npm install
- npm run build
- 
- alias sail='[ -f sail ] && sh sail || sh vendor/bin/sail'
- sail up -d
- sail artisan migrate
- sail artisan key:generate
- sail artisan storage:link
  
## Run the tests
 sail artisan test

## Run the scedule worker
sail artisan queue:work --queue=transitions

## Run the application server
http://localhost

## Run the mail browser
### Mailpit (will be needed to verify email after registration) 
http://localhost:8025/

## Run the telescope browser
http://localhost/telescope