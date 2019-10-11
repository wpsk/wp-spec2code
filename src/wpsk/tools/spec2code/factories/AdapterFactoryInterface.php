<?php

namespace wpsk\tools\spec2code\factories;

use wpsk\tools\spec2code\parsers\ConfigFileParserInterface;

interface AdapterFactoryInterface
{
    public static function get_instance(ConfigFileParserInterface $config);

    public function get_post_types_adapter();

    public function get_post_meta_fields_adapter();

    public function get_tax_meta_fields_adapter();
}