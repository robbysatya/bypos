<?php

namespace App\Filament\Resources\CostumersResource\Pages;

use App\Filament\Resources\CostumersResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCostumers extends ListRecords
{
    protected static string $resource = CostumersResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('New Costumer')
                ->icon('heroicon-o-plus')
                ->color('primary'),
        ];
    }
}
