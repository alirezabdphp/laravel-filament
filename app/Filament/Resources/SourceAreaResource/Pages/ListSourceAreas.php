<?php

namespace App\Filament\Resources\SourceAreaResource\Pages;

use App\Filament\Resources\SourceAreaResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSourceAreas extends ListRecords
{
    protected static string $resource = SourceAreaResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
