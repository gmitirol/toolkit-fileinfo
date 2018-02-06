<?php
/**
 * FileUnreadableException.
 *
 * @copyright 2018 Institute of Legal Medicine, Medical University of Innsbruck
 * @author Andreas Erhard <andreas.erhard@i-med.ac.at>
 * @license LGPL-3.0-only
 * @link http://www.gerichtsmedizin.at/
 *
 * @package fileinfo
 */
namespace Gmi\Toolkit\Fileinfo\Exception;

use Exception;

/**
 * This exception should be thrown if a file or file metadata is not readable.
 */
class FileUnreadableException extends Exception
{
}
