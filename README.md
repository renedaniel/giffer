# Giffer

Giffer es una aplicación Web que permite a los usuarios subir imágenes en formato Gif para poderlas compartir con sus compas.

[DEMO](http://prauprau.net/giffer) - Prueba la aplicación en linea

## Sobre el desarrollo de la aplicación

La aplicación se encuentra desarrollada utilizando las siguientes librerías: 
•	Framework CakePHP 2.9 
•	Materializecss
•	lightbox
•	datatables
•	jQuery 2.2.4

## Requerimientos

Los requerimientos mínimos del sistema son:
•	Servidor HTTP Apache
•	PHP 5.5+
•	Base de datos MySQL 4+

## Proceso de instalación

## Base de datos

La carpeta que contiene el proyecto, que a partir de ahora será referida como [src], incluye un archivo llamado giffer.sql, el cual incluye un script SQL que tiene la información necesaria para que la aplicación Giffer funcione, además, incluye datos iniciales de prueba, así como un usuario administrador que es el encargado de aprobar o rechazar las imágenes enviadas a la aplicación. Dicho script incluye una sentencia para crear una base de datos nueva llamada giffer. 
La base de datos debe estar codificada en utf8. 

El usuario administrador tiene los siguientes datos de acceso:

•	Correo electrónico: admin@gmail.com

•	Contraseña: hola123.

## Archivos del sitio Web

Es necesario agregar el contenido de la aplicación al htdocs configurado en el servidor Apache.

Posteriormente, deberá cambiar la configuración de la base de datos, para realizarlo se tiene que editar el archivo:

•	htdocs/giffer/app/Config/database.php

y modificar las líneas: 

     'host' => 'nombre de host', (usualmente localhost)
                'login' => 'nombre de usuario de mysql',
                'password' => 'contraseña de usuario de mysql',
                'database' => 'nombre de la base de datos', (giffer)

Para finalizar la instalación, debido a que la aplicación necesita leer y escribir ciertos archivos para poder trabajar, será necesario otorgar permisos de escritura a los siguientes directorios:

•	htdocs /giffer/app/tmp
•	htdocs/giffer/app/webroot/img/gifs

Lo anterior, puede ser asignado utilizando los siguientes comandos en ambientes UNIX:

•	sudo chmod -R 760 htdocs /giffer/app/tmp
•	sudo chmod -R 760 htdocs/giffer/app/webroot/img/gifs