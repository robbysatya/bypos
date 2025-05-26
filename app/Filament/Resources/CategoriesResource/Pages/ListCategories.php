<?php

namespace App\Filament\Resources\CategoriesResource\Pages;

use App\Filament\Resources\CategoriesResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Resources\Components\Tab;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\DeleteAction;

class ListCategories extends ListRecords
{
    protected static string $resource = CategoriesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
    // public function table(Table $table): Table
    // {
    //     return $table
    //         ->columns([
    //             TextColumn::make('index')
    //                 ->label('No.')
    //                 ->rowIndex(),
    //             TextColumn::make('name')
    //                 ->label('Category Name')
    //                 ->searchable()
    //                 ->sortable(),
    //         ])
            
    //         ->actions([
    //             EditAction::make(),
    //             DeleteAction::make(),
    //         ]);
    // }
}
