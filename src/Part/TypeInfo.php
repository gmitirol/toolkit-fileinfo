<?php
/**
 * Type information part.
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
 * Represents the file type information part of a FileInfo.
 */
class TypeInfo implements InfoPartInterface
{
    /**
     * @var string
     */
    private $mimeType;

    /**
     * Constructor.
     *
     * @internal
     *
     * @param string $mimeType
     */
    public function __construct($mimeType)
    {
        $this->mimeType = $mimeType;
    }

    /**
     * Returns the MIME type of a file.
     *
     * @return string
     */
    public function getMimeType()
    {
        return $this->mimeType;
    }
}
