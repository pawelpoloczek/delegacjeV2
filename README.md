#Docker LAMP

Docker settings for setup LAMP environment with composer and virtual hosts. Configured php extensions: zip, pdo, pdo_mysql, mysqli, gd. Configured applications/libraries: libpng-dev, libfreetype6-dev, libjpeg62-turbo-dev, nano, composer, php (7.2.1), apache2 (2.4.25), mysql (mariadb 10.1.35), adminer (4.6.3).

##Setup containers
- Install docker-ce [https://docs.docker.com/install/](https://docs.docker.com/install/) 
- Clone or download repository and run docker compose in the repository directory: `docker-compose up`

###Useful docker commands
- setup containers with rebuild: `docker-compose --build`
- list all containers identifiers: `docker ps -a -q`
- stop container: `docker stop CONTAINER_ID`
- remove container: `docker rm CONTAINER_ID`
- stop all running containers: `docker stop $(docker ps -s -q)`
- remove all containers: `docker rm $(docker ps -a -q)`
- list all images: `docker images --all`
- remove all images: `docker rmi $(docker images --all)`
- login to container bash: `docker exec -it CONTAINER_NAME /bin/bash`
- check container IP address: `docker inspect -f '{{range .NetworkSettings.Networks}}{{.IPAddress}}{{end}}' CONATINER_NAME`
- check docker network: `docker network ls`, `docker network inspect NETWORK_NAME`