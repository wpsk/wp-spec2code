<?php

require_once 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';

$parseFile = new \wpsk\tools\spec2code\parsers\YamlConfigFileParser();
$parseFile->parse('spec.yaml');
$parseFile->getCustomPostTypes();