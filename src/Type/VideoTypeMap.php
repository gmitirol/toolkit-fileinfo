<?php
/**
 * VideoTypeMap.
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
 * Type mapping provider for video filetypes.
 */
class VideoTypeMap implements TypeMapInterface
{
    /**
     * {@inheritdoc}
     *
     * @see https://developer.mozilla.org/en-US/docs/Web/HTTP/Basics_of_HTTP/MIME_types/Complete_list_of_MIME_types
     */
    public function getMap()
    {
        return [
            new Type(['3gp'], 'video/3gpp'),
            new Type(['3gp2'], 'video/3gpp2'),
            new Type(['avi'], 'video/x-msvideo'),
            new Type(['mp4'], 'video/mp4'),
            new Type(['mpg', 'mpeg'], 'video/mpeg'),
            new Type(['ogv'], 'video/ogg'),
            new Type(['webm'], 'video/webm'),
        ];
    }
}
