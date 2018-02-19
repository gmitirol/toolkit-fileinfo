<?php

namespace Gmi\Toolkit\Fileinfo\Tests\Part;

use PHPUnit\Framework\TestCase;

use Gmi\Toolkit\Fileinfo\Type\ExtensionMimeTypeGuesser;
use Gmi\Toolkit\Fileinfo\Type\Type;

class TypeMapsTest extends TestCase
{
    private static $maps;

    public static function setUpBeforeClass()
    {
        self::$maps = ExtensionMimeTypeGuesser::getDefaultTypeMaps();
    }

    public function testTypeMapsReturnTypes()
    {
        foreach (self::$maps as $map) {
            foreach ($map->getMap() as $type) {
                $this->assertInstanceOf(Type::class, $type);
            }
        }
    }

    public function testTypesHaveExtensions()
    {
        foreach (self::$maps as $map) {
            foreach ($map->getMap() as $type) {
                $this->assertNotEmpty($type->getExtensions());
            }
        }
    }

    public function testTypesHaveMimeType()
    {
        foreach (self::$maps as $map) {
            foreach ($map->getMap() as $type) {
                $this->assertRegexp('/^[a-z]+\/[a-zA-Z0-9\+\-\.]+$/', $type->getMimeType());
            }
        }
    }

    public function testTypesHavePreferredExtension()
    {
        foreach (self::$maps as $map) {
            foreach ($map->getMap() as $type) {
                $this->assertNotEmpty($type->getPreferredExtension());
            }
        }
    }
}
