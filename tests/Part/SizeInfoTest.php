<?php

namespace Gmi\Toolkit\Fileinfo\Tests\Part;

use PHPUnit\Framework\TestCase;

use Gmi\Toolkit\Fileinfo\Part\SizeInfo;

class SizeInfoTest extends TestCase
{
    /**
     * Tests the file size formatting.
     *
     * @dataProvider fileSizesProvider
     *
     * @param string $expected
     * @param int    $size
     * @param bool   $si
     */
    public function testGetSizeFormatted($expected, $size, $si)
    {
        $sizeInfo = new SizeInfo($size);
        $this->assertSame($expected, $sizeInfo->getSizeFormatted(null, $si));
    }

    public function testGetSizeFormattedForcedUnit()
    {
        $sizeInfo = new SizeInfo(12345678);
        $this->assertSame('12345.68 kB', $sizeInfo->getSizeFormatted('kB', true));
    }

    public function testGetSizeFormattedCustomFormat()
    {
        $sizeInfo = new SizeInfo(123456789);
        $this->assertSame('123.4568 MB', $sizeInfo->getSizeFormatted('MB', true, '%01.4f %s'));
    }

    public function fileSizesProvider()
    {
        return [
            ['1.00 B', 1e0, true],
            ['10.00 B', 1e1, true],
            ['100.00 B', 1e2, true],
            ['1.00 kB', 1e3, true],
            ['10.00 kB', 1e4, true],
            ['100.00 kB', 1e5, true],
            ['1.00 MB', 1e6, true],
            ['10.00 MB', 1e7, true],
            ['100.00 MB', 1e8, true],
            ['1.00 GB', 1e9, true],
            ['10.00 GB', 1e10, true],
            ['100.00 GB', 1e11, true],
            ['1.00 TB', 1e12, true],
            ['10.00 TB', 1e13, true],
            ['100.00 TB', 1e14, true],
            ['1.00 PB', 1e15, true],
            ['10.00 PB', 1e16, true],
            ['100.00 PB', 1e17, true],
            ['1.00 B', 1, false],
            ['1.00 KiB', 2**10, false],
            ['1.00 MiB', 2**20, false],
            ['1.00 GiB', 2**30, false],
            ['1.00 TiB', 2**40, false],
            ['1.00 PiB', 2**50, false],
        ];
    }
}
