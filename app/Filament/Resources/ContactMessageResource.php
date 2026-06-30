<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ContactMessageResource\Pages\ListContactMessages;
use App\Models\ContactMessage;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\ViewAction;
use Filament\Infolists\Components\TextEntry;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ContactMessageResource extends Resource
{
    protected static ?string $model = ContactMessage::class;
    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-envelope';
    protected static string | \UnitEnum | null $navigationGroup = 'Site Content';
    protected static ?int $navigationSort = 3;

    public static function getModelLabel(): string
    {
        return __('cms.navigation.messages_label');
    }

    public static function getNavigationGroup(): ?string
    {
        return __('cms.navigation.group');
    }

    public static function getNavigationBadge(): ?string
    {
        $count = static::getModel()::where('is_read', false)->count();
        return $count > 0 ? (string) $count : null;
    }

    public static function infolist(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('name')->label(__('cms.messages.name')),
                TextEntry::make('email')->label(__('cms.messages.email')),
                TextEntry::make('phone')->label(__('cms.messages.phone')),
                TextEntry::make('message')->label(__('cms.messages.message'))->columnSpanFull(),
                TextEntry::make('created_at')->label(__('cms.messages.submitted_at'))->dateTime(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                IconColumn::make('is_read')
                    ->label(__('cms.messages.is_read'))
                    ->boolean(),

                TextColumn::make('name')
                    ->label(__('cms.messages.name'))
                    ->searchable(),

                TextColumn::make('email')
                    ->label(__('cms.messages.email'))
                    ->searchable(),

                TextColumn::make('phone')
                    ->label(__('cms.messages.phone')),

                TextColumn::make('message')
                    ->label(__('cms.messages.message'))
                    ->limit(60),

                TextColumn::make('created_at')
                    ->label(__('cms.messages.submitted_at'))
                    ->dateTime()
                    ->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->recordActions([
                ViewAction::make()
                    ->after(function (ContactMessage $record) {
                        $record->update(['is_read' => true]);
                    }),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListContactMessages::route('/'),
        ];
    }
}
