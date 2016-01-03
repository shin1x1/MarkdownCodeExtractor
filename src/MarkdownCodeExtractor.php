<?php
namespace Shin1x1\MarkdownCodeExtractor;

class MarkdownCodeExtractor
{
    /**
     * @var MarkdownParser
     */
    private $parser;

    /**
     * @var MarkdownPathExtractor
     */
    private $pathExtractor;

    /**
     * @var CodePublisher
     */
    private $publisher;

    /**
     * MarkdownCodeExtractor constructor.
     */
    public function __construct(
        MarkdownPathExtractor $pathExtractor,
        MarkdownParser $parser,
        CodePublisher $publisher
    )
    {
        $this->pathExtractor = $pathExtractor;
        $this->parser = $parser;
        $this->publisher = $publisher;
    }

    /**
     * @param string $basePath
     */
    public function extractToFiles(string $basePath)
    {
        $paths = $this->pathExtractor->extractPaths($basePath);
        array_walk($paths, function ($v) {
            $this->parser->extractCodes(file_get_contents($v));
        });

        $this->publisher->publish($this->parser->getCodes());
    }
}
