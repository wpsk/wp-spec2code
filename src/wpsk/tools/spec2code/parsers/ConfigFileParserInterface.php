<?php

namespace wpsk\tools\spec2code\parsers;

interface ConfigFileParserInterface {

    public function parse($file_path);

    public function getCustomPostTypes();

    public function getTaxonomies();

}


