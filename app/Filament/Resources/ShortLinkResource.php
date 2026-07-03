<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ShortLinkResource\Pages;
use App\Models\ShortLink;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\BulkActionGroup;

class ShortLinkResource extends Resource
{
    protected static ?string $model = ShortLink::class;

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-link';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->schema([
                TextInput::make('short_code')
                    ->label('Short Code')
                    ->disabled()
                    ->dehydrated(false),
                TextInput::make('original_url')
                    ->label('Original URL')
                    ->disabled()
                    ->dehydrated(false),
                TextInput::make('clicks_count')
                    ->label('Clicks')
                    ->disabled()
                    ->dehydrated(false),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('short_code')
                    ->searchable()
                    ->copyable()
                    ->copyMessage('Copied!'),
                TextColumn::make('original_url')
                    ->limit(40)
                    ->searchable(),
                TextColumn::make('user.name')
                    ->label('User')
                    ->sortable(),
                TextColumn::make('clicks_count')
                    ->sortable()
                    ->label('Clicks'),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('user')
                    ->relationship('user', 'name'),
            ])
            ->actions([
                ViewAction::make(),
                DeleteAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListShortLinks::route('/'),
            'view' => Pages\ViewShortLink::route('/{record}'),
        ];
    }
}
