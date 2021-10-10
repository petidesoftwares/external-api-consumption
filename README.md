#   External-api-consumption
An API to consume the resources of an external api.
## Project Setup
1. Clone main branch of the projet form this git repository.
2. Navigate to the project directory in your local environment via ur cmd interface or you open direct from your editor. 
3. Create a storage database in your local system .
4. Open your terminal and navigate to the project diretory and start the development server with the following command.
> cd external-api-consumption>php artisan serve
> Your will see something like this<br>
> Starting Laravel development server: http://127.0.0.1:8000
> [Wed Sep 29 20:49:10 2021] PHP 7.4.1 Development Server (http://127.0.0.1:8000) started 
5. Copy the url, that is the server url serving the project. It is what u will use for serving all ur app endpoints
6. Open the .env file in your project root directory and update the database credential.
> DB_CONNECTION=mysql
> DB_HOST=127.0.0.1
> DB_PORT=
> DB_DATABASE=consume_external_api_db
> DB_USERNAME=
> DB_PASSWORD=
7. Open your terminal and navigate to the project diretory and write the following command to add the database tables to your database .
> cd external-api-consumption>php artisan migrate
Then you are good to go.

## Testing
#### Consuming the external API 'Ice and Fire'.

