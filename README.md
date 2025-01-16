# AksaMedia Backend Test Intern
Easy setup dev environment

#### Tech Stack:
- Laravel
- Sanctum

## Requirements:
- git
- docker compose
- php
- composer

---

# All the things to get started:
- first, clone the git repo, `this will install on the path you're on!`.
  
  ```bash
  git clone https://github.com/raihandotmd/aksaMediaBE-testIntern.git RaihanAksaMedia/ && cd RaihanAksaMedia/
  ```
- after that, we need to setup our `.env` or just use defaut `.env.example` template that i have configured.
  
  ```bash
  cp .env.example .env
  ```
- then, we need to change directory and start docker compose which install `adminer` & `mySQL` in **isolated container** environment.
  with `-d` for detaching it.
  
  ```bash
  docker compose up -d
  ````

- we can now start installing composer `depedencies` & migrate our database and seeding it (fills with data).
  also imported `nilai.sql` in container.
  ```bash
  composer install && php artisan migrate --seed
  ```

- finally, now we can start the web api application.

  ```bash
  composer run dev
  ```
---

# Accessing API
The url web API is on:
`http://localhost:8000/api`

# Postman File Collection
Download [here](https://drive.google.com/file/d/18DI716O3fd_bafwTNjx5AnrS9-MM_qBP/view?usp=sharing) (Google Drive)
