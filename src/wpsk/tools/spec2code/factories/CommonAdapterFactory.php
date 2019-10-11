<?php


namespace wpsk\tools\spec2code\factories;


use wpsk\tools\spec2code\adapters\ExtendedCptsAdapter;
use wpsk\tools\spec2code\ConfigFileParserInterface;

class CommonAdapterFactory implements AdapterFactoryInterface
{
    static $instance;

    private $config;

    public function __construct(ConfigFileParserInterface $configFileParser)
    {
        $this->config = $configFileParser;
    }

    public static function get_instance(ConfigFileParserInterface $configFileParser)
    {
        if (self::$instance === null) {
            self::$instance = new CommonAdapterFactory($configFileParser);
        }

        return self::$instance;
    }

    public function get_post_types_adapter()
    {
        // TODO: create adapter based on the adapters defined in the config
        return new ExtendedCptsAdapter($this->config);
    }

    public function get_post_meta_fields_adapter()
    {
        // TODO: create adapter based on the adapters defined in the config
        return new ExtendedCptsAdapter($this->config);
    }

    public function get_tax_meta_fields_adapter()
    {
        // TODO: Implement get_tax_meta_fields_adapter() method.
    }
}