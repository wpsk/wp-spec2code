<?php

namespace wpsk\tools\spec2code;

use Nadar\PhpComposerReader\Autoload;
use Nadar\PhpComposerReader\AutoloadSection;
use Nadar\PhpComposerReader\ComposerReader;
use Nadar\PhpComposerReader\Package;
use Nadar\PhpComposerReader\RequireSection;
use wpsk\tools\spec2code\factories\CommonAdapterFactory;
use wpsk\tools\spec2code\factories\ConfigFileParserFactory;

class Runner
{
    public function run($config_file_path)
    {
        try {
            $config_factory = new ConfigFileParserFactory();
            $config_file_parser = $config_factory->get_config_file_parser($config_file_path);
            $config_file_parser->parse($config_file_path);

            $factory = CommonAdapterFactory::get_instance($config_file_parser);

            $targetDir = $config_file_parser->getTargetDir();
            @mkdir($targetDir);

            //  TODO: create adapters and run the code generation
            $factory->get_post_types_adapter()->generate_post_type_files();

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

        } catch (\Exception $e) {
            error_log($e->getMessage());
        }
    }
}