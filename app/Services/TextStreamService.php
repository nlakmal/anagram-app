<?php

namespace App\Services;

use Symfony\Component\HttpFoundation\StreamedResponse;

class TextStreamService
{
    private TextFileLineReadService $textFileLineReadService;

    public function __construct(TextFileLineReadService $textFileLineReadService)
    {
        $this->textFileLineReadService = $textFileLineReadService;
    }
    public function stream()
    {
        return response()->stream(
            function () {
                $this->textFileLineReadService->read();
            },
            200,
            [
                'Content-Type' => 'text/plain',
                'Content-Disposition' => 'inline;',
            ]
        );
    }
}
