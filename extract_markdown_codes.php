<?php
use Shin1x1\MarkdownCodeExtractor\CodePublisher;
use Shin1x1\MarkdownCodeExtractor\MarkdownCodeExtractor;
use Shin1x1\MarkdownCodeExtractor\MarkdownParser;
use Shin1x1\MarkdownCodeExtractor\MarkdownPathExtractor;

require_once __DIR__ . '/vendor/autoload.php';

if (count($argv) < 3) {
    echo "Usage: php " . basename(__FILE__) . " PATH PREFIX [OUTPUT_PATH]\n";
    die(255);
}

$srcBasePath = $argv[1];
$outputFileprefix = $argv[2];
$outputPath = $argv[3] ?? getcwd();

$pathExtractor = new MarkdownPathExtractor();

//$parser = (new MarkdownParser())->addFilter(function (string $code): string {
//    return preg_replace('/\(snip\)/', '(略)', $code);
//});
$parser = new MarkdownParser();

$publisher = new CodePublisher($outputPath, $outputFileprefix . '%03d.txt');

(new MarkdownCodeExtractor($pathExtractor, $parser, $publisher))->extractToFiles($srcBasePath);
