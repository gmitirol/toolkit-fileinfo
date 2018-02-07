<?php
/**
 * DateInfoFactory.
 *
 * @copyright 2018 Institute of Legal Medicine, Medical University of Innsbruck
 * @author Andreas Erhard <andreas.erhard@i-med.ac.at>
 * @license LGPL-3.0-only
 * @link http://www.gerichtsmedizin.at/
 *
 * @package fileinfo
 */
namespace Gmi\Toolkit\Fileinfo\Part;

use Gmi\Toolkit\Fileinfo\Exception\FileUnreadableException;

use DateTime;
use SplFileInfo;

/**
 * Factory for creating DateInfo parts.
 *
 * @internal
 */
class DateInfoFactory implements InfoFactoryInterface
{
    /**
     * Creates a date info value object.
     *
     * @param SplFileInfo $fileInfo
     *
     * @return DateInfo
     */
    public function create(SplFileInfo $fileInfo)
    {
        /**
         * Workaround for setting the correct timezone.
         *
         * In contrast to date(), DateTime::createFromFormat does not apply the default timezone.
         *
         * Example:
         *
         * date('H:i:s', 1517830602) returns '12:36:42'
         * DateTime::createFromFormat('U', 1517830602)->format('H:i:s') returns '11:36:42'
         *
         * @see http://de.php.net/manual/en/datetime.createfromformat.php
         */
        $now = new DateTime();

        $lastAccessed = DateTime::createFromFormat('U', $fileInfo->getATime());
        if ($lastAccessed === false) {
            throw new FileUnreadableException('Access date metadata can not be read!');
        }
        $lastAccessed->setTimezone($now->getTimezone());

        $lastModified = DateTime::createFromFormat('U', $fileInfo->getMTime());
        if ($lastModified === false) {
            throw new FileUnreadableException('Modification date metadata can not be read!');
        }
        $lastModified->setTimezone($now->getTimezone());

        return new DateInfo($lastAccessed, $lastModified);
    }
}
