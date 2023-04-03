## Step to show project

para inciar el projecto deberemos tener los siguente:
-Docker
-Subsistema de linux (solo si eres de windows o mac)
-cualquier editor de codigo

ahora para iniciar las imagenes de docker abrimos la terminal de linux(subsistema previamente instalado) y escribimos en la carpeta raiz
"sail up" y esperamos que cree las imagenes

luego verificamos que en docker tengamos las imagenes con el nombre del proyecto
si todo esta normal daremos en la misma terminal "sail artisan migrate" para que migre la base de datos a la cual vamos a conectarnos

y para finalizar podremos el siguiente comando en la carpeta raiz "npm run dev"
