<?php

namespace App\Http\Controllers;

use App\Services\AnagramsService;

class AnagramsController extends Controller
{
    private AnagramsService $anagramsService;

    public function __construct(AnagramsService $anagramsService)
    {
        $this->anagramsService = $anagramsService;
    }

    public function index()
    {
        return $this->anagramsService->find('cat');
    }
}
