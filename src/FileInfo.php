<?php
/**
 * File information retriever.
 *
 * @copyright 2018 Institute of Legal Medicine, Medical University of Innsbruck
 * @author Andreas Erhard <andreas.erhard@i-med.ac.at>
 * @license LGPL-3.0-only
 * @link http://www.gerichtsmedizin.at/
 *
 * @package fileinfo
 */
namespace Gmi\Toolkit\Fileinfo;

use Gmi\Toolkit\Fileinfo\Exception\FileUnreadableException;
use Gmi\Toolkit\Fileinfo\Exception\UnavailableException;
use Gmi\Toolkit\Fileinfo\Part\DateInfo;
use Gmi\Toolkit\Fileinfo\Part\DateInfoFactory;
use Gmi\Toolkit\Fileinfo\Part\PathInfo;
use Gmi\Toolkit\Fileinfo\Part\PathInfoFactory;
use Gmi\Toolkit\Fileinfo\Part\PermissionInfo;
use Gmi\Toolkit\Fileinfo\Part\PermissionInfoFactory;
use Gmi\Toolkit\Fileinfo\Part\SizeInfo;
use Gmi\Toolkit\Fileinfo\Part\SizeInfoFactory;
use Gmi\Toolkit\Fileinfo\Part\TypeInfo;
use Gmi\Toolkit\Fileinfo\Part\TypeInfoFactory;

use SplFileInfo;

/**
 * Retrieves information about file metadata.
 *
 * Instances of this class and file information value objects are immutable.
 * File metadata is read once in the constructor and can be limited there.
 */
class FileInfo
{
    const INFO_NONE = 0;
    const INFO_PATH = 1;
    const INFO_SIZE = 2;
    const INFO_DATE = 4;
    const INFO_PERMISSION = 8;
    const INFO_TYPE = 16;
    const INFO_ALL = 65535;

    /**
     * @var string
     */
    private $file;

    /**
     * @var int
     */
    private $infoParts;

    /**
     * @var PathInfo
     */
    private $pathInfo;

    /**
     * @var PathInfoFactory
     */
    private $pathInfoFactory;

    /**
     * @var SizeInfo
     */
    private $sizeInfo;

    /**
     * @var SizeInfoFactory
     */
    private $sizeInfoFactory;

    /**
     * @var DateInfo
     */
    private $dateInfo;

    /**
     * @var DateInfoFactory
     */
    private $dateInfoFactory;

    /**
     * @var PermissionInfo
     */
    private $permissionInfo;

    /**
     * @var PermissionInfoFactory
     */
    private $permissionInfoFactory;

    /**
     * @var TypeInfo
     */
    private $typeInfo;

    /**
     * @var TypeInfoFactory
     */
    private $typeInfoFactory;

    /**
     * Constructor.
     *
     * @param string                $file                  Path and filename of the file.
     * @param int                   $infoParts             Bitmask of INFO_* constants.
     *                                                     Parts which are not in the provided bitmask will not
     *                                                     be analyzed, so the getters for them will
     *                                                     throw an UnavailableException.
     * @param PathInfoFactory       $pathInfoFactory       Factory for path information value objects.
     * @param SizeInfoFactory       $sizeInfoFactory       Factory for size information value objects.
     * @param DateInfoFactory       $dateInfoFactory       Factory for date information value objects.
     * @param PermissionInfoFactory $permissionInfoFactory Factory for permission information value objects.
     * @param TypeInfoFactory       $typeInfoFactory       Factory for type information value objects.
     *
     * @throws FileUnreadableException
     */
    public function __construct(
        $file,
        $infoParts = self::INFO_ALL,
        PathInfoFactory $pathInfoFactory = null,
        SizeInfoFactory $sizeInfoFactory = null,
        DateInfoFactory $dateInfoFactory = null,
        PermissionInfoFactory $permissionInfoFactory = null,
        TypeInfoFactory $typeInfoFactory = null
    ) {
        $this->file = $file;
        $this->infoParts = $infoParts;

        $this->pathInfoFactory = $pathInfoFactory ?: new PathInfoFactory();
        $this->sizeInfoFactory = $sizeInfoFactory ?: new SizeInfoFactory();
        $this->dateInfoFactory = $dateInfoFactory ?: new DateInfoFactory();
        $this->permissionInfoFactory = $permissionInfoFactory ?: new PermissionInfoFactory();
        $this->typeInfoFactory = $typeInfoFactory ?: new TypeInfoFactory();

        $this->reloadFileInformation();
    }

