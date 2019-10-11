<?php

namespace wpsk\tools\spec2code\parsers;

use wpsk\tools\spec2code\ConfigFileParserInterface;

abstract class AbstractConfigFileParser implements ConfigFileParserInterface
{
    protected $parsed_data;

    public function getCustomPostTypes()
    {
        // TODO: Implement getCustomPostTypes() method.
    }

    public function getTaxonomies()
    {
        // TODO: Implement getTaxonomies() method.
    }

}
