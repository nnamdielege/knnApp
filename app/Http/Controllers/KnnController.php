<?php

namespace App\Http\Controllers;

use App\Classes\KnnClass;
use Illuminate\Http\Request;

class KnnController extends Controller
{
    protected $knnService;

    public function __construct(KnnClass $knnService)
    {
        $this->knnService = $knnService;
    }

    public function classify(Request $request)
    {
        $request->validate([
            'x' => 'required|numeric',
            'y' => 'required|numeric',
            'k' => 'required|integer|min:1',
        ]);

        $x = $request->input('x');
        $y = $request->input('y');
        $k = $request->input('k');

        $classification = $this->knnService->classify($x, $y, $k);

        return response()->json(['class' => $classification]);
    }

    public function crossValidate(Request $request)
    {
        $request->validate([
            'kValues' => 'required|array',
            'kValues.*' => 'integer|min:1',
            'numFolds' => 'integer|min:2|max:10',
        ]);

        $kValues = $request->input('kValues');
        $numFolds = $request->input('numFolds', 5);

        $results = $this->knnService->crossValidate($kValues, $numFolds);

        return response()->json($results);
    }
}
