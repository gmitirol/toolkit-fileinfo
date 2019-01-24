<?php
/**
 * Permission information part.
 *
 * @copyright 2018 Institute of Legal Medicine, Medical University of Innsbruck
 * @author Andreas Erhard <andreas.erhard@i-med.ac.at>
 * @license LGPL-3.0-only
 * @link http://www.gerichtsmedizin.at/
 *
 * @package fileinfo
 */
namespace Gmi\Toolkit\Fileinfo\Part;

/**
 * Represents the permission information part of a FileInfo.
 */
class PermissionInfo implements InfoPartInterface
{
    /**
     * @var int
     */
    private $owner;

    /**
     * @var string
     */
    private $ownerName;

    /**
     * @var int
     */
    private $group;

    /**
     * @var string
     */
    private $groupName;

    /**
     * @var int
     */
    private $perms;

    /**
     * Constructor.
     *
     * @internal
     *
     * @param int    $owner
     * @param string $ownerName
     * @param int    $group
     * @param string $groupName
     * @param int    $perms
     */
    public function __construct($owner, $ownerName, $group, $groupName, $perms)
    {
        $this->owner = $owner;
        $this->ownerName = $ownerName;
        $this->group = $group;
        $this->groupName = $groupName;
        $this->perms = $perms;
    }

    /**
     * Returns the owner ID of the file.
     *
     * @return int
     */
    public function getOwner()
    {
        return $this->owner;
    }

    /**
     * Returns the owner name of the file.
     *
     * @return string
     */
    public function getOwnerName()
    {
        return $this->ownerName;
    }

    /**
     * Returns the group ID of the file.
     *
     * @return int
     */
    public function getGroup()
    {
        return $this->group;
    }

    /**
     * Returns the group name of the file.
     *
     * @return string
     */
    public function getGroupName()
    {
        return $this->groupName;
    }

    /**
     * Returns the permissions of the file.
     *
     * @return int
     */
    public function getPerms()
    {
        return $this->perms;
    }

    /**
     * Returns the formatted permissions of the file in octal format.
     *
     * @return string
     */
    public function getPermsOctal()
    {
        return sprintf('%o', $this->getPerms());
    }

    /**
     * Returns the formatted permissions of the file in rwx format (only permission bits).
     *
     * @return string
     */
    public function getPermsFormatted()
    {
        return $this->formatOwnerPerms() . $this->formatGroupPerms() . $this->formatWorldPerms();
    }

    /**
     * Returns whether the file has the read bit set for the owner.
     *
     * @return bool
     */
    public function isOwnerReadable()
    {
        return $this->matchPerms('400');
    }

    /**
     * Returns whether the file has the write bit set for the owner.
     *
     * @return bool
     */
    public function isOwnerWritable()
    {
        return $this->matchPerms('200');
    }

    /**
     * Returns whether the file has the execute bit set for the owner.
     *
     * @return bool
     */
    public function isOwnerExecutable()
    {
        return $this->matchPerms('100');
    }

    /**
     * Returns whether the file has the read bit set for the group.
     *
     * @return bool
     */
    public function isGroupReadable()
    {
        return $this->matchPerms('040');
    }

    /**
     * Returns whether the file has the write bit set for the group.
     *
     * @return bool
     */
    public function isGroupWritable()
    {
        return $this->matchPerms('020');
    }

    /**
     * Returns whether the file has the execute bit set for the group.
     *
     * @return bool
     */
    public function isGroupExecutable()
    {
        return $this->matchPerms('010');
    }

    /**
     * Returns whether the file has the read bit set for others/world.
     *
     * @return bool
     */
    public function isWorldReadable()
    {
        return $this->matchPerms('004');
    }

    /**
     * Returns whether the file has the write bit set for others/world.
     *
     * @return bool
     */
    public function isWorldWritable()
    {
        return $this->matchPerms('002');
    }

    /**
     * Returns whether the file has the execute bit set for others/world.
     *
     * @return bool
     */
    public function isWorldExecutable()
    {
        return $this->matchPerms('001');
    }

    /**
     * Matches an octal string against the file permissions.
     *
     * @param string $oct octal permission string
     *
     * @return bool
     */
    private function matchPerms($oct)
    {
        return ($this->perms & octdec($oct)) === octdec($oct);
    }

    /**
     * Returns the formatted owner permissions of the file in rwx format.
     *
     * @return string
     */
    private function formatOwnerPerms()
    {
        $permstr = '';
        $permstr .= $this->isOwnerReadable() ? 'r' : '-';
        $permstr .= $this->isOwnerWritable() ? 'w' : '-';
        $permstr .= $this->isOwnerExecutable() ? 'x' : '-';

        return $permstr;
    }

    /**
     * Returns the formatted group permissions of the file in rwx format.
     *
     * @return string
     */
    private function formatGroupPerms()
    {
        $permstr = '';
        $permstr .= $this->isGroupReadable() ? 'r' : '-';
        $permstr .= $this->isGroupWritable() ? 'w' : '-';
        $permstr .= $this->isGroupExecutable() ? 'x' : '-';

        return $permstr;
    }

    /**
     * Returns the formatted world permissions of the file in rwx format.
     *
     * @return string
     */
    private function formatWorldPerms()
    {
        $permstr = '';
        $permstr .= $this->isWorldReadable() ? 'r' : '-';
        $permstr .= $this->isWorldWritable() ? 'w' : '-';
        $permstr .= $this->isWorldExecutable() ? 'x' : '-';

        return $permstr;
    }
}
