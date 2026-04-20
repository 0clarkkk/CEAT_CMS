<?php

use App\Models\User;
use App\Models\FacultyMember;

it('allows authenticated faculty users to access dashboard', function () {
    $facultyMember = FacultyMember::factory()->create();
    
    $user = User::factory()->create([
        'role' => 'faculty',
        'faculty_member_id' => $facultyMember->id,
    ]);

    $response = $this->actingAs($user)->get(route('faculty.dashboard'));

    $response->assertStatus(200);
    $response->assertViewIs('faculty.dashboard.index');
});

it('shows dashboard button with faculty redirect on home page', function () {
    $facultyMember = FacultyMember::factory()->create();
    
    $user = User::factory()->create([
        'role' => 'faculty',
        'faculty_member_id' => $facultyMember->id,
    ]);

    $response = $this->actingAs($user)->get(route('home'));

    $response->assertStatus(200);
    $response->assertSee(route('faculty.dashboard'));
});

it('shows logout button on home page when authenticated', function () {
    $user = User::factory()->create(['role' => 'faculty']);

    $response = $this->actingAs($user)->get(route('home'));

    $response->assertStatus(200);
    $response->assertSee('Logout');
});

it('redirects unauthenticated users to login for faculty dashboard', function () {
    $response = $this->get(route('faculty.dashboard'));

    $response->assertRedirectToRoute('login');
});
