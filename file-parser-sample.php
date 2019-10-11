<?php

require_once 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';

$runner = new \wpsk\tools\spec2code\Runner();
$runner->run('spec.yaml');

// $parseFile->getCustomPostTypes();