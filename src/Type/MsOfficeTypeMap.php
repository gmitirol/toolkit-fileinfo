<?php
/**
 * MsOfficeTypeMap.
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
 * Type mapping provider for Microsoft Office filetypes.
 */
class MsOfficeTypeMap implements TypeMapInterface
{
    /**
     * {@inheritdoc}
     *
     * @see https://technet.microsoft.com/en-us/library/ee309278(office.12).aspx
     * @see https://blogs.msdn.microsoft.com/vsofficedeveloper/2008/05/08/office-2007-file-format-mime-types-for-http-content-streaming-2/
     * @see https://www.askingbox.com/info/mime-types-of-microsoft-office-file-formats
     */
    public function getMap()
    {
        return [
            new Type(['doc', 'dot'], 'application/msword'),
            new Type(['docx'], 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'),
            new Type(['dotx'], 'application/vnd.openxmlformats-officedocument.wordprocessingml.template'),
            new Type(['docm'], 'application/vnd.ms-word.document.macroEnabled.12'),
            new Type(['dotm'], 'application/vnd.ms-word.template.macroEnabled.12'),

            new Type(['xls', 'xlt', 'xla'], 'application/vnd.ms-excel'),
            new Type(['xlsx'], 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'),
            new Type(['xltx'], 'application/vnd.openxmlformats-officedocument.spreadsheetml.template'),
            new Type(['xlsm'], 'application/vnd.ms-excel.sheet.macroEnabled.12'),
            new Type(['xltm'], 'application/vnd.ms-excel.template.macroEnabled.12'),
            new Type(['xlam'], 'application/vnd.ms-excel.addin.macroEnabled.12'),
            new Type(['xlsb'], 'application/vnd.ms-excel.sheet.binary.macroEnabled.12'),

            new Type(['ppt','pot', 'pps', 'ppa'], 'application/vnd.ms-powerpoint'),
            new Type(['pptx'], 'application/vnd.openxmlformats-officedocument.presentationml.presentation'),
            new Type(['potx'], 'application/vnd.openxmlformats-officedocument.presentationml.template'),
            new Type(['ppsx'], 'application/vnd.openxmlformats-officedocument.presentationml.slideshow'),
            new Type(['ppam'], 'application/vnd.ms-powerpoint.addin.macroEnabled.12'),
            new Type(['pptm'], 'application/vnd.ms-powerpoint.presentation.macroEnabled.12'),
            new Type(['potm'], 'application/vnd.ms-powerpoint.template.macroEnabled.12'),
            new Type(['ppsm'], 'application/vnd.ms-powerpoint.slideshow.macroEnabled.12'),

            new Type(['mdb', 'ade', 'adp', 'adn', 'mde', 'mdf', 'mdn', 'mdt', 'mdw'], 'application/vnd.ms-access'),
            new Type(['accda', 'accdb', 'accde', 'accdr', 'accdt'], 'application/vnd.ms-access'),
        ];
    }
}
