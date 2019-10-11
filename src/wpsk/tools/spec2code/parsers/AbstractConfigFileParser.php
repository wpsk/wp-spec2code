<?php

namespace wpsk\tools\spec2code\parsers;

abstract class AbstractConfigFileParser implements ConfigFileParserInterface
{
    protected $parsed_data;

    public function getCustomPostTypes()
    {

        $key = 'post_types';

        $data = $this->checkKey($key); 

        return $data;
    }

    public function getTaxonomies()
    {
        $key = 'taxonomies';
        
        $data = $this->checkKey($key); 

        return $data;
    }

    public function getNamespace()
    {
        return $this->checkKey('namespace');
    }

    public function getTargetDir()
    {
        return $this->checkKey('target_dir');
    }

    private function checkKey($key) {

        if( isset( $this->parsed_data[$key] ) && !empty( $this->parsed_data[$key] ) ) {

            return $this->parsed_data[$key];

        }

        return false;
    }

}
