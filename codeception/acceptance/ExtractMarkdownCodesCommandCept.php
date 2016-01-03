<?php
/** @var \Codeception\Scenario $scenario */
$I = new AcceptanceTester($scenario);

$inputPath = __DIR__ . '/inputs';
$outputPath = __DIR__ . '/outputs';

$I->runShellCommand('rm -rf ' . $outputPath);
$I->runShellCommand('mkdir ' . $outputPath);

$I->runShellCommand('php extract_markdown_codes.php ' . $inputPath . ' list ' . $outputPath);

// assertions
$I->amInPath($outputPath);

// list1
(function () use ($I) {
    $I->openFile('list001.txt');
    $contents = <<<EOT
// list1
require_once __DIR__ . '/vendor/autoload.php';

\$foo = new Foo();
\$foo->execute();

EOT;
    $I->seeFileContentsEqual($contents);
})();

// list2
(function () use ($I) {
    $I->openFile('list002.txt');
    $contents = <<<EOT
// list2
\$i = 2;

EOT;
    $I->seeFileContentsEqual($contents);
})();

// list3
(function () use ($I) {
    $I->openFile('list003.txt');
    $contents = <<<EOT
// list3
\$i = 3;

EOT;
    $I->seeFileContentsEqual($contents);
})();

// list4
(function () use ($I) {
    $I->openFile('list004.txt');
    $contents = <<<EOT
// list4
\$i = 4;

EOT;
    $I->seeFileContentsEqual($contents);
})();

// list5
(function () use ($I) {
    $I->dontSeeFileFound('list005.txt');
})();
