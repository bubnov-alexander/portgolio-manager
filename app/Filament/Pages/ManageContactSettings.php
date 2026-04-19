<?php

namespace App\Filament\Pages;

use App\Settings\ContactSettings;
use BackedEnum;
use Filament\Forms\Components\TextInput;
use Filament\Pages\SettingsPage;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use UnitEnum;

class ManageContactSettings extends SettingsPage
{
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedEnvelope;

    protected static ?string $navigationLabel = 'Контакты';

    protected static string|UnitEnum|null $navigationGroup = 'Настройки';

    protected static ?int $navigationSort = 11;

    protected static string $settings = ContactSettings::class;

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('email')
                    ->label('Электронная почта')
                    ->email()
                    ->required(),
                TextInput::make('phone')
                    ->label('Телефон')
                    ->tel(),
                TextInput::make('telegram')
                    ->label('Telegram'),
                TextInput::make('github_url')
                    ->label('Ссылка GitHub')
                    ->url(),
                TextInput::make('website_url')
                    ->label('Ссылка на сайт')
                    ->url(),
            ]);
    }
}
