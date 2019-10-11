<?php

namespace wpsk\tools\spec2code\parsers;

interface ConfigFileParserInterface {

    public function parse($filePath);

    public function getTargetDir();

    public function getNamespace();

    public function getCustomPostTypes();

    public function getTaxonomies();

}