    /**
     * Reloads the file infos.
     *
     * @param int $infoParts During reload, different or more info parts can be retrieved.
     *                       If $infoParts is null, the previous value is used.
     *
     * @return self
     */
    public function reload($infoParts = null)
    {
        $this->reloadFileInformation($infoParts);

        return $this;
    }

    /**
     * Returns the path information.
     *
     * @return PathInfo
     *
     * @throws UnavailableException
     */
    public function getPathInfo()
    {
        if (null === $this->pathInfo) {
            throw new UnavailableException('Path information is not available!');
        }

        return $this->pathInfo;
    }

    /**
     * Alias for getPathInfo().
     */
    public function path()
    {
        return $this->getPathInfo();
    }

    /**
     * Returns the size information.
     *
     * @return SizeInfo
     *
     * @throws UnavailableException
     */
    public function getSizeInfo()
    {
        if (null === $this->sizeInfo) {
            throw new UnavailableException('Size information is not available!');
        }

        return $this->sizeInfo;
    }

    /**
     * Alias for getSizeInfo().
     */
    public function size()
    {
        return $this->getSizeInfo();
    }

    /**
     * Returns the size information.
     *
     * @return DateInfo
     *
     * @throws UnavailableException
     */
    public function getDateInfo()
    {
        if (null === $this->dateInfo) {
            throw new UnavailableException('Date information is not available!');
        }

        return $this->dateInfo;
    }

    /**
     * Alias for getDateInfo().
     */
    public function date()
    {
        return $this->getDateInfo();
    }

    /**
     * Returns the permission information.
     *
     * @return PermissionInfo
     *
     * @throws UnavailableException
     */
    public function getPermissionInfo()
    {
        if (null === $this->permissionInfo) {
            throw new UnavailableException('Permission information is not available!');
        }

        return $this->permissionInfo;
    }

    /**
     * Alias for getPermissionInfo().
     */
    public function perm()
    {
        return $this->getPermissionInfo();
    }

    /**
     * Returns the type information.
     *
     * @return TypeInfo
     *
     * @throws UnavailableException
     */
    public function getTypeInfo()
    {
        if (null === $this->typeInfo) {
            throw new UnavailableException('Type information is not available!');
        }

        return $this->typeInfo;
    }

    /**
     * Alias for getTypeInfo().
     */
    public function type()
    {
        return $this->getTypeInfo();
    }

    /**
     * Reloads the file infos.
     *
     * @param int $infoParts
     *
     * @throws FileUnreadableException
     */
    private function reloadFileInformation($infoParts = null)
    {
        if (null !== $infoParts) {
            $this->infoParts = $infoParts;
        }

        clearstatcache(true, $this->file);

        if (!is_readable($this->file)) {
            throw new FileUnreadableException(sprintf('File "%s" can not be read!', $this->file));
        }

        $fileInfo = new SplFileInfo($this->file);

        if ($this->infoParts & self::INFO_PATH) {
            $this->pathInfo = $this->pathInfoFactory->create($fileInfo);
        }

        if ($this->infoParts & self::INFO_SIZE) {
            $this->sizeInfo = $this->sizeInfoFactory->create($fileInfo);
        }

        if ($this->infoParts & self::INFO_DATE) {
            $this->dateInfo = $this->dateInfoFactory->create($fileInfo);
        }

        if ($this->infoParts & self::INFO_PERMISSION) {
            $this->permissionInfo = $this->permissionInfoFactory->create($fileInfo);
        }

        if ($this->infoParts & self::INFO_TYPE) {
            $this->typeInfo = $this->typeInfoFactory->create($fileInfo);
        }
    }
}
