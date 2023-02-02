## Installation

### Requirements 
 1. PHP
 2. MYSQL
 3. REDIS
 4. COMPOSER
 5. NPM
 6. [LARAVEL-ECHO-SERVER](https://github.com/tlaverdure/laravel-echo-server)

### Installation and Configuration
 
1.) Install php packages
```
composer install
```

2.) Get the required node modules:
```
npm install
```

3.) copy configuration template .env.example to .env
```
cp .env.example .env
```

4.) set .env DB credentials and the following configuration
```
DB_DATABASE=yourdbname
DB_USERNAME=mysqluser
DB_PASSWORD=mysqlpass
```
```
APP_URL=http://local-site.com
APP_DOMAIN=local-site.com
APP_SOCKET_SERVER=local-site.com
SESSION_DOMAIN=.local-site.com
```
**Note:** notice " . " before the domain on "SESSION_DOMAIN" this is for wildcard sub-domains.

5.) Set the key that Laravel will use when doing encryption
```
php artisan key:generate
```

6.) Run migrations to create the database tables
```
php artisan migrate
```

7.) Seed the database with default records
```
php artisan db:seed
````

8.) Modify  ``` echo/laravel-echo-server.json ``` and set the following configurations

 - authHost
 - keyPrefix
	**APPNAME** on the prefix should match APP_NAME on your ```.env``` file
 - allowOrigin

```
"authHost": http://local-site.com,
"databaseConfig": {
	"redis": {
		"keyPrefix": "APPNAME_database_"
	},
},
"apiOriginAllow": {
	"allowOrigin": "http://local-site.com:6001",
}
```

### Default Credentials
1.) Super admin user
```
username=admin@lucky8
password=password
```

## Development

```
1.) Compile js/css/assets for production
```
npm run prod
```

### Running the app locally

1.) Running local websocket
```
cd to app directory && laravel-echo-server start
```

2.) Running Workers on Local
```
php artisan queue:work
```
