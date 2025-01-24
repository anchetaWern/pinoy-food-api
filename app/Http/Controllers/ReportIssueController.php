<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Issue;

class ReportIssueController extends Controller
{
    public function __invoke(Request $request)
    {
        Issue::create([
            'page' => $request->page,
            'params' => $request->params,
            'description' => $request->description,
        ]);

        return 'ok';
    }
}
