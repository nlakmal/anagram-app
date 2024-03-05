<?php

namespace App\Services;

use App\Actions\AnagramCheckAction;
use Symfony\Component\HttpFoundation\StreamedResponse;

class AnagramsService
{
    public function find(string $word): StreamedResponse
    {
        $filePath = storage_path().'/dictionary/anagram.txt';
        ini_set('memory_limit', '1024M');

        $textStreamService = new TextStreamService(
            new TextFileLineReadService(
                new AnagramCheckAction($word),
                $filePath,
                1024 * 1024 * 1024
            )
        );
        return $textStreamService->stream();
    }
}
