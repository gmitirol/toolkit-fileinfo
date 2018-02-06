<?php
/**
 * Date information part.
 *
 * @copyright 2018 Institute of Legal Medicine, Medical University of Innsbruck
 * @author Andreas Erhard <andreas.erhard@i-med.ac.at>
 * @license LGPL-3.0-only
 * @link http://www.gerichtsmedizin.at/
 *
 * @package fileinfo
 */
namespace Gmi\Toolkit\Fileinfo\Part;

use DateTime;

/**
 * Represents the date information part of a FileInfo.
 */
class DateInfo implements InfoPartInterface
{
    /**
     * @var DateTime
     */
    private $lastAccessed;

    /**
     * @var DateTime
     */
    private $lastModified;

    /**
     * Constructor.
     *
     * @internal
     *
     * @param DateTime $lastAccessed
     * @param DateTime $lastModified
     */
    public function __construct(DateTime $lastAccessed, DateTime $lastModified)
    {
        $this->lastAccessed = $lastAccessed;
        $this->lastModified = $lastModified;
    }

    /**
     * Returns the last access time of the file.
     *
     * @return DateTime
     */
    public function getLastAccessed()
    {
        return $this->lastAccessed;
    }

    /**
     * Returns the last modification time of the file.
     *
     * @return DateTime
     */
    public function getLastModified()
    {
        return $this->lastModified;
    }
}
