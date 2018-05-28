<?php
/**
 * PermissionInfoFactory.
 *
 * @copyright 2018 Institute of Legal Medicine, Medical University of Innsbruck
 * @author Andreas Erhard <andreas.erhard@i-med.ac.at>
 * @license LGPL-3.0-only
 * @link http://www.gerichtsmedizin.at/
 *
 * @package fileinfo
 */
namespace Gmi\Toolkit\Fileinfo\Part;

use SplFileInfo;

/**
 * Factory for creating PermissionInfo parts.
 *
 * @internal
 */
class PermissionInfoFactory implements InfoFactoryInterface
{
    /**
     * Creates a permission info value object.
     *
     * @param SplFileInfo $fileInfo
     *
     * @return PermissionInfo
     */
    public function create(SplFileInfo $fileInfo)
    {
        $owner = $fileInfo->getOwner();
        $ownerInfo = posix_getpwuid($owner);
        $ownerName = isset($ownerInfo['name']) ? $ownerInfo['name'] : (string) $owner;

        $group = $fileInfo->getGroup();
        $groupInfo = posix_getgrgid($group);
        $groupName = isset($groupInfo['name']) ? $groupInfo['name'] : (string) $group;

        return new PermissionInfo($owner, $ownerName, $group, $groupName, $fileInfo->getPerms());
    }
}
