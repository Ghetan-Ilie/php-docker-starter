# php-docker-starter

Proiect de pornire pentru dezvoltare web cu **PHP**, **MySQL** și **CloudBeaver**, rulat complet în Docker. Se pornește cu o singură comandă și afișează o pagină de bun venit care confirmă că serverul funcționează și că baza de date este conectată.

## Ce conține

- **PHP 8.3 + Apache**: serverul web, cu extensiile `mysqli` și `pdo_mysql`
- **MySQL**: baza de date, cu date persistente într-un volum Docker
- **CloudBeaver**: interfață web pentru administrarea bazei de date
- **Pagină de bun venit** (`index.php`) cu test automat de conexiune la MySQL

## Cerințe

- Docker și Docker Compose

## Instalare și pornire

### 1. Clonează proiectul

```bash
git clone https://github.com/NUME_UTILIZATOR/php-docker-starter.git
cd php-docker-starter
```

### 2. Creează fișierul `.env`

Fișierul `.env` conține parolele tale și nu este urcat pe GitHub. În proiect există un șablon, `.env.example`, pe care îl copiezi:

**macOS / Linux:**
```bash
cp .env.example .env
```

**Windows (CMD):**
```cmd
copy .env.example .env
```

**Windows (PowerShell):**
```powershell
Copy-Item .env.example .env
```

Apoi deschide `.env` într-un editor și înlocuiește valorile cu ale tale:

```env
MYSQL_ROOT_PASSWORD=pune_aici_o_parola_sigura
MYSQL_DATABASE=my_database
```

### 3. Pornește containerele

```bash
docker compose up -d --build
```

### 4. Deschide în browser

| Serviciu    | Adresă                |
|-------------|-----------------------|
| Site PHP    | http://localhost:8080 |
| CloudBeaver | http://localhost:8978 |

> La prima pornire MySQL are nevoie de câteva secunde. Dacă pagina arată că baza de date nu răspunde, reîncarc-o peste puțin timp.

## Conectare la baza de date din CloudBeaver

- Host: `mysql-latest`
- Port: `3306`
- Utilizator: `root`
- Parolă: cea din fișierul `.env`

## Oprire

```bash
docker compose down
```

Pentru a șterge și datele bazei de date:

```bash
docker compose down -v
```

## Structură

```
.
├── docker-compose.yml
├── Dockerfile
├── config.php
├── index.php
├── .env.example
├── .gitignore
└── .dockerignore
```