<?php
/**
 * Represents a file type.
 *
 * @copyright 2018 Institute of Legal Medicine, Medical University of Innsbruck
 * @author Andreas Erhard <andreas.erhard@i-med.ac.at>
 * @license LGPL-3.0-only
 * @link http://www.gerichtsmedizin.at/
 *
 * @package fileinfo
 */
namespace Gmi\Toolkit\Fileinfo\Type;

/**
 * Represents a file type with (possible) extensions and a MIME type.
 */
class Type
{
    /**
     * @var string[]
     */
    private $extensions;

    /**
     * @var string
     */
    private $mimeType;

    /**
     * Constructor.
     *
     * @param string[] $extensions
     * @param string   $mimeType
     */
    public function __construct(array $extensions, $mimeType)
    {
        $this->extensions = $extensions;
        $this->mimeType = $mimeType;
    }

    /**
     * Returns the file extensions for the file type.
     *
     * @return string[]
     */
    public function getExtensions()
    {
        return $this->extensions;
    }

    /**
     * Returns the preferred file extension for the file type.
     *
     * @return string
     */
    public function getPreferredExtension()
    {
        return $this->extensions[0];
    }

    /**
     * Returns the MIME type for the file type.
     *
     * @return string
     */
    public function getMimeType()
    {
        return $this->mimeType;
    }
}
