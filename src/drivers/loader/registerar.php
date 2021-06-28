<?php

spl_autoload_register(function($className) {
    $classPath = str_replace("\\", "/", $className);
    require_once PROJECT_DIR.$classPath.".php";
});