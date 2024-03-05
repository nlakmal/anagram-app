<?php

namespace Tests\Unit\Services;

use App\Actions\AnagramCheckAction;
use App\Services\TextFileLineReadService;
use PHPUnit\Framework\TestCase;

class TextFileLineReadServiceTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_when_empty_file_path_should_return_null(): void
    {
        ob_start();
        $textFileLineReadService = new TextFileLineReadService(
            new AnagramCheckAction('cat'),
            ''
        );
        $textFileLineReadService->read();
        $output = ob_get_clean();
        $this->assertEquals('File not found',$output);
    }

    public function test_when_empty_file_should_return_null(): void
    {
        ob_start();
        $textFileLineReadService = new TextFileLineReadService(
            new AnagramCheckAction('cat'),
            __DIR__.'/../data/anagram.txt'
        );
        $textFileLineReadService->read();
        $output = ob_get_clean();
        $this->assertEquals('[]', $output);
    }

    public function test_when_file_has_anagram_should_return_json(): void
    {
        ob_start();
        $textFileLineReadService = new TextFileLineReadService(
            new AnagramCheckAction('cat'),
            __DIR__.'/../data/anagram_with_data.txt'
        );
        $textFileLineReadService->read();
        $output = ob_get_clean();
        $this->assertEquals('["cat","tca","act"]', $output);
    }

    public function test_when_file_no_anagram_should_return_empty_json(): void
    {
        ob_start();
        $textFileLineReadService = new TextFileLineReadService(
            new AnagramCheckAction('cat'),
            __DIR__.'/../data/no_anagram.txt'
        );
        $textFileLineReadService->read();
        $output = ob_get_clean();
        $this->assertEquals('[]', $output);
    }
}
