# **Team flow Application**

This application is designed for task management assigned to teams.

## Prerequisites
- PHP >= 8.1
- Composer
- Node.js
- NPM or Yarn
- MySQL or any other database supported by Laravel

## Installation
1. Clone the repository :
git clone https://github.com/FenoAndria/team-flow.git
cd team-flow

2. Install PHP dependencies :
composer install

3. Create '.env' file by copying '.env.example' and configure your environment variables :
cp .env.example .env
php artisan key:generate

4. Configure your database in the '.env' file and migrate the tables :
php artisan migrate
php artisan db:seed

5. Install Node.js dependencies :
npm install or yarn install

6. Start the development server :
php artisan serve (Laravel)
npm run dev (Vue.js)

## Usage
Access the application via `http://localhost:8000`

