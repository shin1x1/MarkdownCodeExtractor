<?php
namespace Shin1x1\MarkdownCodeExtractor;

use Pinq\Collection;

class MarkdownPathExtractor
{
    /**
     * @param string $basePath
     * @return Collection
     */
    public function extractPaths(string $basePath): Collection
    {
        if (is_dir($basePath)) {
            return Collection::from(glob($basePath . '/*.md'));
        } else {
            return Collection::from([$basePath]);
        }
    }
}
