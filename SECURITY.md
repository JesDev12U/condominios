# Configuración de Variables de Entorno

## Configuración Inicial

Este proyecto utiliza variables de entorno para mantener las credenciales seguras y fuera del control de versiones.

### Pasos para Configurar:

1. **Copia el archivo de ejemplo:**
   ```bash
   cp .env.example .env
   ```

2. **Edita el archivo `.env` con tus credenciales reales:**
   ```bash
   nano .env
   ```

3. **Configura las siguientes variables:**
   - `DB_HOST`: Host de la base de datos (por defecto: `db` para Docker)
   - `DB_BASE`: Nombre de la base de datos
   - `DB_USR`: Usuario de la base de datos
   - `DB_PASS`: **Contraseña segura de la base de datos**
   - `EMAIL_USR`: Email para el sistema de recuperación de contraseñas
   - `EMAIL_PASS`: **Contraseña de aplicación de Gmail** (genera una en tu cuenta de Google)
   - `ENCRYPTION_KEY`: **Clave de encriptación segura** para AES-256-CBC (mínimo 16 caracteres aleatorios)
   - `SITE_URL`: (Opcional) URL del sitio

### Seguridad

⚠️ **IMPORTANTE:**
- El archivo `.env` está incluido en `.gitignore` y **NUNCA** debe subirse al repositorio
- Usa contraseñas fuertes y únicas para producción
- Para email de Gmail, genera una contraseña de aplicación en: https://myaccount.google.com/apppasswords
- Cambia todas las credenciales por defecto antes de desplegar en producción

### Despliegue con Docker

Una vez configurado el archivo `.env`, ejecuta:

```bash
docker-compose up -d
```

Docker Compose cargará automáticamente las variables del archivo `.env`.

### Generar una Clave de Encriptación Segura

Puedes generar una clave de encriptación segura usando OpenSSL:

```bash
openssl rand -base64 32
```

O en PHP:
```php
echo bin2hex(random_bytes(16));
```

### Notas Adicionales

- Asegúrate de que el archivo `.env` tenga permisos restrictivos: `chmod 600 .env`
- **NUNCA** compartas la `ENCRYPTION_KEY` en producción - los datos cifrados no podrán descifrarse si cambias la clave
- Mantén un respaldo seguro de la `ENCRYPTION_KEY` de producción
