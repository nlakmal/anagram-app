<?php

namespace App\Actions;

class AnagramCheckAction implements ActionInterface
{
    public function __construct(string $word = '')
    {
        $this->word = $word;
    }
    public function process(array $data): array
    {
        return array_filter($data, function($dictionaryWord) {
            return count_chars($this->word, 1) == count_chars(trim($dictionaryWord), 1);
        }, ARRAY_FILTER_USE_BOTH);
    }
}
