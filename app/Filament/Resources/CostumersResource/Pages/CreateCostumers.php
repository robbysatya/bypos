<?php

namespace App\Filament\Resources\CostumersResource\Pages;

use App\Filament\Resources\CostumersResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Http\RedirectResponse;

class CreateCostumers extends CreateRecord
{
    protected static string $resource = CostumersResource::class;

    protected function getRedirectUrl(): string
    {
        return static::getResource()::getUrl('index');
    }
}
