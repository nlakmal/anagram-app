<?php

namespace Tests\Unit\Actions;

use App\Actions\AnagramCheckAction;
use PHPUnit\Framework\TestCase;

class AnagramCheckActionTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_when_empty_data_should_return_empty_array(): void
    {
        $anagramCheckAction = new AnagramCheckAction('cat');
        $response = $anagramCheckAction->process([]);
        $this->assertEmpty($response);
    }

    public function test_when_no_anagram_word_should_return_empty_array(): void
    {
        $anagramCheckAction = new AnagramCheckAction('cat');
        $response = $anagramCheckAction->process([
            'dog',
            'cap',
            'hat'
        ]);
        $this->assertEmpty($response);
    }
    public function test_when_empty_given_word_should_return_empty_array(): void
    {
        $anagramCheckAction = new AnagramCheckAction('');
        $response = $anagramCheckAction->process([
            'cat',
            'cap',
            'hat'
        ]);
        $this->assertEmpty($response);
    }
    public function test_when_has_anagram_word_should_return_array(): void
    {
        $anagramCheckAction = new AnagramCheckAction('cat');
        $response = $anagramCheckAction->process([
            'cat',
            'tac',
            'hat'
        ]);
        $this->assertIsArray($response);
        $this->assertEquals([
            'cat',
            'tac'
        ],$response);
    }
}
