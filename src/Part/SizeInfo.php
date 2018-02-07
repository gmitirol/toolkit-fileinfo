<?php
/**
 * Size information part.
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
 * Represents the file size information part of a FileInfo.
 */
class SizeInfo implements InfoPartInterface
{
    /**
     * @var int
     */
    private $size;

    /**
     * Constructor.
     *
     * @internal
     *
     * @param int $size
     */
    public function __construct($size)
    {
        $this->size = $size;
    }

    /**
     * Returns the file size in bytes.
     *
     * @return int
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * Returns the formatted (human readable) file size.
     *
     * Based on https://github.com/mjphaynes/php-resque/blob/master/src/Resque/Helpers/Util.php
     *
     * @param string $forceUnit
     * @param bool   $si
     * @param string $format
     *
     * @return string
     */
    public function getSizeFormatted($forceUnit = null, $si = false, $format = null)
    {
        $format = ($format === null) ? '%01.2f %s' : (string) $format;

        if ($si === false || strpos($forceUnit, 'i') !== false) {
            // IEC prefixes (binary)
            $units = ['B', 'KiB', 'MiB', 'GiB', 'TiB', 'PiB'];
            $mod = 1024;
        } else {
            // SI prefixes (decimal)
            $units = ['B', 'kB', 'MB', 'GB', 'TB', 'PB'];
            $mod = 1000;
        }

        if (($power = array_search((string) $forceUnit, $units)) === false) {
            $power = ($this->size > 0) ? floor(log($this->size, $mod)) : 0;
        }

        return sprintf($format, $this->size / pow($mod, $power), $units[$power]);
    }
}
