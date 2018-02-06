<?php
/**
 * FileInfo factory.
 *
 * @copyright 2018 Institute of Legal Medicine, Medical University of Innsbruck
 * @author Andreas Erhard <andreas.erhard@i-med.ac.at>
 * @license LGPL-3.0-only
 * @link http://www.gerichtsmedizin.at/
 *
 * @package fileinfo
 */
namespace Gmi\Toolkit\Fileinfo;

/**
 * Factory for creating FileInfo instances.
 */
class FileInfoFactory
{
    /**
     * Creates a FileInfo instance.
     *
     * @param string $file      Path and filename of the file.
     * @param int    $infoParts Bitmask of INFO_* constants.
     *
     * @return FileInfo
     */
    public function create($file, $infoParts = FileInfo::INFO_ALL)
    {
        return new FileInfo($file, $infoParts);
    }
}
