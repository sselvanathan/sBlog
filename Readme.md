# This is the official Documentation of sBlog

## To get started please follow these steps.

1. Setting Up Redirection
___
    rename .htaccessExample to .htaccess and move it one directory up

2. Setting Up DB
___
  Adjust Database at :
    
     src\Database\Config\ExampleDatabaseConfig.php

 create a database called sblog using sql :
    
     `CREATE DATABASE sblog;`
    
  to update the database run in terminal :
 
     `vendor/bin/doctrine orm:schema-tool:update --force`

## Tech Stack

-> PHP 7.4
-> Doctrine 2.7.4
-> Twig v3.1.1
-> Dart Sass 1.27
-> Font Awesome 5.14.0