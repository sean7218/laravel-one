FROM ubuntu:17.10

# Install basic tools
RUN apt-get update && apt-get -y upgrade && \
    apt-get install -y apt-utils curl vim nginx ufw \
    systemd git

# Install php
RUN apt-get install -y php-fpm php-common php-mbstring php-xmlrpc php-soap \ 
                       php-gd php-xml php-intl php-mysqlnd php-cli \
                       php-mcrypt php-ldap php-zip php-curl

# Install laravel
RUN curl -sS https://getcomposer.org/installer | php && \
    mv composer.phar /usr/loca/bin/composer && \
    chmod +x /usr/loca/bin/composer && \
    mkdir /var/www/html/mysite && \
    cd /var/www/html/mysite && \
    git clone https://github.com/laravel/laravel.git && \
    mv laravel/* . && rmdir laravel && composer install && \

