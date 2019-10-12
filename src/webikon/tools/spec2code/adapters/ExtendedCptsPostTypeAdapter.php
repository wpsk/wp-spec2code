<?php


namespace webikon\tools\spec2code\adapters;

use Nette\PhpGenerator\GlobalFunction;
use Nette\PhpGenerator\PsrPrinter;

class ExtendedCptsPostTypeAdapter extends AbstractConfigurableAdapter implements PostTypeAdapterInterface
{
    public function generate_post_type_files()
    {
        $created_classes = array();

        $post_type_defs = $this->config->getCustomPostTypes();

        $printer = new PsrPrinter();
        foreach ($post_type_defs as $post_type_name => $post_type_def) {

            $className = $post_type_name;

            $file = new \Nette\PhpGenerator\PhpFile;
            $file->addComment('This file is auto-generated.');

            $namespaceString = $this->config->getNamespace() . '\Cpt';
            $namespace = $file->addNamespace($namespaceString);
            $class = $namespace->addClass($className);

            $method = $class->addMethod('init');
            $method->setStatic();
            $methodBody = 'register_extended_post_type(\'' . $post_type_name . '\');';
            $method->setBody($methodBody);

            $target_dir = $this->config->getTargetDir() . DIRECTORY_SEPARATOR . 'generated' . DIRECTORY_SEPARATOR . 'cpt' . DIRECTORY_SEPARATOR;
            @mkdir($target_dir, 0777, true);
            $target_file = $target_dir . $className . '.php';
            $file_content = $printer->printFile($file);

            file_put_contents($target_file, $file_content);

            array_push($created_classes, $namespaceString . "\\" . $className);

        }

        return $created_classes;

    }
}