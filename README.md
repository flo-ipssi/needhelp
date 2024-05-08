# NeedHelp Project
Based on Mysql

## Remarque
Quelques problèmes de devons et de react m'ont empêché de terminer complètement le développement donc je me suis limité à l'essentiel

## Installation

#### Step 1 

```
$ git clone https://github.com/flo-ipssi/needhelp.git

```
#### Step 2 - Montages des differents containers

```
$ docker-compose up -d
```

#### Step 3 - Installation des dependances et déploiement

```
$ cd needhelp
$ composer install
$ npm install
$ npm build
$ npm build

```
#### Step 4 - Création de la base de donnée et des fixtures

```
$ cd needhelp
$ php bin/console doctrine:database:create
$ php bin/console doctrine:migrations:migrate
$ php bin/console doctrine:fixtures:load

```

#### Step 5 - Lancement de l'application

```
$ symfony server:start
```
OU

```
$ php bin/console server:start
```
Le serveur devrait se lancer sur [http://localhost:8000](http://localhost:8000).

