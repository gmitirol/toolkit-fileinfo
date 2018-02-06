<?php
/**
 * PathInfoFactory.
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
 * Factory for creating PathInfo parts.
 *
 * @internal
 */
class PathInfoFactory implements InfoFactoryInterface
{
    /**
     * Creates a path info value object.
     *
     * @param SplFileInfo $fileInfo
     *
     * @return PathInfo
     */
    public function create(SplFileInfo $fileInfo)
    {
        return new PathInfo(
            $fileInfo->getBasename(),
            $fileInfo->getExtension(),
            $fileInfo->getFilename(),
            $fileInfo->getPath(),
            $fileInfo->getPathname(),
            $fileInfo->getRealPath()
        );
    }
}
