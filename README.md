# School Manager CRUD Challenge


## About

This challenge involves the creation of a CRUD (Create, Read, Update, Delete) application for managing schools. The application is built using Laravel, a powerful PHP framework known for its expressive and elegant syntax.

### Features

- **Simple, fast routing engine:** Laravel provides a routing system that is both simple to use and lightning-fast.
- **Powerful dependency injection container:** With Laravel's container, managing class dependencies becomes a breeze.
- **Multiple back-ends for session and cache storage:** Laravel supports various back-ends for session and cache storage, offering flexibility and scalability.
- **Expressive, intuitive database ORM:** Laravel's ORM (Object-Relational Mapping) system provides an intuitive way to interact with the database, making database operations straightforward.
- **Database agnostic schema migrations:** Laravel's migration system allows for database schema changes to be version controlled and easily shared across development teams.
- **Robust background job processing:** The framework comes with built-in support for processing background jobs efficiently.
- **Real-time event broadcasting:** Laravel simplifies the implementation of real-time event broadcasting, enabling seamless communication between server and client.

Laravel empowers developers to build accessible and powerful web applications, providing the necessary tools for creating large-scale and robust systems.

## Getting Started

To begin working on the Escola Manager CRUD Challenge, follow these steps:

1. Clone the repository to your local machine:

# Clone o repositório
```bash
git clone [repository_url](https://github.com/Guel-Almeida/desafio.git)

# Navegue até o diretório do projeto

cd <project_directory>

# Instale as dependências do projeto usando o Composer

composer install

# Gere a chave da aplicação

php artisan key:generate

# Execute as migrações do banco de dados para configurar as tabelas necessárias

php artisan migrate

# Gere a documentação Swagger

php artisan l5-swagger:generate

# Finalmente, inicie o servidor de desenvolvimento Laravel

php artisan serve


