<?php

namespace Gmi\Toolkit\Fileinfo\Tests\Part;

use PHPUnit\Framework\TestCase;

use Gmi\Toolkit\Fileinfo\Part\DateInfo;

use DateTime;

class DateInfoTest extends TestCase
{
    public function testGetters()
    {
        $adate = new DateTime('2018-02-03 20:30:42');
        $mdate = new DateTime('2018-01-01 01:17:23');

        $dateInfo = new DateInfo($adate, $mdate);

        $this->assertSame($adate, $dateInfo->getLastAccessed());
        $this->assertSame($mdate, $dateInfo->getLastModified());
    }
}
