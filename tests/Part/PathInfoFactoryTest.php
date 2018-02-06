<?php

namespace Gmi\Toolkit\Fileinfo\Tests\Part;

use PHPUnit\Framework\TestCase;

use Gmi\Toolkit\Fileinfo\Part\PathInfo;
use Gmi\Toolkit\Fileinfo\Part\PathInfoFactory;

use SplFileInfo;

class PathInfoFactoryTest extends TestCase
{
    public function testCreate()
    {
        $basename = 'bar.pdf';
        $extension = 'pdf';
        $filename = 'bar.pdf';
        $path = 'to';
        $pathname = 'to/bar.pdf';
        $realpath = '/path/to/bar.pdf';

        $mockFileInfo = $this->createMock(SplFileInfo::class);
        $mockFileInfo->expects($this->once())
                     ->method('getBasename')
                     ->will($this->returnValue($basename));
        $mockFileInfo->expects($this->once())
                     ->method('getExtension')
                     ->will($this->returnValue($extension));
        $mockFileInfo->expects($this->once())
                     ->method('getFilename')
                     ->will($this->returnValue($filename));
        $mockFileInfo->expects($this->once())
                     ->method('getPath')
                     ->will($this->returnValue($path));
        $mockFileInfo->expects($this->once())
                     ->method('getPathname')
                     ->will($this->returnValue($pathname));
        $mockFileInfo->expects($this->once())
                     ->method('getRealpath')
                     ->will($this->returnValue($realpath));

        $factory = new PathInfoFactory();
        $info = $factory->create($mockFileInfo);
        $this->assertInstanceOf(PathInfo::class, $info);
        $this->assertSame($basename, $info->getBasename());
        $this->assertSame($extension, $info->getExtension());
        $this->assertSame($filename, $info->getFilename());
        $this->assertSame($path, $info->getPath());
        $this->assertSame($pathname, $info->getPathname());
        $this->assertSame($realpath, $info->getRealPath());
    }
}
