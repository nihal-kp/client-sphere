# Client Sphere

Client Sphere is a scalable and maintainable Laravel-based application designed for efficient client management. It features a role-based system where an Admin can manage Clients, assign custom values, and perform CRUD operations, while Clients can register, manage their profile, and view assigned values

## Installation Instructions

Follow these steps to set up the project on your local machine:

1. **Clone the repository**

```bash
git clone https://github.com/nihal-kp/client-sphere.git
```

2. **Navigate into the project directory**

```bash
cd client-sphere
```

3. **Install dependencies**

```bash
composer install
```

4. **Set up environment file**

Copy the example environment file and edit the `.env` file to match your database configuration:

```bash
cp .env.example .env
```

Update the `.env` file with your database credentials and other necessary configuration.

5. **Generate application key**

```bash
php artisan key:generate
```

6. **Run migrations**

```bash
php artisan migrate
```

7. **Run the seeder**

```bash
php artisan db:seed
```

8. **Serve the application**

```bash
php artisan serve
```

You can now access the application at `http://localhost:8000`.


## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.


## Contact

For any questions or issues, please contact [nihal44.kp@gmail.com](mailto:nihal44.kp@gmail.com).