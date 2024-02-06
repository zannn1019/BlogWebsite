# Blog Website Without Authentication

This is a simple blog website project that does not require authentication. It allows users to view blog posts and their details, as well as create new blog posts.

## Technologies Used

- Frontend: Nuxt.js
- Backend: Laravel
- Database: PostgreSQL
- Containerization: Docker

## Prerequisites

Before running this project, ensure you have the following installed:

- Node.js
- NPM (comes with Node.js)
- Docker
- Docker Compose

## Getting Started

1. Clone the repository:
<code>git clone https://github.com/zannn1019/BlogWebsite.git</code>

2. Navigate to the project directory:

cd blog-website

markdown
Copy code

3. Install frontend dependencies:

cd frontend
npm install

markdown
Copy code

4. Install backend dependencies:

cd ../backend
composer install

markdown
Copy code

5. Configure environment variables:

   - Create a `.env` file in the `backend` directory.
   - Copy the contents of `.env.example` to `.env`.
   - Modify the database connection settings to match your PostgreSQL configuration.

6. Build and start the Docker containers:

docker-compose up --build

markdown
Copy code

7. Access the frontend:

   Open your browser and go to `http://localhost:3000`.

8. Access the backend API:

   The backend API is accessible at `http://localhost:8000`.

## Features

- View list of blog posts
- View details of a specific blog post
- Create a new blog post

