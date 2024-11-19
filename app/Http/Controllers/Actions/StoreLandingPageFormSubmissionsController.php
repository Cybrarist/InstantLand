<?php

namespace App\Http\Controllers\Actions;

use App\Http\Controllers\Controller;
use App\Models\Campaign;
use App\Models\LandingPage;
use App\Models\Subscriber;
use Illuminate\Http\Request;

class StoreLandingPageFormSubmissionsController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request , LandingPage $landing_page )
    {
        $request->validate([
            'email'=>['required','email'],
        ]);


        $all_data=$request->except(["_token" , "email"]);

        $subscriber=Subscriber::updateOrCreate([
            'email'=>$request->email,
        ],[
            "data" => $all_data,
        ]);

        $landing_page->subscribers()->attach($subscriber->id);

        return back()->with('success' , 'Thank you for your submission!');

//        return view("Public.ThankYou" , [
//            "campaign" => $campaign,
//            "user_image" => ""
//        ]);
    }
}
