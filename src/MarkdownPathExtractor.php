<?php
namespace Shin1x1\MarkdownCodeExtractor;

class MarkdownPathExtractor
{
    /**
     * @param string $basePath
     * @return array
     */
    public function extractPaths(string $basePath): array
    {
        if (is_dir($basePath)) {
            return glob($basePath . '/*.md');
        } else {
            return [$basePath];
        }
    }
}
