<?php
/**
 * WebApplicationTypeMap.
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
 * Type mapping provider for (client-side) web application filetypes.
 */
class WebApplicationTypeMap implements TypeMapInterface
{
    /**
     * {@inheritdoc}
     */
    public function getMap()
    {
        return [
            new Type(['css'], 'text/css'),
            new Type(['html', 'htm'], 'text/html'),
            new Type(['js'], 'application/javascript'),
            new Type(['swf'], 'application/x-shockwave-flash'),
            new Type(['xhtml'], 'application/xhtml+xml'),
        ];
    }
}
