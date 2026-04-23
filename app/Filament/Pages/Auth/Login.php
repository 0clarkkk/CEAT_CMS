<?php

declare(strict_types=1);

namespace App\Filament\Pages\Auth;

use Filament\Pages\SimplePage;
use Illuminate\Contracts\Support\Htmlable;

class Login extends SimplePage
{
    protected static string $view = 'auth.login';

    public function getTitle(): string | Htmlable
    {
        return 'Admin Portal';
    }

    public function getHeading(): string | Htmlable
    {
        return 'Sign in to your account';
    }
}
