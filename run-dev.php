<?php

$autoloader_file = implode(DIRECTORY_SEPARATOR, array(
    'vendor',
    'autoload.php'
));

require_once $autoloader_file;

//  TODO: add defaults for the spec file
//  TODO: accept command line argument
$runner = new \wpsk\tools\spec2code\RunnerWrapper();
$runner->run('spec.yaml');
