<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductsResource\Pages;
use App\Filament\Resources\ProductsResource\RelationManagers;
use App\Models\Products;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\TextArea;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use App\Models\Categories;
use App\Models\User;
use App\Models\Costumers;

use App\Models\Products as ProductsModel;

class ProductsResource extends Resource
{
    protected static ?string $model = Products::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('sku')
                    ->label('SKU')
                    ->required()
                    ->maxLength(50)
                    ->unique(ignorable: fn (?Products $record) => $record),
                TextInput::make('barcode')
                    ->label('Barcode')
                    ->required()
                    ->maxLength(50)
                    ->unique(ignorable: fn (?Products $record) => $record),
                TextInput::make('name')
                    ->label('Product Name')
                    ->required()
                    ->maxLength(255),
                Select::make('category_id')
                    ->label('Category')
                    ->relationship('category', 'name')
                    ->required()
                    ->searchable()
                    ->preload(),
                TextInput::make('cost_price')
                    ->label('Cost Price')
                    ->required()
                    ->numeric()
                    ->maxLength(20),
                TextInput::make('sale_price')
                    ->label('Sale Price')
                    ->required()
                    ->numeric()
                    ->maxLength(20),
                Select::make('costumer_id')
                    ->label('Customer')
                    ->relationship('costumer', 'name')
                    ->required()
                    ->searchable()
                    ->preload(),
                Select::make('user_id')
                    ->label('User')
                    ->relationship('user', 'name')
                    ->required()
                    ->searchable()
                    ->preload(),
                TextInput::make('stock')
                    ->label('Stock')
                    ->required()
                    ->numeric()
                    ->maxLength(20),
                TextArea::make('description')
                    ->label('Description')
                    ->maxLength(500)
                    ->nullable(),
                FileUpload::make('image')
                    ->disk('s3')
                    ->label('Product Image')
                    ->image()
                    ->directory('products')
                    ->visibility('public')
                    ->columnSpan('full')
                    ->nullable()
                    ->maxSize(1024) // 1MB
                    ->acceptedFileTypes(['image/*'])
                    ->preserveFilenames()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('index')
                    ->label('No.')
                    ->rowIndex(),
                TextColumn::make('sku')
                    ->label('SKU')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('barcode')
                    ->label('Barcode')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('name')
                    ->label('Product Name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('description')
                    ->label('Description')
                    ->limit(50)
                    ->toggleable()
                    ->searchable()
                    ->sortable(),
                TextColumn::make('image')
                    ->label('Image')
                    ->formatStateUsing(fn ($state) => $state ? '<img src="' . asset('storage/' . $state) . '" alt="Product Image" class="w-16 h-16 object-cover">' : 'No Image')
                    ->html()
                    ->searchable()
                    ->sortable(),
                TextColumn::make('cost_price')
                    ->label('Cost Price')
                    ->money('IDR', true)
                    ->searchable()
                    ->sortable(),
                TextColumn::make('sale_price')
                    ->label('Sale Price')
                    ->money('IDR', true)
                    ->sortable(),
                TextColumn::make('stock')
                    ->label('Stock')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('category.name')
                    ->label('Category')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('costumer.name')
                    ->label('Customer')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('created_at')
                    ->label('Created At')
                    ->dateTime('d M Y')
                    ->sortable(),
                TextColumn::make('user.name')
                    ->label('Created By')
                    ->searchable()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                EditAction::make()
                    ->button(),
                DeleteAction::make()
                    ->button(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
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
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProducts::route('/create'),
            'edit' => Pages\EditProducts::route('/{record}/edit'),
        ];
    }
}
