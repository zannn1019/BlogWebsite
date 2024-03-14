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
### Docker
1. Clone the repository: <br>
<code>git clone https://github.com/zannn1019/BlogWebsite.git</code>
2. Navigate to the project directory: <br>
   <code>cd BlogWebsite</code><br>
3. Build and start the Docker containers:
   <code>docker-compose up --build</code><br>

### Without Docker
#### Frontend setup
1. Clone the repository: <br>
<code>git clone https://github.com/zannn1019/BlogWebsite.git</code>
2. Navigate to the project directory: <br>
   <code>cd BlogWebsite</code><br>
3. Navigate to the frontend directory: <br>
   <code>cd nuxtjs</code><br>
4. Install dependencies: <br>
   <code>npm install</code><br>
5. Start the frontend server: <br>
   <code>npm run dev</code>
6. Access the frontend: <br>
   Open your browser and go to `http://localhost:3000`.

### Backend Setup
1. Clone the repository: <br>
   <code>git clone https://github.com/zannn1019/BlogWebsite.git</code>
2. Navigate to the backend directory: <br>
   <code>cd ../backend</code> <br>
3. Install dependencies:
   composer install
4. Configure environment variables:
   - Create a `.env` file in the `laravel` directory.
   - Copy the contents of `.env.example` to `.env`.
   - Modify the database connection settings to match your PostgreSQL configuration.
5. Run database migrations:
   php artisan migrate
6. Start the backend server:
   php artisan serve --port=8000
7. Access the backend API:
    The backend API is accessible at `http://localhost:8000`.
   
## Features

- View list of blog posts and blog categories
- View details of a specific blog post
- Create a new blog post blog category
- Edit/Delete blog post and blog category

