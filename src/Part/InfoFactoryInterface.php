<?php
/**
 * InfoFactoryInterface.
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

use SplFileInfo;

/**
 * Interface for part information factories.
 *
 * Factories should not do work in the constructor and should be simple and fast.
 *
 * @internal
 */
interface InfoFactoryInterface
{
    /***
     * Creates a file info part value object.
     *
     * @param SplFileInfo
     *
     * @return InfoPartInterface
     *
     * @throws FileUnreadableException if file metadata can't be read
     */
    public function create(SplFileInfo $fileInfo);
}
