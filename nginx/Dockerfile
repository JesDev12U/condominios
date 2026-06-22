# Nginx Dockerfile para producción
FROM condominios-app AS app-image

FROM nginx:alpine
COPY nginx/default.conf /etc/nginx/conf.d/default.conf
COPY --from=app-image /var/www/html /var/www/html
