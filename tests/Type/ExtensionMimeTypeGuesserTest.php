<?php

namespace Gmi\Toolkit\Fileinfo\Tests\Part;

use PHPUnit\Framework\TestCase;

use Gmi\Toolkit\Fileinfo\Type\ExtensionMimeTypeGuesser;
use Gmi\Toolkit\Fileinfo\Type\Type;
use Gmi\Toolkit\Fileinfo\Type\TypeMapInterface;

class ExtensionMimeTypeGuesserTest extends TestCase
{
    public function testGuessKnownType()
    {
        $type = new Type(['example'], 'application/x-example-type');

        $mockMap = $this->createMock(TypeMapInterface::class);
        $mockMap->expects($this->once())
                ->method('getMap')
                ->will($this->returnValue([$type]));

        $guesser = new ExtensionMimeTypeGuesser([$mockMap]);
        $this->assertSame('application/x-example-type', $guesser->guess('example'));
    }

    public function testGuessUnknownType()
    {
        $guesser = new ExtensionMimeTypeGuesser();
        $this->assertSame('application/octet-stream', $guesser->guess('unknown'));
    }
}
