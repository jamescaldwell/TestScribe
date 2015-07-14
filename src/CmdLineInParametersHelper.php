<?php

namespace Box\TestScribe;

/**
 * @package Box\TestScribe
 *
 * Responsible for processing input command line parameters.
 */
class CmdLineInParametersHelper
{
    /**
     * @param string $inClassName
     *      Either a simple class name or a fully qualified class name
     * @param string $inSourceFile
     *
     * @return string   Source file path
     * @throws \RuntimeException
     */
    public function initInClassAndSourceFile(
        $inClassName,
        $inSourceFile
    )
    {
        if (class_exists($inClassName)) {
            // The class is already loaded.
            // Overwrite the input source file parameter if any.
            $inSourceFile = $this->getSourceFileNamefromLoadedClass($inClassName);
        } else {
            $inSourceFile = $this->loadInputClass($inClassName, $inSourceFile);
        }

        return $inSourceFile;
    }

    /**
     * Load the class under test.
     *
     * @param string $inClassName
     * @param string $inSourceFile
     *
     * @return string   The normalized input source file path
     * @throws \RuntimeException
     */
    private function loadInputClass(
        $inClassName,
        $inSourceFile
    )
    {
        if (empty($inSourceFile)) {
            $inSourceFile = $this->inferSourceFileNameFromClassName($inClassName);
        } else {
            if (!is_file($inSourceFile)) {
                throw new \RuntimeException(
                    sprintf(
                        'Input source file "%s" could not be opened.',
                        $inSourceFile
                    )
                );
            }
        }
        $inSourceFile = realpath($inSourceFile);
        include_once $inSourceFile;
        if (!class_exists($inClassName)) {
            throw new \RuntimeException(
                sprintf(
                    'Could not find class "%s" in "%s".',
                    $inClassName,
                    $inSourceFile
                )
            );
        }

        return $inSourceFile;
    }

    /**
     * Infer the input source file location based on the input class name.
     *
     * @param string $inClassName
     *
     * @return string
     * @throws \RuntimeException
     */
    private function inferSourceFileNameFromClassName(
        $inClassName
    )
    {
        $inSourceFile = null;
        // The source file name may have name spaces separated by '_'.
        $normalizedClassNameWithNameSpace = str_replace(
            array('_', '\\'),
            DIRECTORY_SEPARATOR,
            $inClassName
        );
        $possibleFilenames = [
            // Simple class name case.
            $inClassName . '.php',
            // class name with name sapce case.
            $normalizedClassNameWithNameSpace . '.php'
        ];
        foreach ($possibleFilenames as $possibleFilename) {
            if (is_file($possibleFilename)) {
                $inSourceFile = $possibleFilename;
            }
        }
        if (!$inSourceFile) {
            $msg = sprintf(
                'The input source files inferred on the class name (%s) :' .
                ' ("%s" or "%s") could not be opened.',
                $inClassName,
                $possibleFilenames[0],
                $possibleFilenames[1]
            );
            throw new \RuntimeException($msg);
        }

        return $inSourceFile;
    }

    /**
     * @param  string $inClassName
     *
     * @return string
     *
     * The class is already loaded.
     * Return the class source file name associated with this class.
     */
    private function getSourceFileNamefromLoadedClass($inClassName)
    {
        $reflector = new \ReflectionClass($inClassName);
        $inSourceFile = $reflector->getFileName();
        if ($inSourceFile === false) {
            $inSourceFile = '<internal>';
        }

        return $inSourceFile;
    }
}
