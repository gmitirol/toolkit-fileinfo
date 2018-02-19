<?php
/**
 * Simple extension-based MIME type guesser.
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
 * Guesses the MIME type for a file based on the file extension.
 */
class ExtensionMimeTypeGuesser
{
    /**
     * @var array Map of extensions to MIME types.
     */
    private $map;

    /**
     * @var string Fallback MIME type if it can't be determined via the extension.
     */
    private $fallbackType = 'application/octet-stream';

    /**
     * Constructor.
     *
     * @param TypeMapInterface[] $typeMaps
     */
    public function __construct(array $typeMaps = null)
    {
        if (null === $typeMaps) {
            $typeMaps = static::getDefaultTypeMaps();
        }

        $this->map = $this->buildMap($typeMaps);
    }

    /**
     * Returns the MIME type for a given file extension.
     * For unknown extensions, "application/octet-stream" is returned.
     *
     * @param string $extension
     *
     * @return string
     */
    public function guess($extension)
    {
        if (isset($this->map[$extension])) {
            return $this->map[$extension];
        }

        return $this->fallbackType;
    }

    /**
     * Returns the default type maps.
     *
     * @return TypeMapInterface[]
     */
    public static function getDefaultTypeMaps()
    {
        return [
            new DocumentTypeMap(),
            new ImageTypeMap(),
            new VideoTypeMap(),
            new AudioTypeMap(),
            new OpenDocumentTypeMap(),
            new MsOfficeTypeMap(),
            new SerializationTypeMap(),
            new ArchiveTypeMap(),
            new WebApplicationTypeMap(),
        ];
    }

    /**
     * Builds a lookup array from the type maps.
     *
     * @param TypeMapInterface[] $typeMaps
     *
     * @return array flat map array with the file extension as key and the MIME type as value
     */
    private function buildMap($typeMaps)
    {
        $map = [];

        $allTypeMaps = [];

        foreach ($typeMaps as $typeMap) {
            $allTypeMaps = array_merge($allTypeMaps, $typeMap->getMap());
        }

        foreach ($allTypeMaps as $type) {
            foreach ($type->getExtensions() as $extension) {
                $map[$extension] = $type->getMimeType();
            }
        }

        return $map;
    }
}
