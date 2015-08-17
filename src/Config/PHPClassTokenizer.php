<?php

namespace Box\TestScribe\Config;

/**
 * Class PHPClassTokenizer
 * Gets the classes and namespaces defined in file.
 */
class PHPClassTokenizer
{
    /**
     * @var string $file
     */
    private $file;

    /**
     * @var array
     */
    private $classesDeclared = [];

    /**
     * @var array
     */
    private $namespacesDeclared = [];

    /**
     * @param string $file
     */
    public function __construct($file)
    {
        $this->file = $file;
    }

    /**
     * Get all the classes declared.
     * If the classes are in their own namespace, return a list of
     * fully qualified class names. Otherwise return a list of
     * simple class names.
     *
     * @throws \RuntimeException
     * @return array
     */
    public function getClassesDeclared()
    {
        $numberOfNameSpaces = count($this->namespacesDeclared);
        if ($numberOfNameSpaces > 1) {
            throw new \RuntimeException("Multiple namespaces in the same file is not supported.");
        }

        $classes = $this->classesDeclared;
        if (count($classes) === 0) {
            throw new \RuntimeException("No class is declared.");
        }

        if ($numberOfNameSpaces === 0) {
            return $classes;
        }

        /** @var string $nameSpace */
        $nameSpace = $this->namespacesDeclared[0];

        $fullyQualifiedClasses = [];
        foreach ($classes as $className) {
            $fullyQualifiedClass = $nameSpace . '\\' . $className;
            $fullyQualifiedClasses[] = $fullyQualifiedClass;
        }

        return $fullyQualifiedClasses;
    }

    /**
     * @return array
     */
    public function getNamespacesDeclared()
    {
        return $this->namespacesDeclared;
    }

    /**
     * @return void
     */
    public function parseAndSetClassNameAndNamespace()
    {
        $classes = $namespaces = [];
        $buffer = file_get_contents($this->file);
        $tokens = token_get_all($buffer);
        for ($i = 0; $i < count($tokens); $i++) {
            if ($tokens[$i][0] === T_NAMESPACE) {
                $namespace = '';
                for ($j = $i + 1; $j < count($tokens); $j++) {
                    if ($tokens[$j][0] === T_STRING) {
                        $namespace .= '\\' . $tokens[$j][1];
                    } else if ($tokens[$j] === '{' || $tokens[$j] === ';') {
                        $namespaces[] = $namespace;
                        break;
                    }
                }
            }

            if ($tokens[$i][0] === T_CLASS) {
                for ($j = $i + 1; $j < count($tokens); $j++) {
                    if ($tokens[$j] === '{') {
                        if (!in_array($tokens[$i + 2][1], $classes)) {
                            $classes[] = $tokens[$i + 2][1];
                        }
                    }
                }
            }
        }

        $this->classesDeclared = $classes;
        $this->namespacesDeclared = $namespaces;
    }
}
