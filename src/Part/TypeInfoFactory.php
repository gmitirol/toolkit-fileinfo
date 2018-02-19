<?php
/**
 * TypeInfoFactory.
 *
 * @copyright 2018 Institute of Legal Medicine, Medical University of Innsbruck
 * @author Andreas Erhard <andreas.erhard@i-med.ac.at>
 * @license LGPL-3.0-only
 * @link http://www.gerichtsmedizin.at/
 *
 * @package fileinfo
 */
namespace Gmi\Toolkit\Fileinfo\Part;

use Gmi\Toolkit\Fileinfo\Type\ExtensionMimeTypeGuesser;
use SplFileInfo;

/**
 * Factory for creating TypeInfo parts.
 *
 * @internal
 */
class TypeInfoFactory implements InfoFactoryInterface
{
    /**
     * Creates a type info value object.
     *
     * @param SplFileInfo $fileInfo
     *
     * @return TypeInfo
     */
    public function create(SplFileInfo $fileInfo)
    {
        $guesser = new ExtensionMimeTypeGuesser();

        return new TypeInfo($guesser->guess(mb_strtolower($fileInfo->getExtension())));
    }
}
