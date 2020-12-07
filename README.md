# Laravel Docker 

## Docker

To run this app locally docker is needed and can be downloaded from the following links.

- [Mac Download ](https://hub.docker.com/editions/community/docker-ce-desktop-mac)
- [Windows Download](https://hub.docker.com/editions/community/docker-ce-desktop-windows)
- [Linux Guide](https://runnable.com/docker/install-docker-on-linux)

## Web

- Nginx: [localhost:${DOCKER_NGINX_PORT}](localhost:${DOCKER_NGINX_PORT})
- PhpMyAdmin: [localhost:${DOCKER_PHPMYADMIN_PORT}](localhost:${DOCKER_PHPMYADMIN_PORT})

## Database

- MySQL: [localhost:${DOCKER_MYSQL_PORT}](localhost:${DOCKER_MYSQL_PORT})

### Sequel Pro / Table Plus

```
Host: 127.0.0.1
Username: ${DB_USERNAME}
Password: ${DB_PASSWORD}
Database: ${DB_DATABASE} 
Port: ${DOCKER_MYSQL_PORT}
```

### PhpMyAdmin

```
Username: ${DB_USERNAME}
Password: ${DB_PASSWORD}
```

## Install

With ``make init`` all needed dependencies will be installed, the Database will be prepared and a ssh connection will be started

## Start

With ``make start`` the project and a ssh connection will be started. 

## Stop

Stop all containers with ``make stop``.

## Remove

Remove all containers with ``make remove``