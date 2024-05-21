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

#### Step 3 - Création de la base de donnée et des fixtures

```
$ docker exec -it php bash
$ php bin/console doctrine:database:create
$ php bin/console doctrine:migrations:migrate
$ php bin/console doctrine:fixtures:load

```

#### Step 5 - Lancement de l'application

Le serveur devrait se lancer sur [http://localhost](http://localhost).

