<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MangoResource\Pages;
use App\Filament\Resources\MangoResource\RelationManagers;
use App\Models\Mango;
use Carbon\Carbon;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\Filter;

class MangoResource extends Resource
{
    protected static ?string $model = Mango::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')->required(),
                Select::make('source_area_id')->relationship('sourceArea', 'name')->required(),

                DatePicker::make('buy_date')->required(),
                TextInput::make('total_kg')->numeric()->required(),
                TextInput::make('buying_price')->numeric()->required(),
                TextInput::make('selling_price')->numeric()->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->sortable(),
                TextColumn::make('name')->sortable(),
                TextColumn::make('sourceArea.name')->sortable(),
                TextColumn::make('buy_date')->sortable(),
                TextColumn::make('total_kg'),
                TextColumn::make('buying_price'),
                TextColumn::make('selling_price'),
            ])
            ->filters([
                Filter::make('buy_date')
                    ->form([
                        Forms\Components\DatePicker::make('created_from'),
                        Forms\Components\DatePicker::make('created_until'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['created_from'],
                                fn (Builder $query, $date): Builder => $query->whereDate('buy_date', '>=', $date),
                            )
                            ->when(
                                $data['created_until'],
                                fn (Builder $query, $date): Builder => $query->whereDate('buy_date', '<=', $date),
                            );
                    }),

                SelectFilter::make('source_area_id')->relationship('sourceArea', 'name')
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMangos::route('/'),
            'create' => Pages\CreateMango::route('/create'),
            'edit' => Pages\EditMango::route('/{record}/edit'),
        ];
    }
}
