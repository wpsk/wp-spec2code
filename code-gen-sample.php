<?php

require_once 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';

$file = new Nette\PhpGenerator\PhpFile;
$file->addComment('This file is auto-generated.');

$namespace = $file->addNamespace('Foo');
$class = $namespace->addClass('A');
$class->addMethod('hello');

@mkdir('temp');
file_put_contents('temp' . DIRECTORY_SEPARATOR . 'A.php', (new Nette\PhpGenerator\PsrPrinter)->printFile($file));
