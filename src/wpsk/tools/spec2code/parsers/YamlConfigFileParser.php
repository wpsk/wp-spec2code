<?php

namespace wpsk\tools\spec2code;

use Symfony\Component\Yaml\Yaml;
use wpsk\tools\spec2code\parsers\AbstractConfigFileParser;

class YamlConfigFileParser extends AbstractConfigFileParser
{
    public function parse($filePath) {

        $parsedFile = Yaml::parseFile($filePath);
        if (!is_array($parsedFile)) {
            return false;
        }

        $this->parsed_data = $parsedFile;
        return true;
    }

}

