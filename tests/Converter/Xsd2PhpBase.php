<?php
namespace Goetas\Xsd\XsdToPhp\Tests\Converter;

use Goetas\Xsd\XsdToPhp\Xsd2PhpConverter;
use Goetas\XML\XSDReader\SchemaReader;

abstract class Xsd2PhpBase extends \PHPUnit_Framework_TestCase
{
    /**
     *
     * @var Xsd2PhpConverter
     */
    protected $converter;

    /**
     *
     * @var SchemaReader
     */
    protected $reader;

    public function setUp()
    {
        $this->converter = new Xsd2PhpConverter();
        $this->converter->addNamespace('http://www.example.com', "Example");

        $this->reader = new SchemaReader();
    }

    protected function getClasses($xml)
    {

        $schema = $this->reader->readString($xml);
        return $this->converter->convert(array($schema));

    }

    public function getBaseTypeConversions()
    {
        return [
            ['xs:dateTime', 'DateTime'],
            ];
    }


    public function getPrimitiveTypeConversions()
    {
        return [
            ['xs:string', 'string'],
            ['xs:decimal', 'float'],
            ['xs:int', 'integer'],
            ['xs:integer', 'integer'],
            ];
    }
}