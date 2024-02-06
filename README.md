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


   
## Features

- View list of blog posts and blog categories
- View details of a specific blog post
- Create a new blog post blog category
- Edit/Delete blog post and blog category

