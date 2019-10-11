<?php

namespace wpsk\tools\spec2code;

use Symfony\Component\Yaml\Yaml;

class ConfigurableFileParser implements FileParserInterface {

    function __construct() {
       
    }


    public function parse($filePath) {

        $fileExt = $this->getFileExt($filePath);

        if( $fileExt === 'yaml') {

            return $this->parseYaml($filePath);
        }

        return $parsedFile;
    }


    public function getCustomPostTypes() {
        return $customPostTypes;
    }

    public function getTaxonomies() {
        return $taxonomies;
    }

    private function parseYaml($filePath) {
        
        $parsedFile = Yaml::parseFile($filePath);

        var_dump($parsedFile);

        if( is_array($parsedFile) ) {
            return false;
        }

        return true;
    }


    private function getFileExt($filePath) {

        // get file ext
        $fileExt = 'yaml';

        return $fileExt;
    }
}


