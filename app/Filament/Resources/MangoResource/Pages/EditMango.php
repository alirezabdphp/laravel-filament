<?php

namespace App\Filament\Resources\MangoResource\Pages;

use App\Filament\Resources\MangoResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMango extends EditRecord
{
    protected static string $resource = MangoResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
