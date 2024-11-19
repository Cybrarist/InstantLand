<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLandingPageTemplateRequest;
use App\Http\Requests\UpdateLandingPageTemplateRequest;
use App\Models\LandingPage;
use App\Models\LandingPageTemplate;
use Dotlogics\Grapesjs\App\Traits\EditorTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

class LandingPageTemplateController
{
    use EditorTrait;

    public function editor(Request $request, LandingPageTemplate $landing_page_template)
    {
        $style_files=[];

        foreach ($landing_page_template->css_files as $style)
            $style_files[]=asset("storage/landing_pages/$style");
        Config::set('laravel-grapesjs.canvas.styles' ,  $style_files);


        $script_files=[];

        foreach ($landing_page_template->js_files as $script)
            $script_files[]=asset("storage/landing_pages/$script");
        Config::set('laravel-grapesjs.canvas.scripts' ,  $script_files);


        return $this->show_gjs_editor($request, $landing_page_template);
    }

    public function show(Request $request, LandingPageTemplate $landing_page_template)
    {

        return view('landing_page_template', [
            'landing_page'=>$landing_page_template
        ]);
    }
}
