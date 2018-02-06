<?php

namespace Gmi\Toolkit\Fileinfo\Tests;

use PHPUnit\Framework\TestCase;

use Gmi\Toolkit\Fileinfo\FileInfo;
use Gmi\Toolkit\Fileinfo\FileInfoFactory;
use Gmi\Toolkit\Fileinfo\Exception\UnavailableException;

class FileinfoFactoryTest extends TestCase
{
    private static $testPath;

    public static function setUpBeforeClass()
    {
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
    }

    public function testCreate()
    {
        $file = self::$testPath . '/testCreate.txt';
        file_put_contents($file, 'testCreate');

        $factory = new FileInfoFactory();
        $fileInfo = $factory->create($file);
        $this->assertInstanceOf(FileInfo::class, $fileInfo);
        $this->assertSame('testCreate.txt', $fileInfo->getPathInfo()->getFilename());
    }

    public function testCreateIinfoPartsPassed()
    {
        $file = self::$testPath . '/testCreateIinfoPartsPassed.txt';
        file_put_contents($file, 'testCreateIinfoPartsPassed');

        $factory = new FileInfoFactory();
        $fileInfo = $factory->create($file, FileInfo::INFO_NONE);
        $this->assertInstanceOf(FileInfo::class, $fileInfo);
        $this->expectException(UnavailableException::class);
        $this->expectExceptionMessage('Path information is not available!');
        $fileInfo->getPathInfo();
    }
}
