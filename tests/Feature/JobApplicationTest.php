<?php

use App\Models\JobApplication;
use App\Models\User;
use App\Models\Cv;
use App\Models\CoverLetter;

test('unauthenticated users cannot access job applications', function () {
    $response = $this->get(route('job-applications.index'));
    $response->assertRedirect(route('login'));
});

test('user can view job applications index page', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->get(route('job-applications.index'));
    $response->assertStatus(200);
    $response->assertSee('Job Tracker');
});

test('user can view create job application form', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->get(route('job-applications.create'));
    $response->assertStatus(200);
    $response->assertSee('Tambah Data Lamaran Kerja');
});

test('user can create a job application', function () {
    $user = User::factory()->create();

    $cv = Cv::create([
        'user_id' => $user->id,
        'title' => 'Software Engineer CV',
        'template' => 'ATS Classic',
        'content' => 'Sample CV content',
    ]);

    $coverLetter = CoverLetter::create([
        'user_id' => $user->id,
        'title' => 'Cover Letter Google',
        'company' => 'Google Inc',
        'position' => 'Senior Backend Engineer',
        'content' => 'Dear Hiring Manager...',
    ]);

    $data = [
        'company_name' => 'Google Indonesia',
        'position' => 'Senior Backend Engineer',
        'location' => 'Jakarta (Hybrid)',
        'salary_offered' => 'Rp 30.000.000',
        'job_url' => 'https://careers.google.com/jobs/results/12345',
        'applied_date' => now()->toDateString(),
        'status' => 'applied',
        'cv_id' => $cv->id,
        'cover_letter_id' => $coverLetter->id,
        'notes' => 'Applied via Google Careers portal',
    ];

    $response = $this->actingAs($user)->post(route('job-applications.store'), $data);

    $response->assertRedirect(route('job-applications.index'));
    $this->assertDatabaseHas('job_applications', [
        'user_id' => $user->id,
        'company_name' => 'Google Indonesia',
        'position' => 'Senior Backend Engineer',
        'status' => 'applied',
    ]);
});

test('user can view detail of their job application', function () {
    $user = User::factory()->create();

    $application = JobApplication::create([
        'user_id' => $user->id,
        'company_name' => 'Tokopedia',
        'position' => 'Lead Developer',
        'applied_date' => now()->toDateString(),
        'status' => 'interview',
        'notes' => 'User interview scheduled',
    ]);

    $response = $this->actingAs($user)->get(route('job-applications.show', $application));
    $response->assertStatus(200);
    $response->assertSee('Tokopedia');
    $response->assertSee('Lead Developer');
    $response->assertSee('User interview scheduled');
});

test('user can update their job application', function () {
    $user = User::factory()->create();

    $application = JobApplication::create([
        'user_id' => $user->id,
        'company_name' => 'Shopee',
        'position' => 'Backend Engineer',
        'applied_date' => now()->toDateString(),
        'status' => 'applied',
    ]);

    $response = $this->actingAs($user)->put(route('job-applications.update', $application), [
        'company_name' => 'Shopee Indonesia',
        'position' => 'Senior Backend Engineer',
        'applied_date' => now()->toDateString(),
        'status' => 'interview',
        'notes' => 'HR interview completed, technical test next week',
    ]);

    $response->assertRedirect(route('job-applications.index'));
    $this->assertDatabaseHas('job_applications', [
        'id' => $application->id,
        'company_name' => 'Shopee Indonesia',
        'status' => 'interview',
        'notes' => 'HR interview completed, technical test next week',
    ]);
});

test('user can update status quickly via patch route', function () {
    $user = User::factory()->create();

    $application = JobApplication::create([
        'user_id' => $user->id,
        'company_name' => 'Traveloka',
        'position' => 'Fullstack Engineer',
        'applied_date' => now()->toDateString(),
        'status' => 'review',
    ]);

    $response = $this->actingAs($user)->patch(route('job-applications.update-status', $application), [
        'status' => 'offered',
    ]);

    $response->assertSessionHas('success');
    $this->assertDatabaseHas('job_applications', [
        'id' => $application->id,
        'status' => 'offered',
    ]);
});

test('user cannot view or update another users job application', function () {
    $user1 = User::factory()->create();
    $user2 = User::factory()->create();

    $application = JobApplication::create([
        'user_id' => $user1->id,
        'company_name' => 'Private Corp',
        'position' => 'Engineer',
        'applied_date' => now()->toDateString(),
        'status' => 'applied',
    ]);

    $response = $this->actingAs($user2)->get(route('job-applications.show', $application));
    $response->assertStatus(403);

    $response = $this->actingAs($user2)->put(route('job-applications.update', $application), [
        'company_name' => 'Hacked Corp',
        'position' => 'Hacker',
        'applied_date' => now()->toDateString(),
        'status' => 'offered',
    ]);
    $response->assertStatus(403);
});

test('user can delete their job application', function () {
    $user = User::factory()->create();

    $application = JobApplication::create([
        'user_id' => $user->id,
        'company_name' => 'Bukalapak',
        'position' => 'Frontend Engineer',
        'applied_date' => now()->toDateString(),
        'status' => 'rejected',
    ]);

    $response = $this->actingAs($user)->delete(route('job-applications.destroy', $application));
    $response->assertRedirect(route('job-applications.index'));

    $this->assertDatabaseMissing('job_applications', [
        'id' => $application->id,
    ]);
});
