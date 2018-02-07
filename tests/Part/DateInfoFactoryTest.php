<?php

namespace Gmi\Toolkit\Fileinfo\Tests\Part;

use PHPUnit\Framework\TestCase;

use Gmi\Toolkit\Fileinfo\Part\DateInfo;
use Gmi\Toolkit\Fileinfo\Part\DateInfoFactory;
use Gmi\Toolkit\Fileinfo\Exception\FileUnreadableException;

use SplFileInfo;

class DateInfoFactoryTest extends TestCase
{
    private static $previousTimezone;

    public static function setUpBeforeClass()
    {
        self::$previousTimezone = date_default_timezone_get();
        date_default_timezone_set('Europe/Vienna');
    }

    public static function tearDownAfterClass()
    {
        date_default_timezone_set(self::$previousTimezone);
    }

    public function testCreate()
    {
        $mockFileInfo = $this->createMock(SplFileInfo::class);
        $mockFileInfo->expects($this->once())
                     ->method('getATime')
                     ->will($this->returnValue(1517830602));
        $mockFileInfo->expects($this->once())
                     ->method('getMTime')
                     ->will($this->returnValue(1500049782));

        $factory = new DateInfoFactory();
        $info = $factory->create($mockFileInfo);
        $this->assertInstanceOf(DateInfo::class, $info);
        $this->assertSame('2018-02-05T12:36:42+01:00', $info->getLastAccessed()->format('c'));
        $this->assertSame('2017-07-14T18:29:42+02:00', $info->getLastModified()->format('c'));
    }

    public function testCreateInvalidLastAccessed()
    {
        $mockFileInfo = $this->createMock(SplFileInfo::class);
        $mockFileInfo->expects($this->once())
                     ->method('getATime')
                     ->will($this->returnValue('invalid'));
        $mockFileInfo->expects($this->any())
                     ->method('getMTime')
                     ->will($this->returnValue(1514146662));

        $factory = new DateInfoFactory();

        $this->expectException(FileUnreadableException::class);
        $this->expectExceptionMessage('Access date metadata can not be read!');
        $factory->create($mockFileInfo);
    }

    public function testCreateInvalidLastModified()
    {
        $mockFileInfo = $this->createMock(SplFileInfo::class);
        $mockFileInfo->expects($this->any())
                     ->method('getATime')
                     ->will($this->returnValue(1494347944));
        $mockFileInfo->expects($this->once())
                     ->method('getMTime')
                     ->will($this->returnValue('invalid'));

        $factory = new DateInfoFactory();

        $this->expectException(FileUnreadableException::class);
        $this->expectExceptionMessage('Modification date metadata can not be read!');
        $factory->create($mockFileInfo);
    }
}
