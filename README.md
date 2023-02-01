# Ta Moto

Site web développé pour notre projet de web temps réel de 5ème année à l'ESGI de Paris.
Énoncé : "Vous faites partie d’un grand groupe moto qui souhaite moderniser sa plateforme avec la mise en
place d’un système d'échange instantané afin de renforcer sa communication auprès de ses clients."

## Screenshots

![App Screenshot](https://imgur.com/DqdWYHR)

![App Screenshot](https://imgur.com/PoUddWk)


## Installation

Veillez à utiliser docker pour l'intégralité du projet

#### Installation et lancement du projet
```bash
  make install
  make start
```

#### Construction de la base de données

Il faut exécuter le script save_db_ta_moto.sql se trouvant dans le dossier "database" pour construire la base de données car les migrations ne sont pas fonctionnelles avec Laravel Voyager

Ensuite il faut seed la base de données avec les commandes suivantes :

```bash
  make seed
```

#### Compte administrateur

Pour accéder au panel d'administration, il faut posseder un compte administrateur, par défaut un compte est créé avec les identifiants suivants :

```bash
  email : admin@admin.com
  password : password
```

#### Pusher / Laravel Echo / Laravel Websockets

Si vous souhaitez utiliser les fonctionnalités de chat en temps réel, vous devrez créer un compte sur [Pusher](https://pusher.com/) et renseigner les clés d'API dans le fichier .env

Si vous ne souhaitez pas utiliser ces fonctionnalités, vous pouvez alors utiliser la commande suivante pour démarrer un serveur de websockets en local :

```bash
  make websockets
```

Veillez à avoir instancié la variable d'environnement APP_URL avec l'adresse de votre serveur local
Veillez à avoir instancié la variable d'environnement BROADCAST_DRIVER avec la valeur "local" si vous utilisez le serveur de websockets local

## Variables d'environnement

Pour utiliser ce projet dans les meilleures conditions, vous aurez besoin d'initialiser certaines variables d'environnement dans le fichier .env ou .env.local

`DB_CONNECTION` : mysql

`DB_HOST` : mysql

`DB_PORT` : 3306

`DB_DATABASE` : nom de la database (par défaut : laravel)

`DB_USERNAME` : sail

`DB_PASSWORD` : password

## Features

- Panel d'administration entièrement fonctionnel et personnalisable
- CRUD des motos / catégories / utilisateurs / forums / notifications
- Chat en temps réel
- Chatbot avec prise de rendez-vous
- Communication entre utilisateurs par demandes
- Notifications en SSE

## Tech Stack

**Client:** AlpineJS, TailwindCSS, Blade, DaisyUI

**Server:** PHP, Laravel, Docker

**ORM:** Eloquent

**WS:** Pusher

**Database:** MySQL


## Demo

[TaMoto](https://ta-moto.osc-fr1.scalingo.io/home)


## Auteurs

- [@Mael Jamin](https://github.com/MaelStorm176)
- [@Raphaël Bessonnier](https://github.com/ThePrimesBros)

## License

[MIT](https://choosealicense.com/licenses/mit/)
