<?php

require_once 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';

$parseFile = new \wpsk\tools\spec2code\YamlConfigFileParser();
$parseFile->parse('spec.yaml');

var_dump($parseFile);