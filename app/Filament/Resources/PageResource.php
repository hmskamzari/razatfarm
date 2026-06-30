<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PageResource\Pages\ListPages;
use App\Filament\Resources\PageResource\Pages\EditPage;
use App\Models\Page;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class PageResource extends Resource
{
    protected static ?string $model = Page::class;
    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-document-text';
    protected static string | \UnitEnum | null $navigationGroup = 'Site Content';
    protected static ?int $navigationSort = 1;

    public static function getModelLabel(): string
    {
        return __('cms.navigation.pages_label');
    }

    public static function getPluralModelLabel(): string
    {
        return __('cms.navigation.pages_plural');
    }

    public static function getNavigationGroup(): ?string
    {
        return __('cms.navigation.group');
    }

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make(__('cms.sections.page_info'))
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                TextInput::make('title.en')
                                    ->label(__('cms.fields.title_en'))
                                    ->required()
                                    ->maxLength(255),

                                TextInput::make('title.ar')
                                    ->label(__('cms.fields.title_ar'))
                                    ->required()
                                    ->maxLength(255),
                            ]),

                        TextInput::make('slug')
                            ->label(__('cms.fields.slug'))
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->maxLength(255),

                        Grid::make(2)
                            ->schema([
                                Textarea::make('meta_description.en')
                                    ->label(__('cms.fields.meta_description_en'))
                                    ->rows(2),

                                Textarea::make('meta_description.ar')
                                    ->label(__('cms.fields.meta_description_ar'))
                                    ->rows(2),
                            ]),

                        Toggle::make('is_published')
                            ->label(__('cms.fields.is_published'))
                            ->default(true),
                    ])
                    ->columns(1)
                    ->collapsible(),

                Section::make(__('cms.sections.page_sections'))
                    ->schema([
                        Repeater::make('sections')
                            ->relationship()
                            ->label(false)
                            ->schema([
                                Select::make('type')
                                    ->label(__('cms.fields.type'))
                                    ->options([
                                        'hero_slider' => 'Hero Slider',
                                        'intro' => 'Intro Text',
                                        'icon_features' => 'Icon Feature Strip',
                                        'content_block' => 'Content Block',
                                        'card_grid' => 'Card Grid',
                                        'stats' => 'Stats',
                                        'cta' => 'CTA Banner',
                                        'terms_list' => 'Terms / Numbered List',
                                    ])
                                    ->required()
                                    ->native(false),

                                Grid::make(2)
                                    ->schema([
                                        TextInput::make('heading.en')
                                            ->label(__('cms.fields.heading_en')),

                                        TextInput::make('heading.ar')
                                            ->label(__('cms.fields.heading_ar')),
                                    ]),

                                Grid::make(2)
                                    ->schema([
                                        RichEditor::make('body.en')
                                            ->label(__('cms.fields.body_en'))
                                            ->fileAttachmentsDisk('public'),

                                        RichEditor::make('body.ar')
                                            ->label(__('cms.fields.body_ar'))
                                            ->fileAttachmentsDisk('public'),
                                    ]),

                                FileUpload::make('image')
                                    ->label(__('cms.fields.image'))
                                    ->image()
                                    ->directory('cms')
                                    ->visibility('public')
                                    ->imageEditor(),

                                Repeater::make('items')
                                    ->relationship()
                                    ->label(__('cms.sections.section_items'))
                                    ->schema([
                                        FileUpload::make('image')
                                            ->label(__('cms.fields.image'))
                                            ->image()
                                            ->directory('cms')
                                            ->visibility('public')
                                            ->imageEditor(),

                                        Grid::make(2)
                                            ->schema([
                                                TextInput::make('heading.en')
                                                    ->label(__('cms.fields.heading_en')),

                                                TextInput::make('heading.ar')
                                                    ->label(__('cms.fields.heading_ar')),
                                            ]),

                                        Grid::make(2)
                                            ->schema([
                                                Textarea::make('body.en')
                                                    ->label(__('cms.fields.body_en'))
                                                    ->rows(3),

                                                Textarea::make('body.ar')
                                                    ->label(__('cms.fields.body_ar'))
                                                    ->rows(3),
                                            ]),

                                        Grid::make(3)
                                            ->schema([
                                                TextInput::make('value')
                                                    ->label(__('cms.fields.value')),

                                                TextInput::make('link_url')
                                                    ->label(__('cms.fields.link_url'))
                                                    ->url(),

                                                Grid::make(2)
                                                    ->schema([
                                                        TextInput::make('link_label.en')
                                                            ->label(__('cms.fields.link_label_en')),

                                                        TextInput::make('link_label.ar')
                                                            ->label(__('cms.fields.link_label_ar')),
                                                    ])
                                                    ->columnSpan(2),
                                            ]),
                                    ])
                                    ->collapsible()
                                    ->collapsed()
                                    ->itemLabel(fn (array $state): ?string => $state['heading']['en'] ?? $state['value'] ?? null)
                                    ->reorderable()
                                    ->orderColumn('sort_order')
                                    ->addActionLabel('+ Add Item'),
                            ])
                            ->collapsible()
                            ->collapsed()
                            ->itemLabel(fn (array $state): ?string => $state['heading']['en'] ?? $state['type'] ?? null)
                            ->reorderable()
                            ->orderColumn('sort_order')
                            ->addActionLabel('+ Add Section'),
                    ])
                    ->collapsible(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->label(__('cms.fields.title_en'))
                    ->formatStateUsing(fn ($record) => $record->getTranslation('title', 'en'))
                    ->searchable(),

                TextColumn::make('slug')
                    ->label(__('cms.fields.slug'))
                    ->badge(),

                TextColumn::make('sections_count')
                    ->label(__('cms.sections.page_sections'))
                    ->counts('sections'),

                IconColumn::make('is_published')
                    ->label(__('cms.fields.is_published'))
                    ->boolean(),

                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable(),
            ])
            ->recordActions([
                EditAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListPages::route('/'),
            'edit' => EditPage::route('/{record}/edit'),
        ];
    }
}
