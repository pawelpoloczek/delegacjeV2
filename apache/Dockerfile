FROM php:7.2.1-apache
MAINTAINER Paweł Poloczek

# Copy virtual host configurations
COPY . /etc/apache2/sites-available/

# install php extensions
RUN apt-get update -y && apt-get install -y libpng-dev libfreetype6-dev libjpeg62-turbo-dev nano
RUN docker-php-ext-install zip pdo pdo_mysql mysqli
RUN docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/
RUN docker-php-ext-install -j$(nproc) gd

# install git for cloning by composer
RUN apt-get install -y git
RUN git config --global user.email "pawel@poloczek.me"
RUN git config --global user.name "Paweł Poloczek"

# install composer
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
RUN php -r "if (hash_file('SHA384', 'composer-setup.php') === '544e09ee996cdf60ece3804abc52599c22b1f40f4323403c44d44fdfdd586475ca9813a858088ffbc1f233e9b180f061') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
RUN php composer-setup.php --install-dir=/bin --filename=composer
RUN php -r "unlink('composer-setup.php');"

# Enable virtual hosts and restart apache
RUN a2ensite example.conf
RUN a2enmod rewrite
