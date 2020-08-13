<?php

use Router\Router;

require 'vendor/autoload.php';

 $controllers = (new Router)->getControllerWithArgs();
   echo $controllers->getTwigEnvironment()->render(
       $controllers->getTemplatePath(),
       $controllers->getTemplateData()
   );
