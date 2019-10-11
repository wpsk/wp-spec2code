<?php


namespace wpsk\tools\spec2code\factories;

use wpsk\tools\spec2code\parsers\YamlConfigFileParser;

class ConfigFileParserFactory
{
    public function get_config_file_parser($filePath)
    {
        $fileExt = $this->getFileExt($filePath);
        if ($fileExt === 'yaml') {
            return new YamlConfigFileParser();
        }

        throw new \Exception('Unsupported config file format: ' . $fileExt);
    }


    private function getFileExt($filePath)
    {
        // TODO get file ext
        $fileExt = 'yaml';

        return $fileExt;
    }
}