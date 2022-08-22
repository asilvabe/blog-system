<h1 align="center">Blog System</h1>

<!-- TABLE OF CONTENTS -->
## Table of Contents

* [About the Project](#about-the-project)
    * [Built With](#built-with)
* [Installation](#installation)
* [Contributing](#contributing)
* [Team](#team)

<!-- ABOUT THE PROJECT -->
## About The Project

A simple project started for learning purposes and for fun.

### Built With
* [Laravel](https://laravel.com)

### Installation

1. Clone the repo
```sh
git clone git@github.com:asilvabe/blog-system.git
```

2. Copy the .env.example file
```sh
cp .env.example .env
```

3. Install the project dependences
```sh
composer install
```

4. Generate the application key
```sh
php artisan key:generate
```

5. Run migrations
```sh
php artisan migrate
```

6. Set the default values for the first admin user
```sh
In the .env file set the values:

ADMIN_NAME=
ADMIN_EMAIL=
ADMIN_PASS=
```

7. Seed the database with test data
```sh
php artisan db:seed
```

<!-- CONTRIBUTING -->
## Contributing

Contributions are what make the open source community such an amazing place to be learn, inspire, and create. Any contributions you make are **greatly appreciated**.

1. Fork the Project
2. Create your Feature Branch (`git checkout -b feature/amazing-feature`)
3. Commit your Changes (`git commit -m 'feat: add some AmazingFeature'`)
4. Push to the Branch (`git push origin feature/amazing-feature`)
5. Open a Pull Request

<!-- Team -->
## Team

Victor Hernández - https://github.com/biskukuy  
José Quevedo - https://github.com/jquevedo82  
Alejandro Silva - https://github.com/asilvabe
