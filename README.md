PHP Toolkit - Fileinfo
======================

This library provides features to read file information.

It provides an abstraction layer above SplFileInfo for consistent behavior and easier usage.
  * Ability to retrieve the file name without its extension
  * Human-readable file sizes
  * Usage of `DateTime` objects instead of Unix timestamps
  * Ability to retrieve the file owner/group (via posix_* functions)
  * Human-readable permissions

File information is read during construction of the FileInfo instance or when
`FileInfo::reload()` is called.

For easier dependency injection in projects, a simple `FileInfoFactory` is provided.

The current build status and code analysis can be found here:
  * [Scrutinizer CI](https://scrutinizer-ci.com/g/gmitirol/toolkit-fileinfo/)

Requirements
------------
* PHP 5.6.0 or higher
* PHP mbstring extension
* PHP posix extension

Installation
------------
The recommended way to install toolkit-fileinfo is via composer.
```json
"require": {
    "gmi/toolkit-fileinfo": "1.1.*"
}
```

Usage examples
--------------

```php
use Gmi\Toolkit\Fileinfo\FileInfo;

$fileInfo = new FileInfo('/path/to/awesome.pdf');

/**
 * Get information about file path:
 * @see Gmi\Toolkit\Fileinfo\Part\PathInfo
 */

$fileInfo->path()->getPath();
// '/path/to'

$fileInfo->path()->getFilename();
// 'awesome.pdf'

$fileInfo->path()->getFilenameWithoutExtension();
// 'awesome'

$fileInfo->path()->getExtension();
// 'pdf'

/**
 * Get information about file size:
 * @see Gmi\Toolkit\Fileinfo\Part\SizeInfo
 */

$fileInfo->size()->getSize();
// 34703

$fileInfo->size()->getSizeFormatted();
// '33.89 KiB'

/**
 * Get information about file dates:
 * @see Gmi\Toolkit\Fileinfo\Part\DateInfo
 */

$fileInfo->date()->getLastAccessed();
// object(DateTime)

$fileInfo->date()->getLastModified();
// object(DateTime)

/**
 * Get information about file permissions:
 * @see Gmi\Toolkit\Fileinfo\Part\PermissionInfo
 */

$fileInfo->perm()->getOwner();
// 0

$fileInfo->perm()->getOwnerName();
// 'root'

$fileInfo->perm()->getPermsFormatted();
// 'rw-r--r--'

/**
 * Get information about file type:
 * @see Gmi\Toolkit\Fileinfo\Part\TypeInfo
 */

$fileInfo->type()->getMimeType();
// 'application/pdf'

/**
 * Reload file information:
 */
$fileInfo->reload();

```

Tests
-----
The test suite can be run with `vendor/bin/phpunit tests`.
Tests are insulated by using a temporary directory per test.
