<?php

namespace app\Filament\Resources\LandingPageResource\Pages;

use app\Filament\Resources\LandingPageResource;
use App\Models\LandingPageTemplate;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class CreateLandingPage extends CreateRecord
{
    protected static string $resource = LandingPageResource::class;


    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['user_id']=Auth::id();


        if ($data['landing_page_template_id']){

            $landing_page_template= LandingPageTemplate::find($data['landing_page_template_id']);

            $data['gjs_data']=$landing_page_template->gjs_data;
            $data['header']=$landing_page_template->header;
            $data['footer']=$landing_page_template->footer;
            $data['js_files']=$landing_page_template->js_files;
            $data['css_files']=$landing_page_template->css_files;
        }
        return $data;
    }

    protected function afterCreate()
    {
        if ($this->data['landing_page_template_id']){
            $landing_page_template= LandingPageTemplate::find($this->data['landing_page_template_id']);

            foreach ($landing_page_template->css_files as $file)
                File::copy(Storage::disk('landing_pages_templates_files')->path($file),
                    Storage::disk('landing_pages_files')->path($file)
                );

            foreach ($landing_page_template->js_files as $file)
                File::copy(Storage::disk('landing_pages_templates_files')->path($file),
                    Storage::disk('landing_pages_files')->path($file)
                );

        }

    }
}
