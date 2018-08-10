<?php
/**
 * A doc generator that outputs text-based documentation.
 *
 * Output is designed to be displayed in a terminal and is wrapped to 100 characters.
 *
 * @author    Greg Sherwood <gsherwood@squiz.net>
 * @copyright 2006-2015 Squiz Pty Ltd (ABN 77 084 670 600)
 * @license   https://github.com/squizlabs/PHP_CodeSniffer/blob/master/licence.txt BSD Licence
 */

namespace PHP_CodeSniffer\Generators;

use PHP_CodeSniffer\Autoload;
use PHP_CodeSniffer\Ruleset;

class MissingDocs extends Generator
{


    /**
     * MissingDocs constructor.
     *
     * @param Ruleset $ruleset Ruleset
     */
    public function __construct(Ruleset $ruleset)
    {
        $this->ruleset = $ruleset;

        foreach ($ruleset->sniffs as $className => $sniffClass) {
            $file    = Autoload::getLoadedFileName($className);
            $docFile = str_replace(
                DIRECTORY_SEPARATOR.'Sniffs'.DIRECTORY_SEPARATOR,
                DIRECTORY_SEPARATOR.'Docs'.DIRECTORY_SEPARATOR,
                $file
            );
            $docFile = str_replace('Sniff.php', 'Standard.xml', $docFile);

            if (is_file($docFile) === false) {
                $this->docFiles[] = $docFile;
            }
        }

    }//end __construct()


    /**
     * List of all missing documentation xml files
     *
     * @return void
     */
    public function generate()
    {
        foreach ($this->docFiles as $file) {
            echo $this->getRule($file).' => '.$file.PHP_EOL;
        }

    }//end generate()


    /**
     * Process the documentation for a single sniff.
     *
     * Doc generators must implement this function to produce output.
     *
     * @param \DOMNode $doc The DOMNode object for the sniff.
     *                      It represents the "documentation" tag in the XML
     *                      standard file.
     *
     * @return void
     * @see    generate()
     */
    protected function processSniff(\DOMNode $doc)
    {
        return;

    }//end processSniff()


}//end class
