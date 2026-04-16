<?php

use App\Models\User;

it('faculty with advisor capability cannot access the admin panel', function () {
    $advisor = User::factory()->create([
        'role' => 'faculty',
        'email' => 'advisor@test.edu',
    ]);

    $response = $this->actingAs($advisor)->get('/admin');

    $response->assertStatus(403);
});

it('student cannot access the admin panel', function () {
    $student = User::factory()->create([
        'role' => 'student',
        'email' => 'student@test.edu',
    ]);

    $response = $this->actingAs($student)->get('/admin');

    $response->assertStatus(403);
});

it('faculty cannot access the admin panel', function () {
    $faculty = User::factory()->create([
        'role' => 'faculty',
        'email' => 'faculty@test.edu',
    ]);

    $response = $this->actingAs($faculty)->get('/admin');

    $response->assertStatus(403);
});

it('admin can access the admin panel', function () {
    $admin = User::factory()->create([
        'role' => 'admin',
        'email' => 'admin@test.edu',
    ]);

    $response = $this->actingAs($admin)->get('/admin');

    // Should NOT get 403 (may be 200 or redirect to dashboard)
    expect($response->getStatusCode())->not->toBe(403);
});

it('superadmin can access the admin panel', function () {
    $superadmin = User::factory()->create([
        'role' => 'superadmin',
        'email' => 'superadmin@test.edu',
    ]);

    $response = $this->actingAs($superadmin)->get('/admin');

    // Should NOT get 403 (may be 200 or redirect to dashboard)
    expect($response->getStatusCode())->not->toBe(403);
});

it('unauthenticated user is redirected to login', function () {
    $response = $this->get('/admin');

    $response->assertRedirect('/login');
});
