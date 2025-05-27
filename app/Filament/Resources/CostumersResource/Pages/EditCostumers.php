<?php

namespace App\Filament\Resources\CostumersResource\Pages;

use App\Filament\Resources\CostumersResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Http\RedirectResponse;

class EditCostumers extends EditRecord
{
    protected static string $resource = CostumersResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return static::getResource()::getUrl('index');
    }
}
