<div align="center">
    <img src="https://i.imgur.com/YlGrpaq.png" width="800px" height="auto">
</div>

# 🌐 Family Hub © 2024

![family-hub](https://github.com/isabella-projects/familyhub/assets/76888305/54baf047-8d5e-4a64-b7d9-cf5f2c868ae0)

# 📝 Description

## Family Hub is a mini social media web application.

### What you can learn from this repository?

-   Authentication middleware
-   CRUD operations
-   API authentication - Sanctum
-   Chat, Emails and more interesting functions

# 🛠 Tech Stack

<div>
    <img src="https://github.com/devicons/devicon/blob/master/icons/laravel/laravel-original.svg" title="Laravel" alt="Laravel" width="45" height="45"/>&nbsp;
    <img src="https://github.com/devicons/devicon/blob/master/icons/php/php-original.svg" title="PHP" alt="PHP" width="45" height="45"/>&nbsp;
    <img src="https://github.com/devicons/devicon/blob/master/icons/javascript/javascript-original.svg" title="JavaScript" alt="JavaScript" width="45" height="45"/>&nbsp;
    <img src="https://github.com/devicons/devicon/blob/master/icons/jquery/jquery-original.svg" title="jQuery" alt="jQuery" width="45" height="45"/>&nbsp;
    <img src="https://github.com/devicons/devicon/blob/master/icons/css3/css3-original.svg" title="CSS3" alt="CSS3" width="45" height="45"/>&nbsp;
    <img src="https://github.com/devicons/devicon/blob/master/icons/bootstrap/bootstrap-original.svg" title="Bootstrap" alt="Bootstrap" width="45" height="45"/>&nbsp;
    <img src="https://github.com/devicons/devicon/blob/master/icons/mysql/mysql-original-wordmark.svg" title="MySQL" alt="MySQL" width="45" height="45"/>&nbsp;
    <img src="https://github.com/devicons/devicon/blob/master/icons/vitejs/vitejs-original.svg" title="ViteJS" alt="ViteJS" width="45" height="45"/>&nbsp;
    <img src="https://github.com/devicons/devicon/blob/master/icons/composer/composer-original.svg" title="Composer" alt="Composer" width="45" height="45"/>&nbsp;
    <img src="https://github.com/devicons/devicon/blob/master/icons/git/git-original.svg" title="Git" alt="Git" width="45" height="45"/>&nbsp;
    <img src="https://github.com/devicons/devicon/blob/master/icons/vscode/vscode-original.svg" title="VSCode" alt="VSCode" width="45" height="45"/>
</div>

# Cloning the project

```bash
  git clone https://github.com/isabella-projects/familyhub.git
```

## Go to the project directory

```bash
  cd familyhub
```

# Setup Instructions

1. Install Composer Dependencies: In the project directory run:

```bash
  composer install
```

2. Copy Environment File: Create a copy of the .env.example file and name it .env:

```bash
  cp .env.example .env
```

3. Generate Application Key: Run the following command to generate an application key:

```bash
  php artisan key:generate
```

4. Configure Database: Modify the .env file to configure your database connection:

```mysql
  DB_CONNECTION=mysql
  DB_HOST=127.0.0.1
  DB_PORT=3306
  DB_DATABASE=your_database_name
  DB_USERNAME=your_database_username
  DB_PASSWORD=your_database_password
```

-   Replace `your_database_name`, `your_database_username`, and `your_database_password` with your actual database credentials.

5. Run Migrations: Execute outstanding migrations with:

```bash
  php artisan migrate
```

6. Start the Laravel Development Server:

```bash
  php artisan serve
```

### License

This project and the Laravel framework are licensed under the [MIT License](https://opensource.org/licenses/MIT).