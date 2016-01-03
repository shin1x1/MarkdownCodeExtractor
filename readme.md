# MarkdownCodeExtractor

[![Build Status](https://travis-ci.org/shin1x1/MarkdownCodeExtractor.svg?branch=master)](https://travis-ci.org/shin1x1/MarkdownCodeExtractor)

MarkdownCodeExtractor is a markdown code blocks extractor that reads from markdown files and publish to each file.

Requirements: PHP 7 or above

## Usage

```bash
$ git clone this_repo
$ cd this_repo
$ composer install
$ php extract_markdown_codes.php /path/to/markdown_files output_filename_prefix /path/to/output_dir
```

## Test

```bash
$ wget http://codeception.com/codecept.phar
$ make
php vendor/bin/phpunit
PHPUnit 4.8.21 by Sebastian Bergmann and contributors.

..

Time: 88 ms, Memory: 6.00Mb

OK (2 tests, 7 assertions)
php codecept.phar run
Codeception PHP Testing Framework v2.1.5
Powered by PHPUnit 4.8.21 by Sebastian Bergmann and contributors.

Acceptance Tests (1) --------------------------------------------------------------------------------
ExtractMarkdownCodesCommandCept                                                                Ok
-----------------------------------------------------------------------------------------------------


Time: 217 ms, Memory: 8.00Mb
```
