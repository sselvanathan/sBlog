# This is the official Documentation of sBlog

## To get started please follow these steps.

1. Setting Up DB
___
  Adjust Database at :
    
     src\Database\Config\ExampleDatabaseConfig.php

 create a database called sblog using sql :
    
     `CREATE DATABASE sblog;	`
    
  to update the database run in Powershell :
 
     `vendor/bin/doctrine orm:schema-tool:update --force	`

