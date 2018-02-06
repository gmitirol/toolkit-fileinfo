<?php
/**
 * SizeInfoFactory.
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
 * Factory for creating SizeInfo parts.
 *
 * @internal
 */
class SizeInfoFactory implements InfoFactoryInterface
{
    /**
     * Creates a size info value object.
     *
     * @param SplFileInfo $fileInfo
     *
     * @return SizeInfo
     */
    public function create(SplFileInfo $fileInfo)
    {
        return new SizeInfo($fileInfo->getSize());
    }
}
