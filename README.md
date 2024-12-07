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
