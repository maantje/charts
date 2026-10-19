<?php

/*
|--------------------------------------------------------------------------
| Test Case
|--------------------------------------------------------------------------
|
| The closure you provide to your test functions is always bound to a specific PHPUnit test
| case class. By default, that class is "PHPUnit\Framework\TestCase". Of course, you may
| need to change it using the "uses()" function to bind a different classes or traits.
|
*/

// uses(Tests\TestCase::class)->in('Feature');

function pretty(string $svg): string
{
    $dom = new \DOMDocument;

    $dom->preserveWhiteSpace = false;
    $dom->formatOutput = true;

    $dom->loadXML($svg, LIBXML_NOBLANKS);

    return $dom->saveXML($dom->documentElement) ?: '';
}
