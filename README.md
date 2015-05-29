# DDD Symfony 
> Other approach about the implementation of DDD into Symfony application

[![Build Status](https://travis-ci.org/benatespina/ddd-symfony.svg?branch=master)](https://travis-ci.org/benatespina/ddd-symfony)
[![Total Downloads](https://poser.pugx.org/benatespina/ddd-symfony/downloads)](https://packagist.org/packages/benatespina/ddd-symfony)
[![Latest Stable Version](https://poser.pugx.org/benatespina/ddd-symfony/v/stable.svg)](https://packagist.org/packages/benatespina/ddd-symfony)
[![Latest Unstable Version](https://poser.pugx.org/benatespina/ddd-symfony/v/unstable.svg)](https://packagist.org/packages/benatespina/ddd-symfony)

Why?
-------------
There are quite a few libraries/projects/bundles in Github that implement DDD into Symfony ecosystem, but I'm not
convinced the file/directory structure that they follow. In this repository, I try to expose my own implementation
of Domain Driven Development into a Symfony application.

Furthermore, I would like that this repository becomes to the Symfony scaffold for my future projects with this
framework, so improvements are welcome! :)

Getting Started
---------------
This repository is a **Symfony** application so, to run requires *[PHP][5]*, *[Composer][6]*
and any database that project will be support (for the moment *[MySQL][7]*).
> NOTE: **parameters.yml**'s `database_user` and `database_password` must have the same values that MySQL
> configuration.

Install the project's dependencies:
```
$ composer install
```
Configure the web server to serve the `/web` directory of this project.
> Kreta needs PHP 5.4 or higher to run so, you don't need to configure the web server for this project,
> because you can use the Symfony command:
>
> ```
> $ php app/console server:run
> ```
>
> And that's all! Now, if you request `http://127.0.0.1:8000/`, you will see your site up and running.

Tests
-----
This project is completely tested by **BDD methodology** with [PHPSpec][1]:

    $ bin/phpspec run -fpretty

Contributing
------------
This project follows some standards. If you want to collaborate, please ensure that your code fulfills these
standards before any Pull Request.

    $ bin/php-cs-fixer fix .
    $ bin/php-cs-fixer fix . --config-file .phpspec_cs --fixers=-visibility

There is also a policy for contributing to this project. Pull requests must
be explained step by step to make the review process easy in order to
accept and merge them. New methods or code improvements must come paired with [PHPSpec][1] tests.

If you would like to contribute it is a good point to follow Symfony contribution standards,
so please read the [Contributing Code][2] in the project
documentation. If you are submitting a pull request, please follow the guidelines
in the [Submitting a Patch][3] section and use the [Pull Request Template][4].


Credits
-------
Based on:
- beberlei's [Symfony Minimal Distribution](https://github.com/beberlei/symfony-minimal-distribution)
- dddinphp's [Last Whishes](https://github.com/dddinphp/last-wishes)
- dddinphp's [Repository Examples](https://github.com/dddinphp/repository-examples)

Created by **benatespina** - [benatespina@gmail.com](mailto:benatespina@gmail.com).
Copyright (c) 2015

[![License](https://poser.pugx.org/benatespina/ddd-symfony/license.svg)](https://github.com/benatespina/ddd-symfony/blob/master/LICENSE)

[1]: http://www.phpspec.net/
[2]: http://symfony.com/doc/current/contributing/code/index.html
[3]: http://symfony.com/doc/current/contributing/code/patches.html#check-list
[4]: http://symfony.com/doc/current/contributing/code/patches.html#make-a-pull-request
[5]: http://php.net
[6]: http://getcomposer.org/download
[7]: http://dev.mysql.com/downloads/
