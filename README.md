# NeedHelp Project
Based on Mysql NGINX Node PHP8 Phpmyadmin

## Installation

#### Step 1 

```
$ git clone https://github.com/flo-ipssi/needhelp.git

```
#### Step 2 - Montages des differents containers

```
$ docker-compose up -d
```

#### Step 3 - Création de la base de donnée et des fixtures et generation des clés SSL

```
$ docker exec -it php bash
$ composer install
$ php bin/console doctrine:database:create
$ php bin/console doctrine:migrations:migrate
$ php bin/console doctrine:fixtures:load
$ php bin/console lexik:jwt:generate-keypair

```

#### Step 4 - Lancement de l'application

Le serveur devrait se lancer sur [http://localhost](http://localhost).
PHPMyadmin [http://localhost:8080](http://localhost:8080).

Vous pouvez vous connecter avec ces identifiants : 
Email : user0@example.com
MDP : password
