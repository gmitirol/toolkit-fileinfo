<?php

use Sami\Sami;
use Sami\Parser\Filter\TrueFilter;
use Symfony\Component\Finder\Finder;

$iterator = Finder::create()
    ->files()
    ->name('*.php')
    ->in('src')
;

$sami =  new Sami($iterator, ['build_dir' => __DIR__ . '/build/doc']);
$sami['filter'] = new TrueFilter();

return $sami;
