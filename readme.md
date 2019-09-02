# PHP CRUD API with QraphQL
- A Simple crud api using GraphQL with lighthouse library and GraphQL playground for a blog post with users and articles

# Technology

- Laravel Framework v5.8

- PHP v7.1.3

- LightHouse v3.1 for building the graphql server (https://github.com/nuwave/lighthouse)

- Data was persisted with Sqlite
        
- Nginx as the reverse proxy server        

- Testing was done with PhpUnit

# Main Packages

- This can be found in the composer.json in the root directory of the project

- PhpUnit 7.5 was used for testing , i am more familiar with this than others like Codeception and Behat


# To run locally

- Git clone this repository
- Change directory into root of cloned folder
- Enter `composer install` (assuming you have `composer` and its related packages installed and or configured)
- Rename `.env.example`  to `.env` (This contains the app configs and databases settings)
- Configure your database settings in `.env` or use sqlite
- Enter `php artisan serve` to start application
- Enter `php artisan migrate` to run migration 
- Enter `php artisan db:seed` to run seed some some records 
- Run tests with `composer test`
- Open ttp://localhost:8000 or http://127.0.0.1:8000 to access the playground

# Queries to run - CRUD operations on users and articles
```bash

Get all users:
 {
  users {
    id
    email
    name
  }
}

Get user with articles :
{
  user(id:1) {
    articles {
      id
      title
    }
  }
}

Create user :
mutation {
  createUser(
    name:"John Doe"
    email:"john.doe@example.com"
    password: "secret"
  ) {
    id
    name
    email
  }
}

Update user :
mutation {
  updateUser(
    id: 1  
    name:"John Doe"
    email:"john1.doe1@example.com"
    password: "secret"
  ) {
    id
    name
    email
  }
}

Create article:
mutation {
  createArticle(
    user_id: 1  
    title:"Building a GraphQL Server with Laravel"
    content:"In case you're not currently familiar with it, GraphQL is a query language used to interact with your API..."
  ) {
    id
    author {
      id
      email
    }
  }
}
```

# Data Migration

- This is found in database/migrations/ in the root directory of the project

# Routes

- This can be found in routes/web.php in the root directory of the project 
 