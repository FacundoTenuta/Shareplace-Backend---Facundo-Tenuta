# SharePlace - BackEnd
# Install BackEnd

λ git clone https://gitlab.com/facuargush/shareplace-backend.git

λ cd shareplace-backend

λ composer install

levantar el servidor mysql y crear una base de datos con el nombre "shareplace-backend"

λ cp .env.example .env

nombrar la base de datos en la linea 12 como "shareplace-backend"

λ php artisan key:generate

λ php artisan jwt:secret

// de ser necesario actualizar dependencias
// λ composer update

λ php artisan migrate

λ php artisan db:seed

probar consultas con postman o programa similar

disfrutar del proyecto en desarrollo


