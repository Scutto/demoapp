## Setup

Run this command to build the docker images

`docker compose build --pull --no-cache`

Run this command start docker and the project

`docker compose up --wait`

## Available routes

- `/` home page, list of users 
- `/users/store` page to create new user
- `/users/{id<\d+>}` detail page for user
- `/users/{id<\d+>}/edit` page to edit a user
- `/users/{id<\d+>}/delete` page to delete a user
