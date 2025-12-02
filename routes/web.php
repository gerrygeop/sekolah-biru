<?php

use Illuminate\Support\Facades\Route;

// Homepage
Route::get('/', \App\Livewire\Home\Index::class)->name('home');

// Profile Routes
Route::prefix('profil')->name('profile.')->group(function () {
    Route::get('/visi-misi', \App\Livewire\Profile\VisionMission::class)->name('vision-mission');
    Route::get('/struktur-organisasi', \App\Livewire\Profile\Organization::class)->name('organization');
    Route::get('/tenaga-pendidik', \App\Livewire\Profile\Staff::class)->name('staff');
    Route::get('/fasilitas', \App\Livewire\Profile\Facilities::class)->name('facilities');
    Route::get('/data-siswa', \App\Livewire\Profile\StudentStatistics::class)->name('students');
});

// Graduates Routes
Route::prefix('lulusan')->name('graduates.')->group(function () {
    Route::get('/prestasi', \App\Livewire\Graduates\Achievements\Index::class)->name('achievements');
    Route::get('/prestasi/{achievement:slug}', \App\Livewire\Graduates\Achievements\Show::class)->name('achievements.show');
    Route::get('/sebaran-alumni', \App\Livewire\Graduates\AlumniDistribution::class)->name('alumni-distribution');
    Route::get('/data-alumni', \App\Livewire\Graduates\Alumni::class)->name('alumni');
});

// Virtual Class Routes
Route::prefix('kelas-virtual')->name('virtual-class.')->group(function () {
    Route::get('/', \App\Livewire\VirtualClass\Index::class)->name('index');
});

// Gallery Routes
Route::prefix('galeri')->name('gallery.')->group(function () {
    Route::get('/foto', \App\Livewire\Gallery\Photos::class)->name('photos');
    Route::get('/video', \App\Livewire\Gallery\Videos::class)->name('videos');
});

// News Routes
Route::prefix('berita')->name('news.')->group(function () {
    Route::get('/', \App\Livewire\News\Index::class)->name('index');
    Route::get('/{news:slug}', \App\Livewire\News\Show::class)->name('show');
});

// Contact Route
Route::get('/kontak', \App\Livewire\Contact\Index::class)->name('contact');
