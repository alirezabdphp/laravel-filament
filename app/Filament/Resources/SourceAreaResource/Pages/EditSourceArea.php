<?php

namespace App\Filament\Resources\SourceAreaResource\Pages;

use App\Filament\Resources\SourceAreaResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSourceArea extends EditRecord
{
    protected static string $resource = SourceAreaResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
