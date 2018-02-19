<?php
/**
 * SerializationTypeMap.
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
 * Type mapping provider for data serialization filetypes.
 */
class SerializationTypeMap implements TypeMapInterface
{
    /**
     * {@inheritdoc}
     *
     * @see https://developer.mozilla.org/en-US/docs/Web/HTTP/Basics_of_HTTP/MIME_types/Complete_list_of_MIME_types
     */
    public function getMap()
    {
        return [
            new Type(['csv'], 'text/csv'),
            new Type(['json'], 'application/json'),
            new Type(['xml', 'xsd'], 'application/xml'),
            new Type(['xsl', 'xslt'], 'application/xslt+xml'),
            new Type(['yml', 'yaml'], 'text/yaml'),
        ];
    }
}
