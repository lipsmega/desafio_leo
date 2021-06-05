<?php

//autoload
spl_autoload_register( function($class) {
    if (file_exists($class . '.php')) {
        require_once $class . '.php';
    }
});

$class = isset($_REQUEST['class']) ? $_REQUEST['class'] : 'CursoList';
$method = isset($_REQUEST['method']) ? $_REQUEST['method'] : null;

if (class_exists($class))
{
    $page = new $class( $_REQUEST );
    
    if (!empty($method) AND method_exists($class, $method))
    {
        $page->$method( $_REQUEST );
    }

    $html = $page->show();

    $layout = file_get_contents('template/layout.html');

    print $layout;
}
