# installation!


## Create Environment

in root folder of the project: 
**docker-compose up -d**
in the php container in /var/www/html do **composer install**.
in the node image **docker run -ti -v $PWD:/app	**. in the container in /app do ```
**yarn encore dev --watch**