<?php

namespace App\Filament\Pages;

use App\Settings\ProfileSettings;
use BackedEnum;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Pages\SettingsPage;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use UnitEnum;

class ManageProfileSettings extends SettingsPage
{
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedUserCircle;

    protected static ?string $navigationLabel = 'Профиль';

    protected static string|UnitEnum|null $navigationGroup = 'Настройки';

    protected static ?int $navigationSort = 10;

    protected static string $settings = ProfileSettings::class;

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('full_name')
                    ->label('Полное имя')
                    ->required(),
                TextInput::make('nickname')
                    ->label('Никнейм')
                    ->required(),
                TextInput::make('job_title')
                    ->label('Должность')
                    ->required(),
                Textarea::make('short_bio')
                    ->label('Краткое био')
                    ->required()
                    ->rows(3),
                Textarea::make('full_bio')
                    ->label('Полное био')
                    ->rows(6),
                TextInput::make('location')
                    ->label('Локация'),
                TextInput::make('status')
                    ->label('Статус'),
                Toggle::make('is_available_for_work')
                    ->label('Доступен для работы')
                    ->inline(false)
                    ->required(),
            ]);
    }
}
