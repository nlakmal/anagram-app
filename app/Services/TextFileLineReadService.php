<?php

namespace App\Services;

use App\Actions\ActionInterface;

class TextFileLineReadService
{
    private ActionInterface $action;
    private string $filePath;

    public function __construct(ActionInterface $action, string $filePath, int $memoryLimit = 1024 * 1024 * 1024)
    {
        $this->action = $action;
        $this->filePath = $filePath;
        $this->memoryLimit = $memoryLimit;
    }

    public function read(): void
    {
        $file = fopen($this->filePath, 'r');
        $words=[];
        while (($line = fgets($file)) !== false) {
            $words[] = trim($line);
            if (memory_get_usage() >= $this->memoryLimit) {
                $this->process($words);
                ob_flush();
                flush();
                $words = [];
            }
        }
        $this->process($words);
    }

    private function process(array $words): void
    {
        if (!empty($words)) {
            $response = $this->action->process($words);
            echo json_encode($response);
        }
    }
}
