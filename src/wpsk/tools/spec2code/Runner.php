<?php

namespace wpsk\tools\spec2code;

use Nadar\PhpComposerReader\Autoload;
use Nadar\PhpComposerReader\AutoloadSection;
use Nadar\PhpComposerReader\ComposerReader;
use Nette\PhpGenerator\PhpFile;
use Nette\PhpGenerator\PsrPrinter;
use wpsk\tools\spec2code\factories\CommonAdapterFactory;
use wpsk\tools\spec2code\factories\ConfigFileParserFactory;

class Runner
{

    private function createBootstrapClass($classList, $targetDir, $namespace)
    {
        $file = new PhpFile();
        $file->addComment('This file is auto-generated.');

        $namespace = $file->addNamespace($namespace);
        $class = $namespace->addClass('Bootstrap');
        $class->addMethod('inject')
            ->setStatic(true)
            ->setBody('add_action("init", array($fqClassName, "init"));')
            ->addParameter('fqClassName');

        $classes_init_code = '';
        foreach ($classList as $className) {
            $classes_init_code .= 'self::inject("' . $className . '");';
        }

        $class->addMethod('boot')
            ->setStatic(true)
            ->setBody($classes_init_code);

        $target_dir = $targetDir . DIRECTORY_SEPARATOR . 'generated' . DIRECTORY_SEPARATOR;
        @mkdir($target_dir, 0777, true);
        $target_file = $target_dir . 'Bootstrap.php';

        $printer = new PsrPrinter();
        $file_content = $printer->printFile($file);

        file_put_contents($target_file, $file_content);

    }

    public function run($config_file_path)
    {
        try {

            $config_factory = new ConfigFileParserFactory();
            $config_file_parser = $config_factory->get_config_file_parser($config_file_path);
            $config_file_parser->parse($config_file_path);

            $targetDir = $config_file_parser->getTargetDir();
            @mkdir($targetDir);

            $factory = CommonAdapterFactory::get_instance($config_file_parser);

            $generated_classes = array();

            //  TODO: create adapters and run the code generation
            $post_type_classes = $factory->get_post_types_adapter()->generate_post_type_files();
            $generated_classes = array_merge($generated_classes, $post_type_classes);

            //  generate composer.json
            $composerFile = $targetDir . DIRECTORY_SEPARATOR . 'composer.json';
            if (file_exists($composerFile)) {
                unlink($composerFile);
            }

            file_put_contents($composerFile, json_encode(array('license' => 'LGPL-2.1-only')));

            $reader = new ComposerReader($composerFile);

            // generate new autoload section object
            $new = new Autoload($reader, $config_file_parser->getNamespace() . '\\', 'generated', AutoloadSection::TYPE_PSR4);

            // store the new autoload object into the autoload section
            $section = new AutoloadSection($reader);
            $section->add($new)->save();

            $reader->runCommand('require johnbillion/extended-cpts');

            //  run composer install
            $reader->runCommand('install');

            //  create bootstrap class
            $this->createBootstrapClass($generated_classes, $targetDir, 'Todo');

        } catch (\Exception $e) {
            error_log($e->getMessage());
        }
    }
}