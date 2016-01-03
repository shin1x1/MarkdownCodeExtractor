<?php
namespace Shin1x1\MarkdownCodeExtractor;

/**
 * Class CodePublisher
 * @package Shin1x1\ExtractMarkdownCodes
 */
class CodePublisher
{
    /**
     * @var string
     */
    private $outputPath;

    /**
     * @var string
     */
    private $outputFilePattern;

    /**
     * CodePublisher constructor.
     * @param string $outputPath
     * @param string $outputFilePattern
     */
    public function __construct(string $outputPath, string $outputFilePattern = 'list%d.txt')
    {
        $this->outputPath = $outputPath;
        $this->outputFilePattern = $outputFilePattern;
    }

    /**
     * @param CodeBlockCollection $codes
     */
    public function publish(CodeBlockCollection $codes)
    {
        system('rm -rf ' . $this->outputPath . '/*');
        if (!is_dir($this->outputPath)) {
            mkdir($this->outputPath);
        }

        $codes->apply(function ($value, $key) {
            file_put_contents(sprintf('%s/' . $this->outputFilePattern, $this->outputPath, $key + 1), $value);
        });
    }
}