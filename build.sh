#!/bin/bash
if [ ! -f ./composer.phar ]; then
    php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
    php composer-setup.php
    php -r "unlink('composer-setup.php');"
fi
./composer.phar install

