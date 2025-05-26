<?php

namespace App\Filament\Resources\CategoriesResource\Pages;

use App\Filament\Resources\CategoriesResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Http\RedirectResponse;

class CreateCategories extends CreateRecord
{
    protected static string $resource = CategoriesResource::class;  

    protected function getRedirectUrl(): string
    {
        return static::getResource()::getUrl('index');
    }
}
