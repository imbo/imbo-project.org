imbo-project.org
================

This repository holds the [imbo-project.org](http://imbo-project.org) site.

If you want to get this site up and running, run the following commands:

    git clone https://github.com/imbo/imbo-project.org
    cd imbo-project.org
    git checkout develop
    git submodule init
    git submodule update
    curl https://getcomposer.org/installer | php
    php composer.phar install

Then you need to set up a virtual host with the document root pointing to the `public` directory within the imbo-project.org directory. You will also need to provide some configuration parameters. Create a `config/autoload/local.php` and provide the values missing from `config/autoload/global.php`.
