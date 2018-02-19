<?php
/**
 * ImageTypeMap.
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
 * Type mapping provider for image filetypes.
 */
class ImageTypeMap implements TypeMapInterface
{
    /**
     * {@inheritdoc}
     *
     * @see https://developer.mozilla.org/en-US/docs/Web/HTTP/Basics_of_HTTP/MIME_types/Complete_list_of_MIME_types
     */
    public function getMap()
    {
        return [
            new Type(['bmp'], 'image/bmp'),
            new Type(['gif'], 'image/gif'),
            new Type(['ico'], 'image/x-icon'),
            new Type(['jpg', 'jpeg'], 'image/jpeg'),
            new Type(['png'], 'image/png'),
            new Type(['svg'], 'image/svg+xml'),
            new Type(['tif', 'tiff'], 'image/tiff'),
            new Type(['webp'], 'image/webp'),
        ];
    }
}
