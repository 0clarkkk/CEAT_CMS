<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\View\View;

class PublicAboutController extends Controller
{
    /**
     * Display the about page with college history.
     */
    public function index(): View
    {
        return view('public.about.index');
    }

    /**
     * Display the college information page.
     */
    public function college(): View
    {
        return view('public.about.college', [
            'title' => 'The College',
        ]);
    }

    /**
     * Display the college history timeline.
     */
    public function history(): View
    {
        return view('public.about.history', [
            'title' => 'College History',
        ]);
    }

    /**
     * Display the mission and vision page.
     */
    public function mission(): View
    {
        return view('public.about.mission', [
            'title' => 'Mission & Vision',
        ]);
    }

    /**
     * Display student rules and regulations.
     */
    public function rules(): View
    {
        return view('public.student.rules', [
            'title' => 'Rules & Regulations',
        ]);
    }

    /**
     * Display student downloadables.
     */
    public function downloads(): View
    {
        return view('public.student.downloads', [
            'title' => 'Downloadables',
        ]);
    }
}
