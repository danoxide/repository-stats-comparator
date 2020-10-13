# About the repositories stats comparator
Repositories comparator fetch two repositories statistics from GitHub, compare and shows them (like stars, subscribers, open pulls, etc.).
It helps you as a developer to choose which repository is better.

## Installation
To run application you have to have installed Docker and Docker Compose. Enter app directory, build and run it using commands listed below:
```
$ docker-compose build
$ docker-compose up -d
```
Next step is to enter our PHP container using `docker exec` command and install app dependencies, where "stats-comparator_php_1" is your container name.
```
$ docker exec -it stats-comparator_php_1 bash
root@86cd7e3768fe:/var/www/app# composer install
```

#### Usage
When the app was created correctly then you can enter following link in your browser and see the result:
```
http://127.0.0.1/compare?first=drupal/core&second=pestphp/pest
``` 
