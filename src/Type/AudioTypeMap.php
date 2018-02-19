<?php
/**
 * AudioTypeMap.
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
 * Type mapping provider for audio filetypes.
 */
class AudioTypeMap implements TypeMapInterface
{
    /**
     * {@inheritdoc}
     *
     * @see https://developer.mozilla.org/en-US/docs/Web/HTTP/Basics_of_HTTP/MIME_types/Complete_list_of_MIME_types
     * @see https://www.loc.gov/preservation/digital/formats/fdd/fdd000198.shtml#sign
     */
    public function getMap()
    {
        return [
            new Type(['aac'], 'audio/aac'),
            new Type(['flac', 'fla'], 'audio/flac'),
            new Type(['mid', 'midi'], 'audio/midi'),
            new Type(['mp3'], 'audio/mpeg'),
            new Type(['oga'], 'audio/ogg'),
            new Type(['wav'], 'audio/x-wav'),
            new Type(['weba'], 'audio/webm'),
        ];
    }
}
