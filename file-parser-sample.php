<?php

require_once 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';

$parseFile = new \wpsk\tools\spec2code\ConfigurableFileParser();
$parseFile->parse('spec.yaml');

var_dump($parseFile);