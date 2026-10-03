<?php

use App\Http\Controllers\CertificationController;
use App\Http\Controllers\CoverLetterController;
use App\Http\Controllers\CvController;
use App\Http\Controllers\EducationController;
use App\Http\Controllers\ExperienceController;
use App\Http\Controllers\JobApplicationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\SkillController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('experiences', ExperienceController::class);
    Route::resource('education', EducationController::class);
    Route::resource('skills', SkillController::class);
    Route::resource('certifications', CertificationController::class);
    Route::resource('projects', ProjectController::class);
    Route::get('/cvs/{cv}/download-pdf', [CvController::class, 'downloadPdf'])->name('cvs.download.pdf');
    Route::get('/cvs/{cv}/preview-pdf', [CvController::class, 'previewPdf'])->name('cvs.preview.pdf');
    Route::resource('cvs', CvController::class);
    Route::get('/cover-letters/{coverLetter}/download-pdf', [CoverLetterController::class, 'downloadPdf'])->name('cover-letters.download.pdf');
    Route::get('/cover-letters/{coverLetter}/preview-pdf', [CoverLetterController::class, 'previewPdf'])->name('cover-letters.preview.pdf');
    Route::resource('cover-letters', CoverLetterController::class);
    Route::patch('job-applications/{jobApplication}/status', [JobApplicationController::class, 'updateStatus'])->name('job-applications.update-status');
    Route::resource('job-applications', JobApplicationController::class);
});

require __DIR__.'/auth.php';

