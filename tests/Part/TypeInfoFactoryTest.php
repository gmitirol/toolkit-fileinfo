<?php

namespace Gmi\Toolkit\Fileinfo\Tests\Part;

use PHPUnit\Framework\TestCase;

use Gmi\Toolkit\Fileinfo\Part\TypeInfo;
use Gmi\Toolkit\Fileinfo\Part\TypeInfoFactory;

use SplFileInfo;

class TypeInfoFactoryTest extends TestCase
{
    public function testCreate()
    {
        $mockFileInfo = $this->createMock(SplFileInfo::class);
        $mockFileInfo->expects($this->once())
                     ->method('getExtension')
                     ->will($this->returnValue('pdf'));

        $factory = new TypeInfoFactory();
        $info = $factory->create($mockFileInfo);
        $this->assertInstanceOf(TypeInfo::class, $info);
        $this->assertSame('application/pdf', $info->getMimeType());
    }

    public function testCreateUppercaseExtension()
    {
        $mockFileInfo = $this->createMock(SplFileInfo::class);
        $mockFileInfo->expects($this->once())
                     ->method('getExtension')
                     ->will($this->returnValue('JPG'));

        $factory = new TypeInfoFactory();
        $info = $factory->create($mockFileInfo);
        $this->assertInstanceOf(TypeInfo::class, $info);
        $this->assertSame('image/jpeg', $info->getMimeType());
    }
}
