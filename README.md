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
  make start
  make install
```

#### Construction de la base de données
```bash
  make build-db
```

#### Build des assets
```bash
  make npm-build
```
OU
```bash
  make npm-dev
```
OU
```bash
  make npm-watch
```
#### Importation des données de Marmiton (optionnel)
```bash
  make marmiton
```



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
