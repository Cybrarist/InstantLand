<?php

namespace App\Http\Controllers;

use App\Enums\StatusEnum;
use App\Http\Requests\StoreLandingPageRequest;
use App\Http\Requests\UpdateLandingPageRequest;
use App\Models\Campaign;
use App\Models\Company;
use App\Models\LandingPage;
use Dotlogics\Grapesjs\App\Traits\EditorTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Inertia\Inertia;

class LandingPageController extends Controller
{
    use EditorTrait;

    /**
     * Display the specified resource.
     */
    public function show(string $link_shared_between_campaigns_and_landing_pages)
    {

        //start by checking if campaign exists on that link
        $campaign=Campaign::where('link' , $link_shared_between_campaigns_and_landing_pages)
            ->where('status' , StatusEnum::Active)
            ->withWhereHas('landing_pages', function ($query){
                $query->where('status' , StatusEnum::Active);
            })
            ->first();

        $selected_landing_page=LandingPage::where('status', StatusEnum::Active)
            ->where('link' , $link_shared_between_campaigns_and_landing_pages)
            ->first();



        $random_value=random_int(1,100);

        // case 1 - prioritize campaign
        if ($campaign) {
            //case 2 - if campaign has single landing page
            if ($campaign->landing_pages->count() == 1)
                $selected_landing_page = $campaign->landing_pages[0];
            //case 3 - if campaign has multiple landing pages but ab testing is either empty or less than 100
            // we use equal chance for all.
            elseif ($campaign->landing_pages->sum('AB_testing') < 100) {
                $equal_chances = 100 / $campaign->landing_pages->count();
                foreach ($campaign->landing_pages as $index => $landing_page) {
                    $current_weight = ceil(($index + 1) * $equal_chances);
                    if ($current_weight >= $random_value)
                        $selected_landing_page = $landing_page;
                    break;
                }
            }
            //case 4 - if campaign has multiple landing pages with AB testing at least 100
            // then we use the weighted method
            else {
                $current_weight = 0;
                foreach ($campaign->landing_pages as $landing_page) {
                    $current_weight = ceil($landing_page->AB_testing + $current_weight);
                    if ($current_weight >= $random_value) {
                        $selected_landing_page = $landing_page;
                        break;
                    }
                }
            }
        }


        if ($selected_landing_page)
            return view('landing_page', ['landing_page'=>$selected_landing_page,]);
        else
            abort(404);
    }

    public function editor(Request $request, LandingPage $landing_page)
    {
        $style_files=[];

        foreach ($landing_page->css_files as $style)
            $style_files[]=asset("storage/landing_pages/$style");
        Config::set('laravel-grapesjs.canvas.styles' ,  $style_files);


        $script_files=[];

        foreach ($landing_page->js_files as $script)
            $script_files[]=asset("storage/landing_pages/$script");
        Config::set('laravel-grapesjs.canvas.scripts' ,  $script_files);


        return $this->show_gjs_editor($request, $landing_page);
    }

    public function preview(LandingPage $landing_page)
    {

        return view('landing_page', ['landing_page'=>$landing_page,]);

    }
}
