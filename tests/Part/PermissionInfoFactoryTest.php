<?php

namespace Gmi\Toolkit\Fileinfo\Tests\Part;

use PHPUnit\Framework\TestCase;

use Gmi\Toolkit\Fileinfo\Part\PermissionInfo;
use Gmi\Toolkit\Fileinfo\Part\PermissionInfoFactory;

use SplFileInfo;

class PermissionInfoFactoryTest extends TestCase
{
    public function testCreate()
    {
        $owner = 0;
        $group = 0;
        $perms = octdec('755');

        $mockFileInfo = $this->createMock(SplFileInfo::class);
        $mockFileInfo->expects($this->once())
                     ->method('getOwner')
                     ->will($this->returnValue($owner));
        $mockFileInfo->expects($this->once())
                     ->method('getGroup')
                     ->will($this->returnValue($group));
        $mockFileInfo->expects($this->once())
                     ->method('getPerms')
                     ->will($this->returnValue($perms));

        $factory = new PermissionInfoFactory();
        $info = $factory->create($mockFileInfo);
        $this->assertInstanceOf(PermissionInfo::class, $info);
        $this->assertSame($owner, $info->getOwner());
        $this->assertSame('root', $info->getOwnerName());
        $this->assertSame($group, $info->getGroup());
        $this->assertSame('root', $info->getGroupName());
        $this->assertSame($perms, $info->getPerms());
    }

    public function testCreateUnresolvableUser()
    {
        $owner = 999901;
        $group = 0;
        $perms = octdec('755');

        $mockFileInfo = $this->createMock(SplFileInfo::class);
        $mockFileInfo->expects($this->once())
                     ->method('getOwner')
                     ->will($this->returnValue($owner));
        $mockFileInfo->expects($this->once())
                     ->method('getGroup')
                     ->will($this->returnValue($group));
        $mockFileInfo->expects($this->once())
                     ->method('getPerms')
                     ->will($this->returnValue($perms));

        $factory = new PermissionInfoFactory();
        $info = $factory->create($mockFileInfo);
        $this->assertInstanceOf(PermissionInfo::class, $info);
        $this->assertSame($owner, $info->getOwner());
        $this->assertSame('999901', $info->getOwnerName());
        $this->assertSame($group, $info->getGroup());
        $this->assertSame('root', $info->getGroupName());
        $this->assertSame($perms, $info->getPerms());
    }

    public function testCreateUnresolvableGroup()
    {
        $owner = 0;
        $group = 999902;
        $perms = octdec('755');

        $mockFileInfo = $this->createMock(SplFileInfo::class);
        $mockFileInfo->expects($this->once())
                     ->method('getOwner')
                     ->will($this->returnValue($owner));
        $mockFileInfo->expects($this->once())
                     ->method('getGroup')
                     ->will($this->returnValue($group));
        $mockFileInfo->expects($this->once())
                     ->method('getPerms')
                     ->will($this->returnValue($perms));

        $factory = new PermissionInfoFactory();
        $info = $factory->create($mockFileInfo);
        $this->assertInstanceOf(PermissionInfo::class, $info);
        $this->assertSame($owner, $info->getOwner());
        $this->assertSame('root', $info->getOwnerName());
        $this->assertSame($group, $info->getGroup());
        $this->assertSame('999902', $info->getGroupName());
        $this->assertSame($perms, $info->getPerms());
    }
}
