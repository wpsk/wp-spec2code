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

$runner = new \wpsk\tools\spec2code\RunnerWrapper();
$runner->run('spec.yaml');
