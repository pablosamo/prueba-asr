## Instrucciones

- Clonar proyecto: git clone git@github.com:pablosamo/prueba-asr.git
- Cambiar a rama feature/PabloSamayoa
- Inicializar entorno docker: docker-compose up -d
- Copiar .env-example: cp .env
- Configurar variables de entorno para conexion a bd

	DB_HOST=mysql
	DB_DATABASE=pruebaasr
	DB_USERNAME=devpractice
	DB_PASSWORD=pesg12345

- Acceder a contenedor application: docker exec -it application bash
- Migrar base de datos: php artisan migrate
- Crear clientes passport: php artisan passport:install
- Configurar variables de entorno para usar tokens

	PASSPORT_CLIENT_ID=password_grant_client_id
	PASSPORT_CLIENT_SECRET=password_grant_client_secret

