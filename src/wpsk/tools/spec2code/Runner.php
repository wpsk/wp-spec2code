<?php

namespace wpsk\tools\spec2code;

use wpsk\tools\spec2code\factories\CommonAdapterFactory;
use wpsk\tools\spec2code\factories\ConfigFileParserFactory;

class Runner
{
    public function run($config_file_path)
    {
        try {
            $config_factory = new ConfigFileParserFactory();
            $config_file_parser = $config_factory->get_config_file_parser($config_file_path);

            $factory = CommonAdapterFactory::get_instance($config_file_parser);

            //  TODO: create adapters and run the code generation

        } catch (\Exception $e) {
            //  TODO show error in red
        }
    }
}