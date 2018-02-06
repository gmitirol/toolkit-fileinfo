<?php
/**
 * Path information part.
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
 * Represents the path information part of a FileInfo.
 */
class PathInfo implements InfoPartInterface
{
    /**
     * @var string
     */
    private $basename;

    /**
     * @var string
     */
    private $extension;

    /**
     * @var string
     */
    private $filename;

    /**
     * @var string
     */
    private $path;

    /**
     * @var string
     */
    private $pathname;

    /**
     * @var string
     */
    private $realpath;

    /**
     * Constructor.
     *
     * @internal
     *
     * @param string $basename
     * @param string $extension
     * @param string $filename
     * @param string $path
     * @param string $pathname
     * @param string $realpath
     *
     */
    public function __construct($basename, $extension, $filename, $path, $pathname, $realpath)
    {
        $this->basename = $basename;
        $this->extension = $extension;
        $this->filename = $filename;
        $this->path = $path;
        $this->pathname = $pathname;
        $this->realpath = $realpath;
    }

    /**
     * Returns the base mame of the file (e.g. "example.jpg" for "/path/to/example.jpg").
     *
     * @return string
     */
    public function getBasename()
    {
        return $this->basename;
    }

    /**
     * Returns the extension of the file (e.g. "jpg" for "/path/to/example.jpg").
     *
     * @return string
     */
    public function getExtension()
    {
        return $this->extension;
    }

    /**
     * Returns the file name without path (e.g. "example.jpg" for "/path/to/example.jpg").
     *
     * @return string
     */
    public function getFilename()
    {
        return $this->filename;
    }

    /**
     * Returns the file name without path and extension (e.g. "example" for "/path/to/example.jpg").
     *
     * @return string
     */
    public function getFilenameWithoutExtension()
    {
        if ($this->extension === '') {
            return $this->filename;
        }

        return mb_substr($this->filename, 0, mb_strlen($this->filename) - mb_strlen($this->extension) - 1);
    }

    /**
     * Returns the path to the file (e.g. "/path/to" for "/path/to/example.jpg").
     *
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * Returns the file name including path (e.g. "/path/to/example.jpg" for "/path/to/example.jpg").
     *
     * @return string
     */
    public function getPathname()
    {
        return $this->pathname;
    }

    /**
     * Returns the absolute path to the file (e.g. "/path/to/example.jpg" for "/path/to/example.jpg").
     *
     * @return string
     */
    public function getRealPath()
    {
        return $this->realpath;
    }
}
