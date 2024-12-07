# SOFTWARE DE ASISTENCIA PARA CONTROL DE CONDOMINIOS

## Inicialización del proyecto

1. Descargar Composer
2. Instalar las dependencias

```bash
composer install
```

NOTA: Si hay problemas con composer, se deja la carpeta vendor para así evitar la necesidad de instalar composer

## Configuración del archivo .env

1. Crea un archivo `.env` en `config/`

```bash
touch config/.env
```

2. La estructura del archivo `.env` es la siguiente:

```env
DB_SERVER=<SERVIDOR DE LA BASE DE DATOS, EJ. 127.0.0.1>
DB_USER=<USUARIO>
DB_PASS=<CONTRASEÑA>
DB_NAME=<NOMBRE DE LA BASE DE DATOS>
```

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
