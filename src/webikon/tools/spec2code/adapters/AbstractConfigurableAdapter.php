<?php


namespace webikon\tools\spec2code\adapters;

use webikon\tools\spec2code\parsers\ConfigFileParserInterface;

abstract class AbstractConfigurableAdapter
{
    protected $config;

    public function __construct(ConfigFileParserInterface $config)
    {
        $this->config = $config;
    }
}