# SOFTWARE DE ASISTENCIA PARA CONTROL DE CONDOMINIOS

NOTA: Las credenciales de la base de datos están en el archivo `Global.php` dentro del directorio `config`

## Inicialización del proyecto

1. Descargar Composer

```bash
sudo pacman -S composer
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
chmod 777 uploads
```

6. Tener instalado MySQL o MariaDB y activar la extensión en el `php.ini` y también habilitar PDO. Además, se debe cargar el SQL del proyecto en MySQL, el SQL está ubicado en `config/db.sql`.

7. Instalar la extensión `Imagick` e `ImagickPixel`

```bash
sudo pacman -S imagemagick php-imagick
```

- Habilitar la extensión en php.ini `extension=imagick`
- Si `Inteliphense` no detecta `Imagick`, se necesita activar en la configuración de este. Para `VSCode`: Archivo > Preferencias > Configuración > Busca `stubs` y aparecerá una lista en la que se muestran todas las extensiones de PHP, habilita `imagick`

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
