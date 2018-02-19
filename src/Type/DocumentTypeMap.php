<?php
/**
 * DocumentTypeMap.
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
 * Type mapping provider for general document filetypes.
 */
class DocumentTypeMap implements TypeMapInterface
{
    /**
     * {@inheritdoc}
     *
     * @see https://developer.mozilla.org/en-US/docs/Web/HTTP/Basics_of_HTTP/MIME_types/Complete_list_of_MIME_types
     * @see https://tools.ietf.org/html/rfc7763
     * @see https://www.iana.org/assignments/media-types/application/pdf
     * @see http://docutils.sourceforge.net/FAQ.html
     * @see https://www.thoughtco.com/mime-types-by-content-type-3469108
     */
    public function getMap()
    {
        return [
            new Type(['md'], 'text/markdown'),
            new Type(['pdf'], 'application/pdf'),
            new Type(['ps', 'eps'], 'application/postscript'),
            new Type(['rst'], 'text/x-rst'),
            new Type(['rtf'], 'application/rtf'),
            new Type(['tex'], 'text/x-tex'),
            new Type(['txt'], 'text/plain'),
        ];
    }
}
