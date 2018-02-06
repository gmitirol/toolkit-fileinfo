<?php

namespace Gmi\Toolkit\Fileinfo\Tests\Part;

use PHPUnit\Framework\TestCase;

use Gmi\Toolkit\Fileinfo\Part\PermissionInfo;

class PermissionInfoTest extends TestCase
{
    public function testGetters()
    {
        $permissionInfo = new PermissionInfo(
            1000,
            'jdoe',
            50,
            'staff',
            33188
        );

        $this->assertSame(1000, $permissionInfo->getOwner());
        $this->assertSame('jdoe', $permissionInfo->getOwnerName());
        $this->assertSame(50, $permissionInfo->getGroup());
        $this->assertSame('staff', $permissionInfo->getGroupName());
        $this->assertSame(33188, $permissionInfo->getPerms());
    }

    public function testGetPermsOctal()
    {
        $permissionInfo = new PermissionInfo(
            1000,
            'jdoe',
            50,
            'staff',
            33188
        );

        $this->assertSame(33188, $permissionInfo->getPerms());
        $this->assertSame('100644', $permissionInfo->getPermsOctal());
    }

    /**
     * Tests the permissing formatting.
     *
     * @dataProvider permissionsProvider
     *
     * @param string $expected
     * @param string $permissions
     */
    public function testGetPermsFormatted($expected, $permissions)
    {
        $permissionInfo = new PermissionInfo(
            1000,
            'jdoe',
            50,
            'staff',
            octdec($permissions)
        );

        $this->assertSame($expected, $permissionInfo->getPermsFormatted());
    }

    public function testPermissionQueries()
    {
        $permissionInfo = new PermissionInfo(
            1000,
            'jdoe',
            50,
            'staff',
            octdec('700')
        );

        $this->assertTrue($permissionInfo->isOwnerReadable());
        $this->assertTrue($permissionInfo->isOwnerWritable());
        $this->assertTrue($permissionInfo->isOwnerExecutable());
        $this->assertFalse($permissionInfo->isGroupReadable());
        $this->assertFalse($permissionInfo->isGroupWritable());
        $this->assertFalse($permissionInfo->isGroupExecutable());
        $this->assertFalse($permissionInfo->isWorldReadable());
        $this->assertFalse($permissionInfo->isWorldWritable());
        $this->assertFalse($permissionInfo->isWorldExecutable());
    }

    public function permissionsProvider()
    {
        return [
            ['rw-r--r--', '0644'],
            ['rw-r--r--', '644'],
            ['rwxrwxrwx', '777'],
            ['rwxr-xr-x', '755'],
            ['rw----rwx', '607'],
            ['-wx--x-w-', '312'],
            ['r-x--x--x', '511'],
            ['---------', '000'],
        ];
    }
}
