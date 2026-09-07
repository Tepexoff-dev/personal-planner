FROM node:22-alpine

WORKDIR /var/www/html

COPY package*.json ./

RUN npm ci

CMD ["npm", "run", "dev", "--", "--host", "0.0.0.0"]
