<?php


namespace wpsk\tools\spec2code;

/**
 * Wrapper class that prepares composer defined dependencies. Notice that it does not use any of the classes defined
 * in the dependencies.
 *
 */
class RunnerWrapper
{
    public function run($config_file_path)
    {
        //  install composer dependencies
        //  composer won't do this for you
        //  https://getcomposer.org/doc/faqs/why-can%27t-composer-load-repositories-recursively.md
        $s2c_deps_subfolder = implode(DIRECTORY_SEPARATOR, array(
            'vendor',
            'webikon',
            'wp-spec2code'
        ));
        exec('cd ' . $s2c_deps_subfolder . ' && composer install');

        //  try to load the autoloader file create by composer in our package
        $autloloader_file = implode(DIRECTORY_SEPARATOR, array(
            getcwd(),
            $s2c_deps_subfolder,
            'vendor',
            'autoload.php'
        ));

        if (!file_exists($autloloader_file)) {
            throw new \Exception('Main autoloader file does not exist');
        }

        require_once $autloloader_file;

        //  run the actual runner that uses installed dependencies
        $runner = new Runner();
        $runner->run($config_file_path);
    }
}