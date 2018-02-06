<?php

namespace Gmi\Toolkit\Fileinfo\Tests\Part;

use PHPUnit\Framework\TestCase;

use Gmi\Toolkit\Fileinfo\Part\PathInfo;

class PathInfoTest extends TestCase
{
    public function testGetters()
    {
        $pathInfo = new PathInfo(
            'foo.txt',
            'txt',
            'foo.txt',
            'to',
            'to/foo.txt',
            '/path/to/foo.txt'
        );

        $this->assertSame('foo.txt', $pathInfo->getBasename());
        $this->assertSame('txt', $pathInfo->getExtension());
        $this->assertSame('foo.txt', $pathInfo->getFilename());
        $this->assertSame('to', $pathInfo->getPath());
        $this->assertSame('to/foo.txt', $pathInfo->getPathname());
        $this->assertSame('/path/to/foo.txt', $pathInfo->getRealPath());
    }

    public function testGetFilenameWithoutExtension()
    {
        $pathInfo = new PathInfo(
            'example.jpg',
            'jpg',
            'example.jpg',
            'to',
            'to/example.jpg',
            '/path/to/example.jpg'
        );

        $this->assertSame('jpg', $pathInfo->getExtension());
        $this->assertSame('example', $pathInfo->getFilenameWithoutExtension());
    }

    public function testGetFilenameWithoutExtensionLongExtension()
    {
        $pathInfo = new PathInfo(
            'test.accdb',
            'accdb',
            'test.accdb',
            'to',
            'to/test.accdb',
            '/path/to/test.accdb'
        );

        $this->assertSame('accdb', $pathInfo->getExtension());
        $this->assertSame('test', $pathInfo->getFilenameWithoutExtension());
    }

    public function testGetFilenameWithoutExtensionSpecialCharacterInFilename()
    {
        $pathInfo = new PathInfo(
            'example♥.jpg',
            'jpg',
            'example♥.jpg',
            'to',
            'to/example♥.jpg',
            '/path/to/example♥.jpg'
        );

        $this->assertSame('jpg', $pathInfo->getExtension());
        $this->assertSame('example♥', $pathInfo->getFilenameWithoutExtension());
    }

    public function testGetFilenameWithoutExtensionSpecialCharacterInExtension()
    {
        $pathInfo = new PathInfo(
            'example.file★',
            'file★',
            'example.file★',
            'to',
            'to/example.file★',
            '/path/to/example.file★'
        );

        $this->assertSame('file★', $pathInfo->getExtension());
        $this->assertSame('example', $pathInfo->getFilenameWithoutExtension());
    }

    public function testGetFilenameWithoutExtensionNoExtension()
    {
        $pathInfo = new PathInfo(
            'example',
            '',
            'example',
            'to',
            'to/example',
            '/path/to/example'
        );

        $this->assertSame('', $pathInfo->getExtension());
        $this->assertSame('example', $pathInfo->getFilenameWithoutExtension());
    }
}
