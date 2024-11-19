<?php

use App\Http\Controllers\LandingPageController;
use Illuminate\Support\Facades\Route;

Route::get('vendor/laravel-grapesjs/assets/blocks.js' , function (){
    return view('components');
});

Route::post("{landing_page:link}" , \App\Http\Controllers\Actions\StoreLandingPageFormSubmissionsController::class)->name("landing_pages.form");
Route::get('{link_for_campaign_or_landing}' , [LandingPageController::class ,'show'])->name('landing-page.show');


Route::middleware(['auth'])->group(function () {

    Route::get('landing-page-templates/{landing_page_template}/editor', [\App\Http\Controllers\LandingPageTemplateController::class ,'editor'])->name('landing-page-template.editor');
    Route::get('landing-page-templates/{landing_page_template}', [\App\Http\Controllers\LandingPageTemplateController::class ,'show'])->name('landing-page-template.show');

    Route::get('landing-page/{landing_page}/editor', [\App\Http\Controllers\LandingPageController::class ,'editor'])->name('landing-page.editor');
    Route::get('landing-page/{landing_page}/preview', [\App\Http\Controllers\LandingPageController::class, 'preview'])->name('landing-page.preview');
});
