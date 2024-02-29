FROM node:20

WORKDIR /var/www/html/nuxt-app

COPY package*.json ./

COPY . .

RUN npm install

EXPOSE 3000

CMD ["npm","run", "dev"]