<?php
namespace Shin1x1\MarkdownCodeExtractor;

use Pinq\Collection;

class MarkdownParser
{
    /**
     * @var CodeBlockCollection
     */
    private $codes;

    /**
     * @var Collection
     */
    private $filters;

    /**
     * MarkdownCodeExtractor constructor.
     */
    public function __construct()
    {
        $this->codes = new CodeBlockCollection();
        $this->filters = new Collection();
    }

    /**
     * @param string $markdown
     */
    public function extractCodes(string $markdown)
    {
        $lines = explode("\n", $markdown);
        $code = '';
        $isCodeBlock = false;

        foreach ($lines as $line) {
            $line = rtrim($line);
            if (preg_match('/^```/', $line)) {
                if ($isCodeBlock) {
                    $this->codes[] = $this->applyFilters($code);
                    $code = '';
                    $isCodeBlock = false;
                } else {
                    $isCodeBlock = true;
                }

                continue;
            }

            if (!$isCodeBlock) {
                continue;
            }

            $code .= $line . "\n";
        }
    }

    /**
     * @return CodeBlockCollection
     */
    public function getCodes(): CodeBlockCollection
    {
        return $this->codes;
    }

    /**
     * @param string $code
     * @return string
     */
    private function applyFilters(string $code): string
    {
        $this->filters->apply(function ($filter) use (&$code) {
            $code = $filter($code);
        });

        return $code;
    }

    /**
     * @param callable $filter
     * @return static
     */
    public function addFilter(callable $filter): MarkdownParser
    {
        $this->filters[] = $filter;
        return $this;
    }
}
