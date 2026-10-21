PHP 8.4 MySQL 8.4

Steps to start the project:

Clone the project to yourself  
Copy .env.example to .env  
Open a terminal in the project's root directory
Start docker if you didn't it before  
Enter the commands in the terminal: 
1) docker compose up --build  
2) docker compose exec app php app/Database/migrate.php
3) docker compose exec manticore indexer countries --rotate  
4) docker compose restart manticore  
The app will be available at http://localhost:8000