# Condominios
*Software de asistencia para control de condóminos en un Condominio* <br />
<p>
   <img src="https://github.com/user-attachments/assets/b6d595f8-f694-4980-b444-508a3ba062ce" width="200" height="200" />
   <!-- HTML -->
   <a href="https://www.w3.org/html/" target="_blank" rel="noreferrer"><img src="https://raw.githubusercontent.com/devicons/devicon/master/icons/html5/html5-original-wordmark.svg" alt="html5" width="90" height="90" title="HTML" /></a> 
  <!-- CSS -->
  <a href="https://www.w3schools.com/css/" target="_blank" rel="noreferrer"><img src="https://raw.githubusercontent.com/devicons/devicon/master/icons/css3/css3-original-wordmark.svg" alt="css3" width="90" height="90" title="CSS"/></a> 
  <!--JavaScript-->
  <a href="https://developer.mozilla.org/en-US/docs/Web/JavaScript" target="_blank" rel="noreferrer"> <img src="https://raw.githubusercontent.com/devicons/devicon/master/icons/javascript/javascript-original.svg" alt="javascript" width="90" height="90" title="JavaScript" /></a>
   <!--PHP-->
  <a href="https://www.php.net" target="_blank" rel="noreferrer"><img src="https://raw.githubusercontent.com/devicons/devicon/master/icons/php/php-original.svg" alt="php" width="90" height="90" title="PHP"/></a>
</p>

## 🔧 Fixes
- [2025-06-25] Se sustituyó la librería tFPDF por TCPDF para evitar el uso de Imagick ya que este a veces genera errores al momento de convertir las imágenes.

## 🌟 Upgrades
- [2025-06-25] Se implementó una API (Ajax) para el acceso por NFC (en un futuro pienso implementar una gestión correcta del NFC para los usuarios).

## NOTAS

1. Las credenciales de la base de datos están en el archivo `Global.php` dentro del directorio `config`.

2. PHPMailer está configurado con mi correo electrónico, la contraseña no es la de mi cuenta, sino una generada por Google para aplicaciones que no requieren verificación de 2 pasos [Para más detalle, ve este video de YouTube](https://www.youtube.com/watch?v=cygY1sCjLxA)
   Si deseas poner tu correo electrónico, configura tu cuenta de Google y coloca tu email y password en las variables globales `EMAIL` y `PASSWORD_EMAIL` en `config/Global.php`.

## Inicialización del proyecto

1. Descargar Composer

```bash
sudo pacman -Syu composer
```

[Para otros sistemas operativos, click aquí](https://getcomposer.org/download/)

2. Instalar las dependencias

```bash
composer install
```

3. Instalar NodeJS junto con NPM con ayuda de NVM (Node Version Manager):

- [Linux](https://github.com/nvm-sh/nvm)
- [Windows](https://github.com/coreybutler/nvm-windows)

4. Instalar las librerías necesarias

```bash
npm install
```

5. Dar permisos de escritura al directorio `uploads/`

```bash
chmod 777 -R uploads
```

6. Tener instalado MySQL o MariaDB y activar la extensión en el `php.ini` y también habilitar PDO. Además, se debe cargar el SQL del proyecto en MySQL, el SQL está ubicado en `config/db.sql`.

## Configuración para IIS

Debido a la configuración de las rutas, es necesario añadir el directorio virtual del proyecto, para que así tengamos la siguiente URL: `http://localhost/condominios`, por lo que al alias del directorio es indispensable colocarlo como `condominios`. De igual forma, si se llega a cambiar el nombre al directorio, solo basta cambiar también el nombre en la variable `$baseURL` en `Model.php` y cambiar el directorio en la siguiente línea del `.htaccess`

```.htaccess
RewriteCond %{REQUEST_URI} ^/<DIRECTORIO>/(css|js|img|fonts|_model)/ [NC]
```

También habrá un problema al momento de navegar por la página, esto se debe por el archivo `.htaccess`, IIS no sabe cómo interpretar ese archivo ya que es exclusivo para servidores Apache, por lo que para poder hacer que IIS lo entienda tenemos que hacer lo siguiente:

1. Descargar `URL Rewrite Module 2.1`, que se puede encontrar en el siguiente enlace: [URL Rewrite Module 2.1](https://www.iis.net/downloads/microsoft/url-rewrite) Hasta abajo de la página estarán los links de los instaladores, selecciona el instalador de acuerdo a tu idioma y a tu arquitectura.

2. Una vez descargado, abre el instalador e instala el mod.

3. Abre IIS

4. Selecciona el directorio virtual del proyecto y dale doble click a "Reescritura de dirección URL"

5. En el segundo cuadro, da click derecho > Reglas de entrada > Importar reglas...

6. En "Archivo de configuración", seleccionamos el archivo `.htaccess` y le damos click a "Importar"

7. Una vez cargadas las reglas convertidas, damos click en "Aplicar"

Con esto hecho, la página ya podrá entender las rutas amigables, por ejemplo `http://localhost/condominios/login`

Ahora, habrá un problema al momento de cargar el directorio, y es que nos mostrará una vista en la que tenemos que seleccionar el archivo a abrir, para solucionar eso, tenemos que hacer lo siguiente:

1. Abrimos IIS

2. Seleccionamos nuestro directorio virtual del proyecto y en las opciones de la página principal, damos doble click a la opción "Documento predeterminado"

3. Damos click en "Agregar..." y le ponemos el nombre `index.php`

4. Damos click en Aceptar

Con todo lo anterior, ya no tendría que haber problema con el proyecto
