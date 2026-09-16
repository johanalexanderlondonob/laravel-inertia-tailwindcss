<?php

namespace App\Http\Controllers;

use App\Arketops\Process\ProcessRepository;
use Illuminate\Http\Request;

class ProcessController extends Controller
{
    protected ProcessRepository $processRepo;

    public function __construct(ProcessRepository $processRepository)
    {
        $this->processRepo = $processRepository;
    }

    public function all(Request $request, $ids)
    {
        dd($ids);
        if ($request->wantsJson()) {
            return response()->json($this->processRepo->getAll());
        }
    }
}
