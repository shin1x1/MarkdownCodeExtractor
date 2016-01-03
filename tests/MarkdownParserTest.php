<?php
namespace Shin1x1\MarkdownCodeExtractor\Test;

use PHPUnit_Framework_TestCase;
use Shin1x1\MarkdownCodeExtractor\MarkdownParser;

class MarkdownParserTest extends PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function extractCodes()
    {
        $markdown = <<<EOT
# Level1

## Level2

* list1-1
```
\$i = 1;
var_dump(\$i);
```

* list1-2

```
\$i = 2;
```

```
\$i = 3;
```
EOT;
        $sut = new MarkdownParser();
        $sut->extractCodes($markdown);

        $actual = $sut->getCodes();
        $this->assertCount(3, $actual);

        $this->assertSame("\$i = 1;\nvar_dump(\$i);\n", $actual[0]);
        $this->assertSame("\$i = 2;\n", $actual[1]);
        $this->assertSame("\$i = 3;\n", $actual[2]);
    }

    /**
     * @test
     */
    public function extractCodesWithFilters()
    {
        $markdown = <<<EOT
(snip)

* list1-1
```
\$i = 1;
(snip)
```

* list1-2

```
// (snip)
%TITLE%
```
EOT;
        $sut = (new MarkdownParser())->addFilter(function (string $code): string {
            return preg_replace('/\(snip\)/', '(略)', $code);
        })->addFilter(function (string $code): string {
            return preg_replace('/%TITLE%/', 'my book', $code);
        });
        $sut->extractCodes($markdown);

        $actual = $sut->getCodes();
        $this->assertCount(2, $actual);

        $this->assertSame("\$i = 1;\n(略)\n", $actual[0]);
        $this->assertSame("// (略)\nmy book\n", $actual[1]);
    }
}
