<?php


namespace webikon\tools\spec2code;

/**
 * Wrapper class that prepares composer defined dependencies. Notice that it does not use any of the classes defined
 * in the dependencies.
 *
 */
class RunnerWrapper
{
    public function run($config_file_path)
    {
        //  try to load the autoloader file
        $autloloader_file = implode(DIRECTORY_SEPARATOR, array(
            getcwd(),
            'vendor',
            'autoload.php'
        ));

        if (!file_exists($autloloader_file)) {
            throw new \Exception('Main autoloader file does not exist: ' . $autloloader_file);
        }
        require_once $autloloader_file;

        //  run the actual runner that uses installed dependencies
        $runner = new Runner();
        $runner->run($config_file_path);
    }
}