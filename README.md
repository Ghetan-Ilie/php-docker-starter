# php-docker-starter

A starter project for web development with **PHP**, **MySQL** and **CloudBeaver**, running entirely in Docker. One command starts everything, and the welcome page confirms that the server works, the database is connected, and data can be saved and read.

## What's inside

- **PHP 8.3 + Apache**: the web server, with the `mysqli` and `pdo_mysql` extensions
- **MySQL**: the database, with data persisted in a Docker volume
- **CloudBeaver**: a web interface for managing the database
- **Welcome page** (`public/index.php`): connection check, a form to add messages (POST) and a list of saved messages
- **Database schema** (`db/schema.sql`): creates the `messages` table and inserts sample data on first start

## Requirements

- Docker and Docker Compose

## Installation and setup

### 1. Clone the project

```bash
git clone https://github.com/YOUR_USERNAME/php-docker-starter.git
cd php-docker-starter
```

### 2. Create your `.env` file

The `.env` file holds your passwords and is **not** uploaded to GitHub. The repository includes a template, `.env.example`, which you copy:

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

Then open `.env` in an editor and replace the values with your own:

```env
MYSQL_ROOT_PASSWORD=put_a_strong_password_here
MYSQL_DATABASE=my_database
```

### 3. Start the containers

```bash
docker compose up -d --build
```

### 4. Open it in your browser

| Service     | URL                   |
|-------------|-----------------------|
| PHP website | http://localhost:8080 |
| CloudBeaver | http://localhost:8978 |

> On the first start MySQL needs a few seconds to initialize. The website waits for the database to be ready, so if the page does not load right away, wait a moment and refresh.

## Connecting to the database in CloudBeaver

- Driver: MySQL
- Host: `mysql-latest`
- Port: `3306`
- Database: `my_database` (or the value from your `.env`)
- User: `root`
- Password: the value from your `.env`

## Database

The schema and sample data live in `db/schema.sql`. MySQL runs this file **only once**, when the database volume is created for the first time. If you change it later, or change the password in `.env`, reset the database (this deletes all saved data):

```bash
docker compose down -v
docker compose up -d --build
```

## Stopping the project

```bash
docker compose down
```

To also delete the database data:

```bash
docker compose down -v
```

## Project structure

```
.
├── docker-compose.yml     # PHP + Apache, MySQL and CloudBeaver
├── Dockerfile             # PHP image with MySQL extensions
├── .env.example           # template for your .env file
├── .gitignore
├── .dockerignore
├── db/
│   └── schema.sql         # table definition + sample data
├── app/
│   └── db.php             # PDO database connection and helpers
└── public/
    └── index.php          # welcome page (the only folder served by Apache)
```

## Security notes

- Never commit your `.env` file. It is listed in `.gitignore`.
- Only the `public/` folder is served by Apache, so `.env`, `schema.sql` and the PHP helpers cannot be downloaded from the browser.
- The database port `3306` is published for convenience during development. Remove the `ports` entry for MySQL in `docker-compose.yml` if you do not need external access.
