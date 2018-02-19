<?php

namespace Gmi\Toolkit\Fileinfo\Tests;

use PHPUnit\Framework\TestCase;

use Gmi\Toolkit\Fileinfo\FileInfo;
use Gmi\Toolkit\Fileinfo\Exception\FileUnreadableException;
use Gmi\Toolkit\Fileinfo\Exception\UnavailableException;

class FileinfoTest extends TestCase
{
    private static $previousTimezone;
    private static $testPath;

    public static function setUpBeforeClass()
    {
        self::$previousTimezone = date_default_timezone_get();
        date_default_timezone_set('Europe/Vienna');

        self::$testPath = sprintf('%s/%s', __DIR__, uniqid('', true));

        @mkdir(self::$testPath);
    }

    public static function tearDownAfterClass()
    {
        $files = glob(self::$testPath . '/*.txt');
        foreach ($files as $file) {
            @unlink($file);
        }

        @rmdir(self::$testPath);

        date_default_timezone_set(self::$previousTimezone);
    }

    public function testFileUnreadable()
    {
        $file = self::$testPath . '/testFileUnreadable.txt';

        $this->expectException(FileUnreadableException::class);
        $this->expectExceptionMessage(sprintf('File "%s" can not be read!', $file));
        new FileInfo($file);
    }

    public function testPathInfoUnavailable()
    {
        $file = self::$testPath . '/testPathInfoUnavailable.txt';
        file_put_contents($file, 'testPathInfoUnavailable');

        $fileInfo = new FileInfo($file, FileInfo::INFO_NONE);
        $this->expectException(UnavailableException::class);
        $this->expectExceptionMessage('Path information is not available!');
        $fileInfo->getPathInfo();
    }

    public function testSizeInfoUnavailable()
    {
        $file = self::$testPath . '/testSizeInfoUnavailable.txt';
        file_put_contents($file, 'testSizeInfoUnavailable');

        $fileInfo = new FileInfo($file, FileInfo::INFO_NONE);
        $this->expectException(UnavailableException::class);
        $this->expectExceptionMessage('Size information is not available!');
        $fileInfo->getSizeInfo();
    }

    public function testDateInfoUnavailable()
    {
        $file = self::$testPath . '/testDateInfoUnavailable.txt';
        file_put_contents($file, 'testDateInfoUnavailable');

        $fileInfo = new FileInfo($file, FileInfo::INFO_NONE);
        $this->expectException(UnavailableException::class);
        $this->expectExceptionMessage('Date information is not available!');
        $fileInfo->getDateInfo();
    }

    public function testPermissionInfoUnavailable()
    {
        $file = self::$testPath . '/testPermissionInfoUnavailable.txt';
        file_put_contents($file, 'testPermissionInfoUnavailable');

        $fileInfo = new FileInfo($file, FileInfo::INFO_NONE);
        $this->expectException(UnavailableException::class);
        $this->expectExceptionMessage('Permission information is not available!');
        $fileInfo->getPermissionInfo();
    }

    public function testTypeInfoUnavailable()
    {
        $file = self::$testPath . '/testTypeInfoUnavailable.txt';
        file_put_contents($file, 'testTypeInfoUnavailable');

        $fileInfo = new FileInfo($file, FileInfo::INFO_NONE);
        $this->expectException(UnavailableException::class);
        $this->expectExceptionMessage('Type information is not available!');
        $fileInfo->getTypeInfo();
    }

    public function testPathInfo()
    {
        $file = self::$testPath . '/testPathInfo.txt';
        file_put_contents($file, 'testPathInfo');

        $fileInfo = new FileInfo($file, FileInfo::INFO_PATH);
        $pathInfo = $fileInfo->getPathInfo();
        $this->assertSame('testPathInfo.txt', $pathInfo->getFilename());
        $this->assertSame('testPathInfo.txt', $fileInfo->path()->getFilename());
    }

    public function testSizeInfo()
    {
        $file = self::$testPath . '/testSizeInfo.txt';
        file_put_contents($file, 'testSizeInfo');

        $fileInfo = new FileInfo($file, FileInfo::INFO_SIZE);
        $sizeInfo = $fileInfo->getSizeInfo();
        $this->assertSame(12, $sizeInfo->getSize());
        $this->assertSame(12, $fileInfo->size()->getSize());
    }

    public function testDateInfo()
    {
        $file = self::$testPath . '/testDateInfo.txt';
        file_put_contents($file, 'testDateInfo');
        @touch($file, 1517905303);

        $fileInfo = new FileInfo($file, FileInfo::INFO_DATE);
        $dateInfo = $fileInfo->getDateInfo();
        $this->assertSame('2018-02-06T09:21:43+01:00', $dateInfo->getLastModified()->format('c'));
        $this->assertSame('2018-02-06T09:21:43+01:00', $fileInfo->date()->getLastModified()->format('c'));
    }

    public function testPermissionInfo()
    {
        $file = self::$testPath . '/testPermissionInfo.txt';
        file_put_contents($file, 'testPermissionInfo');
        @chmod($file, 0777);

        $fileInfo = new FileInfo($file, FileInfo::INFO_PERMISSION);
        $permissionInfo = $fileInfo->getPermissionInfo();
        $this->assertSame('rwxrwxrwx', $permissionInfo->getPermsFormatted());
        $this->assertSame('rwxrwxrwx', $fileInfo->perm()->getPermsFormatted());
    }

    public function testTypeInfo()
    {
        $file = self::$testPath . '/testTypeInfo.txt';
        file_put_contents($file, 'testTypeInfo');

        $fileInfo = new FileInfo($file, FileInfo::INFO_TYPE);
        $typeInfo = $fileInfo->getTypeInfo();
        $this->assertSame('text/plain', $typeInfo->getMimeType());
        $this->assertSame('text/plain', $fileInfo->type()->getMimeType());
    }

    public function testReloadWithOtherPart()
    {
        $file = self::$testPath . '/testReloadWithOtherPart.txt';
        file_put_contents($file, 'testReloadWithOtherPart');

        $fileInfo = new FileInfo($file, FileInfo::INFO_NONE);
        $fileInfo->reload(FileInfo::INFO_PATH);
        $fileInfo->getPathInfo();
    }
}
