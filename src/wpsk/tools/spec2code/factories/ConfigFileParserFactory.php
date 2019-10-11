<?php


namespace wpsk\tools\spec2code\factories;

use wpsk\tools\spec2code\parsers\ConfigFileParserInterface;
use wpsk\tools\spec2code\parsers\YamlConfigFileParser;

class ConfigFileParserFactory
{
    public function get_config_file_parser($filePath): ConfigFileParserInterface
    {
        $fileExt = $this->getFileExt($filePath);

        if ($fileExt === 'yaml') {

            return new YamlConfigFileParser();

        }

        throw new \Exception('Unsupported config file format: ' . $fileExt);
    }


    private function getFileExt($path)
    {
        if (!file_exists($path)) {
            throw new \Exception('Configuration file: $path cannot be found');
        }
        
        $info = pathinfo($path);
        $parts = explode('.', $info['basename']);
        $extension = array_pop($parts);

        return $extension;
    }
}