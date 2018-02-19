<?php
/**
 * TypeMapInterface.
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
 * Interface for file type mapping providers.
 */
interface TypeMapInterface
{
    /**
     * Returns the file type mapping.
     *
     * @return Type[]
     */
    public function getMap();
}
