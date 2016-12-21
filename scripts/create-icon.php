#!/usr/bin/env php
<?php
/**
 * (c) 2016 Ruben Schmidmeister
 */
namespace Timetabio
{
    use Timetabio\Framework\Dom;

    require __DIR__ . '/../Framework/bootstrap.php';

    $source = new Dom\Document;
    $source->loadXML(file_get_contents('php://stdin'));

    $target = new Dom\Document;
    $target->formatOutput = true;
    $target->preserveWhiteSpace = false;

    foreach ($source->query('//*[@id]') as $node) {
        $node->removeAttribute('id');
    }

    $root = $target->appendChild($target->createElement('svg'));
    $root->setAttribute('xmlns', 'http://www.w3.org/2000/svg');

    $symbol = $root->appendChild($target->createElement('symbol'));
    $symbol->setAttribute('id', 'icon');
    $symbol->setAttribute('viewBox', '0 0 128 128');

    $title = $symbol->appendChild($target->createElement('title'));
    $title->appendText($argv[1]);

    $source->getXpath()->registerNamespace('svg', 'http://www.w3.org/2000/svg');

    $topGroup = $source->queryOne('//svg:g');

    $symbol->appendChild($target->importNode($topGroup, true));

    $output = $target->saveXML($root);

    echo str_replace('#000000', 'currentColor', $output);
}
