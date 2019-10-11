# wp-spec2code

Tool for generating common WordPress code from structured spec file.

## Why should I use it?

Why not? DRY - Don't repeat yourself

## Minimum requirements
Requirements are defined by the requirements of default adapters.

- PHP 7.0
- WordPress 4.8
- [Composer](https://getcomposer.org/download/)

Do you need to work with earlier versions of PHP or WordPress? It is possible to implement adapters with lower requirements.

## How does it work?
- add wp-spec2code as a composer dependency
- create spec file
- run wp s2c gen
- include s2c/autoload.php
- init by Bootstrap::boot()
- carry on with the rest of your project

## Configuration file

- target folder (default s2c)
- namespace (default none)
- I18N domain (default wordpress)
- post types - https://codex.wordpress.org/Function_Reference/register_post_type
- taxonomies - https://codex.wordpress.org/Function_Reference/register_taxonomy
- post meta fields
- taxonomy meta fields

## Supported libraries (drivers)

- native WordPress, ACF, metaxbox.io...

## Plan for Contributor Day on WordCamp 2019 Bratislava (11.10.2019)

- Create WP CLI command to trigger the (re-)generation of code
- Review sample config file + document it (perhaps using something like [JSON schema](https://json-schema.org) or https://blog.picnic.nl/how-to-use-yaml-schema-to-validate-your-yaml-files-c82c049c2097)
- CPT code generation
- CT code generation
- Simple text metabox generation
- Deploy to packagist

### Config file reading

- https://github.com/awurth/PHP-Config (PHP, JSON, YAML)
- https://symfony.com/doc/current/components/yaml.html (YAML only)

### Code generation from templates

- https://github.com/nette/php-generator
- http://memio.github.io/memio/
- code generator used by https://github.com/phpro/soap-client

### Autoloader wiring 

### Actions and filters

## Future Improvements
- create config file from existing WordPress installation
- allow adapters to register themselves with factories
