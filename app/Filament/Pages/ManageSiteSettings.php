<?php

namespace App\Filament\Pages;

use App\Models\SiteSetting;
use BezhanSalleh\FilamentShield\Traits\HasPageShield;
use Filament\Actions\Action;
use Filament\Forms\Components\KeyValue;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ManageSiteSettings extends Page implements HasForms
{
    use InteractsWithForms;
    use HasPageShield;

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-cog-6-tooth';
    protected static string | \UnitEnum | null $navigationGroup = 'Site Content';
    protected static ?int $navigationSort = 2;

    protected string $view = 'filament.pages.manage-site-settings';

    public ?array $data = [];

    public static function getNavigationLabel(): string
    {
        return __('cms.navigation.settings_label');
    }

    public function getTitle(): string
    {
        return __('cms.settings.title');
    }

    public function mount(): void
    {
        $this->form->fill(SiteSetting::current()->toArray());
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make(__('cms.settings.contact_section'))
                    ->schema([
                        Grid::make(3)
                            ->schema([
                                TextInput::make('phone_primary')->label(__('cms.settings.phone_primary')),
                                TextInput::make('phone_secondary')->label(__('cms.settings.phone_secondary')),
                                TextInput::make('phone_tertiary')->label(__('cms.settings.phone_tertiary')),
                            ]),

                        TextInput::make('email')
                            ->label(__('cms.settings.email'))
                            ->email(),

                        Grid::make(2)
                            ->schema([
                                Textarea::make('address.en')
                                    ->label(__('cms.settings.address_en'))
                                    ->rows(3),

                                Textarea::make('address.ar')
                                    ->label(__('cms.settings.address_ar'))
                                    ->rows(3),
                            ]),
                    ])
                    ->columns(1),

                Section::make(__('cms.settings.hours_section'))
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                TextInput::make('visit_hours.en')->label(__('cms.settings.visit_hours_en')),
                                TextInput::make('visit_hours.ar')->label(__('cms.settings.visit_hours_ar')),
                            ]),

                        Grid::make(2)
                            ->schema([
                                TextInput::make('support_hours.en')->label(__('cms.settings.support_hours_en')),
                                TextInput::make('support_hours.ar')->label(__('cms.settings.support_hours_ar')),
                            ]),
                    ])
                    ->columns(1),

                Section::make(__('cms.settings.footer_section'))
                    ->schema([
                        TextInput::make('map_embed_url')
                            ->label(__('cms.settings.map_embed_url'))
                            ->url()
                            ->columnSpanFull(),

                        Grid::make(2)
                            ->schema([
                                TextInput::make('footer_copyright.en')->label(__('cms.settings.footer_copyright_en')),
                                TextInput::make('footer_copyright.ar')->label(__('cms.settings.footer_copyright_ar')),
                            ]),

                        KeyValue::make('social_links')
                            ->label('Social Links')
                            ->keyLabel('Platform')
                            ->valueLabel('URL'),
                    ])
                    ->columns(1),
            ])
            ->statePath('data');
    }

    public function save(): void
    {
        $setting = SiteSetting::current();
        $setting->update($this->form->getState());

        Notification::make()
            ->title(__('cms.settings.saved'))
            ->success()
            ->send();
    }

    protected function getHeaderActions(): array
    {
        return [
            Action::make('save')
                ->label(__('filament-panels::resources/pages/edit-record.form.actions.save.label'))
                ->submit('save'),
        ];
    }
}
