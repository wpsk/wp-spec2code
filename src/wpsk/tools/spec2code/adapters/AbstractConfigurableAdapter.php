<?php


namespace wpsk\tools\spec2code\adapters;

use wpsk\tools\spec2code\parsers\ConfigFileParserInterface;

abstract class AbstractConfigurableAdapter
{
    protected $config;

    public function __construct(ConfigFileParserInterface $config)
    {
        $this->config = $config;
    }
}