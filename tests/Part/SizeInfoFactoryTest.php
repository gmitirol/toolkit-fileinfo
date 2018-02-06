<?php

namespace Gmi\Toolkit\Fileinfo\Tests\Part;

use PHPUnit\Framework\TestCase;

use Gmi\Toolkit\Fileinfo\Part\SizeInfo;
use Gmi\Toolkit\Fileinfo\Part\SizeInfoFactory;

use SplFileInfo;

class SizeInfoFactoryTest extends TestCase
{
    public function testCreate()
    {
        $mockFileInfo = $this->createMock(SplFileInfo::class);
        $mockFileInfo->expects($this->once())
                     ->method('getSize')
                     ->will($this->returnValue(42));

        $factory = new SizeInfoFactory();
        $info = $factory->create($mockFileInfo);
        $this->assertInstanceOf(SizeInfo::class, $info);
        $this->assertSame(42, $info->getSize());
    }
}
