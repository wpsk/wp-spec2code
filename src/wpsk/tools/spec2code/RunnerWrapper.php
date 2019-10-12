<?php


namespace wpsk\tools\spec2code;

/**
 * Wrapper class that prepares composer defined dependencies. Notice that it does not use any of the classes defined
 * in the dependencies.
 *
 */
class RunnerWrapper
{
    /**
     * This may run in two ways:
     * - in the s2c project itself (doesn't require to run composer installer in subfolder)
     * - as a library (requires to run composer installer in subfolder)
     * @return string
     */
    private function maybeInstallComposerDependencies()
    {
        $s2c_deps_subfolder = implode(DIRECTORY_SEPARATOR, array(
            'vendor',
            'webikon',
            'wp-spec2code'
        ));

        $autoloader_parts = array(getcwd());

        if (file_exists($s2c_deps_subfolder)) {
            //  install composer dependencies
            //  composer won't do this for you
            //  https://getcomposer.org/doc/faqs/why-can%27t-composer-load-repositories-recursively.md
            exec('cd ' . $s2c_deps_subfolder . ' && composer install');
            array_push($autoloader_parts, $s2c_deps_subfolder);
        }

        array_push($autoloader_parts, 'vendor');
        array_push($autoloader_parts, 'autoload.php');

        //  try to load the autoloader file created by composer in our package
        $autloloader_file = implode(DIRECTORY_SEPARATOR, $autoloader_parts);
        return $autloloader_file;
    }

    public function run($config_file_path)
    {
        $autloloader_file = $this->maybeInstallComposerDependencies();
        if (!file_exists($autloloader_file)) {
            throw new \Exception('Main autoloader file does not exist');
        }

        require_once $autloloader_file;

        //  run the actual runner that uses installed dependencies
        $runner = new Runner();
        $runner->run($config_file_path);
    }
}