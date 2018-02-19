<?php
/**
 * ArchiveTypeMap.
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
 * Type mapping provider for archive filetypes.
 */
class ArchiveTypeMap implements TypeMapInterface
{
    /**
     * {@inheritdoc}
     *
     * @see https://developer.mozilla.org/en-US/docs/Web/HTTP/Basics_of_HTTP/MIME_types/Complete_list_of_MIME_types
     */
    public function getMap()
    {
        return [
            new Type(['7z'], 'application/x-7z-compressed'),
            new Type(['bz'], 'application/x-bzip'),
            new Type(['bz2'], 'application/x-bzip2'),
            new Type(['gz'], 'application/gzip'),
            new Type(['jar'], 'application/java-archive'),
            new Type(['rar'], 'application/x-rar-compressed'),
            new Type(['tar'], 'application/x-tar'),
            new Type(['zip'], 'application/zip'),
        ];
    }
}
