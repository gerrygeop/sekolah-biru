<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

// Homepage
Volt::route('/', 'home.index')->name('home');

// Profile Routes
Route::prefix('profil')->name('profile.')->group(function () {
    Volt::route('/visi-misi', 'profile.vision-mission')->name('vision-mission');
    Volt::route('/struktur-organisasi', 'profile.organization')->name('organization');
    Volt::route('/tenaga-pendidik', 'profile.staff')->name('staff');
    Volt::route('/fasilitas', 'profile.facilities')->name('facilities');
    Volt::route('/data-siswa', 'profile.student-statistics')->name('students');
});

// Graduates Routes
Route::prefix('lulusan')->name('graduates.')->group(function () {
    Volt::route('/prestasi', 'graduates.achievements.index')->name('achievements');
    Volt::route('/prestasi/{achievement:slug}', 'graduates.achievements.show')->name('achievements.show');
    Volt::route('/sebaran-alumni', 'graduates.alumni-distribution')->name('alumni-distribution');
    Volt::route('/data-alumni', 'graduates.alumni')->name('alumni');
});

// Virtual Class Routes
Route::prefix('kelas-virtual')->name('virtual-class.')->group(function () {
    Volt::route('/', 'virtual-class.index')->name('index');
    Volt::route('/{grade}', 'virtual-class.grade')->name('grade');
});

// Gallery Routes
Route::prefix('galeri')->name('gallery.')->group(function () {
    Volt::route('/foto', 'gallery.photos')->name('photos');
    Volt::route('/video', 'gallery.videos')->name('videos');
});

// News Routes
Route::prefix('berita')->name('news.')->group(function () {
    Volt::route('/', 'news.index')->name('index');
    Volt::route('/{news:slug}', 'news.show')->name('show');
});

// Contact Route
Volt::route('/kontak', 'contact.index')->name('contact');
