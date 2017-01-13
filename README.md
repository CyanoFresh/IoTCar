Yii2 EDBU Template
============================

This is my template for quick project development. Yii2 Basic template + environments + Users in DB + Refactor
EDBU = Environments DataBase Users

DIRECTORY STRUCTURE
-------------------

      assets/             contains assets definition
      commands/           contains console commands (controllers)
      config/             contains application configurations
      controllers/        contains Web controller classes
      mail/               contains view files for e-mails
      models/             contains model classes
      runtime/            contains files generated during runtime
      vendor/             contains dependent 3rd-party packages
      views/              contains view files for the Web application
      web/                contains the entry script and Web resources


INSTALLATION
------------

Get project files:

~~~
git clone https://github.com/CyanoFresh/yii2-edbu-template PROJECTNAME
cd PROJECTNAME
composer install
~~~

If installation has not started, run init command manually:

~~~
php init
~~~

Configure DataBase in config/db-local.php and run:

~~~
php yii migrate
~~~

To create admin account use:

~~~
php yii user/register USERNAME PASSWORD EMAIL
~~~

Also check files in `config` folder for more customization
