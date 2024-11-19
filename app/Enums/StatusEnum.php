<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum StatusEnum: string implements HasLabel
{
    case Active ="active";

    case Pending="pending";
    case Scheduled="scheduled";

    case Finished="finished";

    public function getLabel(): ?string
    {
        return $this->name;
    }

    public static function get_badge($value): string
    {
        return match ($value){
            self::Active =>"success",
            self::Finished=>"danger",
            self::Pending=>"warning",
            self::Scheduled=>"info",
        };
    }
}
