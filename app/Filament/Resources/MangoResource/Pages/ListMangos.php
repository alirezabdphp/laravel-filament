<?php

namespace App\Filament\Resources\MangoResource\Pages;

use App\Filament\Resources\MangoResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMangos extends ListRecords
{
    protected static string $resource = MangoResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
