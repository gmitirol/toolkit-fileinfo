<?php
/**
 * OpenDocumentTypeMap.
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
 * Type mapping provider for OpenDocument (OpenOffice, LibreOffice, ...) filetypes.
 */
class OpenDocumentTypeMap implements TypeMapInterface
{
    /**
     * {@inheritdoc}
     *
     * @see https://wiki.documentfoundation.org/Faq/General/036
     */
    public function getMap()
    {
        return [
            new Type(['odt'], 'application/vnd.oasis.opendocument.text'),
            new Type(['ott'], 'application/vnd.oasis.opendocument.text-template'),
            new Type(['oth'], 'application/vnd.oasis.opendocument.text-web'),
            new Type(['odm'], 'application/vnd.oasis.opendocument.text-master'),
            new Type(['ods'], 'application/vnd.oasis.opendocument.spreadsheet'),
            new Type(['ots'], 'application/vnd.oasis.opendocument.spreadsheet-template'),
            new Type(['odc'], 'application/vnd.oasis.opendocument.chart'),
            new Type(['odp'], 'application/vnd.oasis.opendocument.presentation'),
            new Type(['otp'], 'application/vnd.oasis.opendocument.presentation-template'),
            new Type(['odg'], 'application/vnd.oasis.opendocument.graphics'),
            new Type(['otg'], 'application/vnd.oasis.opendocument.graphics-template'),
            new Type(['odf'], 'application/vnd.oasis.opendocument.formula'),
            new Type(['odb'], 'application/vnd.oasis.opendocument.database'),
            new Type(['odi'], 'application/vnd.oasis.opendocument.image'),
        ];
    }
}
