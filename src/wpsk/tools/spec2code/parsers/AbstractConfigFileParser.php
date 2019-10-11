<?php

namespace wpsk\tools\spec2code\parsers;

use wpsk\tools\spec2code\parsers\ConfigFileParserInterface;

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

    private function checkKey($key) {


        if( isset( $this->parsed_data[$key] ) && !empty( $this->parsed_data[$key] ) ) {

            return $this->parsed_data[$key];

        }

        return false;
    }

}
