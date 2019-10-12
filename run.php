<?php

$runner_path = implode(DIRECTORY_SEPARATOR, array(
    'vendor',
    'webikon',
    'wp-spec2code',
    'src',
    'wpsk',
    'tools',
    'spec2code',
    'RunnerWrapper.php'
));

require_once $runner_path;

//  TODO: add defaults for the spec file
//  TODO: accept command line argument
$runner = new \wpsk\tools\spec2code\RunnerWrapper();
$runner->run('spec.yaml');
