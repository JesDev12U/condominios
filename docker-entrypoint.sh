#!/bin/sh
set -e

# Asegurar que las carpetas de uploads existan
mkdir -p /var/www/html/uploads/fotos_users /var/www/html/uploads/fotos_eventos

# Ajustar permisos para que Apache (www-data) pueda escribir
# independientemente de quién sea el dueño en el host
chown -R www-data:www-data /var/www/html/uploads
chmod -R 775 /var/www/html/uploads

# Ejecutar el comando principal del contenedor (en este caso apache2-foreground)
exec "$@"
