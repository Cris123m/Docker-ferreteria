#Versión de php a usar /incluido apache
FROM php:7-apache
# Arguments defined in docker-compose.yml
ARG user
ARG uid

# Create system user to run Composer and Artisan Commands
RUN useradd -G www-data,root -u $uid -d /home/$user $user
#RUN chown -R $user:www-data /var/www/html
RUN chgrp -R www-data /var/www/html
RUN usermod -a -G www-data $user
RUN chmod -R 775 /var/www/html
RUN chmod -R g+s /var/www/html
RUN chown -R $user /var/www/html

#Instalar extensión de componente php mysqli
#RUN docker-php-ext-install mysqli
RUN docker-php-ext-install mysqli pdo pdo_mysql
#Directorio de trabajo
WORKDIR /var/www/html
#Copiar directorio actual /Descomentar si usa como contenedor individual
#COPY . .