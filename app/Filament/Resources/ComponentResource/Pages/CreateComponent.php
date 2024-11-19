<?php

namespace App\Filament\Resources\ComponentResource\Pages;

use App\Filament\Resources\ComponentResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class CreateComponent extends CreateRecord
{
    protected static string $resource = ComponentResource::class;


    protected function mutateFormDataBeforeCreate(array $data): array
    {

              $data['user_id'] = Auth::id();
        return $data;
    }

    protected function afterCreate(): void
    {
        $content=Str::of(file_get_contents( base_path('stubs/component.stub')))
            ->replace(["{{javascript}}","{{html}}","{{css}}","{{slug}}","{{name}}"],
                    [$this->data['js'],$this->data['html'],$this->data['css'],$this->data['slug'],$this->data['name']]);

        File::put(resource_path("/views/components/{$this->data['slug']}.blade.php"), $content);
    }
}
