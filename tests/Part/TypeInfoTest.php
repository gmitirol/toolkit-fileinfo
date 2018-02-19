<?php

namespace Gmi\Toolkit\Fileinfo\Tests\Part;

use PHPUnit\Framework\TestCase;

use Gmi\Toolkit\Fileinfo\Part\TypeInfo;

class TypeInfoTest extends TestCase
{
    public function testGetMimeType()
    {
        $typeInfo = new TypeInfo('text/plain');
        $this->assertSame('text/plain', $typeInfo->getMimeType());
    }
}
