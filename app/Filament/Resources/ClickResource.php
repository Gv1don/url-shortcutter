<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ClickResource\Pages;
use App\Models\Click;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Actions\ViewAction;

class ClickResource extends Resource
{
    protected static ?string $model = Click::class;

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-cursor-arrow-rays';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->schema([
                TextInput::make('ip_address')->disabled(),
                TextInput::make('user_agent')->disabled(),
                TextInput::make('created_at')->disabled(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('shortLink.short_code')
                    ->label('Short Code')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('ip_address')
                    ->searchable(),
                TextColumn::make('user_agent')
                    ->limit(40)
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('short_link')
                    ->relationship('shortLink', 'short_code'),
            ])
            ->actions([
                ViewAction::make(),
            ])
            ->bulkActions([]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListClicks::route('/'),
            'view' => Pages\ViewClick::route('/{record}'),
        ];
    }
}
