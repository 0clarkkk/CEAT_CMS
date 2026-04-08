<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\View\View;

class PublicCurriculumController extends Controller
{
    /**
     * Display curriculum information.
     */
    public function index(): View
    {
        return view('public.academics.curriculum', [
            'title' => 'Curriculum',
        ]);
    }
}
