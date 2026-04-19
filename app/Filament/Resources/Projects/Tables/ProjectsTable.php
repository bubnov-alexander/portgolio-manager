<?php

namespace App\Filament\Resources\Projects\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;

class ProjectsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->defaultSort('sort')
            ->reorderable('sort')
            ->columns([
                SpatieMediaLibraryImageColumn::make('cover')
                    ->label('Обложка')
                    ->collection('cover')
                    ->square(),
                TextColumn::make('title')
                    ->label('Название')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('slug')
                    ->label('Слаг')
                    ->searchable()
                    ->sortable(),
                IconColumn::make('is_published')
                    ->label('Опубликован')
                    ->boolean()
                    ->sortable(),
                TextColumn::make('sort')
                    ->label('Порядок')
                    ->sortable(),
                TextColumn::make('technologies_count')
                    ->label('Технологий')
                    ->counts('technologies')
                    ->sortable(),
                TextColumn::make('created_at')
                    ->label('Создан')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                TernaryFilter::make('is_published')
                    ->label('Опубликован'),
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
