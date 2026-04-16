<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ResearchCenterResource\Pages;
use App\Models\ResearchCenter;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ResearchCenterResource extends Resource
{
    protected static ?string $model = ResearchCenter::class;

    protected static ?string $navigationIcon = 'heroicon-o-beaker';

    protected static ?string $navigationGroup = 'Content Management';

    protected static ?string $navigationLabel = 'Research';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Research Center Information')
                    ->schema([
                        Forms\Components\Select::make('department_id')
                            ->label('Department')
                            ->relationship('department', 'name')
                            ->required()
                            ->searchable(),
                        Forms\Components\TextInput::make('name')
                            ->label('Research Title')
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true),
                        Forms\Components\TextInput::make('slug')
                            ->label('URL Slug')
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->maxLength(255)
                            ->helperText('Auto-generated from title'),
                    ])->columns(2),

                Forms\Components\Section::make('Contact & Researchers')
                    ->description('Add contact information and manage researchers for this center.')
                    ->schema([
                        Forms\Components\TextInput::make('contact_email')
                            ->label('Center Contact Email')
                            ->email()
                            ->maxLength(255)
                            ->placeholder('Email (optional)')
                            ->columnSpanFull(),

                        Forms\Components\Repeater::make('researchers')
                            ->label('Researchers')
                            ->relationship('researchers')
                            ->schema([
                                Forms\Components\TextInput::make('name')
                                    ->label('Researcher Name')
                                    ->maxLength(255),
                                Forms\Components\TextInput::make('email')
                                    ->label('Email')
                                    ->email()
                                    ->maxLength(255)
                                    ->placeholder('Email (optional)'),
                            ])
                            ->columns(2)
                            ->collapsible()
                            ->collapsed(false)
                            ->minItems(1)
                            ->afterStateHydrated(function ($component, $state) {
                                if (empty($state)) {
                                    $component->state([['name' => '', 'email' => '']]);
                                }
                            })
                            ->columnSpanFull()
                            ->addActionLabel('Add researcher')
                            ->helperText('Add researcher names and emails (email is optional)'),
                    ]),

                Forms\Components\Section::make('Description & Focus Areas')
                    ->schema([
                        Forms\Components\RichEditor::make('description')
                            ->label('Description')
                            ->columnSpanFull(),
                        Forms\Components\Repeater::make('research_areas')
                            ->label('Research Areas')
                            ->schema([
                                Forms\Components\TextInput::make('area')
                                    ->label('Research Area')
                                    ->maxLength(255),
                                Forms\Components\TextInput::make('description')
                                    ->label('Description')
                                    ->maxLength(255),
                            ])
                            ->columns(2)
                            ->collapsible()
                            ->collapsed(false)
                            ->minItems(1)
                            ->afterStateHydrated(function ($component, $state) {
                                if (empty($state)) {
                                    $component->state([['area' => '', 'description' => '']]);
                                }
                            })
                            ->addActionLabel('Add research area')
                            ->columnSpanFull(),
                        Forms\Components\Textarea::make('facilities')
                            ->label('Facilities & Equipment')
                            ->rows(4)
                            ->columnSpanFull(),
                    ]),

                Forms\Components\Section::make('Gallery & Media')
                    ->description('Add photos and videos to the gallery.')
                    ->schema([
                        Forms\Components\FileUpload::make('thumbnail_photo')
                            ->label('Thumbnail Photo')
                            ->disk('public')
                            ->image()
                            ->directory('research/thumbnails')
                            ->maxSize(5120)
                            ->previewable(false)
                            ->helperText('Recommended size: 500x300px - This appears in research cards and featured section')
                            ->columnSpanFull(),

                        Forms\Components\FileUpload::make('gallery')
                            ->label('Gallery Photos & Videos')
                            ->disk('public')
                            ->directory('research/gallery')
                            ->maxSize(51200)
                            ->multiple()
                            ->previewable(false)
                            ->acceptedFileTypes([
                                'image/jpeg',
                                'image/png',
                                'image/gif',
                                'image/webp',
                                'image/tiff',
                                'image/bmp',
                                'image/svg+xml',
                                'video/mp4',
                                'video/webm',
                                'video/ogg',
                            ])
                            ->helperText('Max 50MB each - Photos (JPG, PNG, GIF, WEBP, TIFF, BMP, SVG) or Videos (MP4, WEBM, OGG)')
                            ->columnSpanFull(),
                    ]),

                Forms\Components\Section::make('Featured On Homepage')
                    ->description('Configure this research center to appear on the homepage featured section.')
                    ->schema([
                        Forms\Components\Toggle::make('is_featured')
                            ->label('Feature on Homepage')
                            ->default(false)
                            ->live(onBlur: true)
                            ->columnSpanFull(),
                        Forms\Components\TextInput::make('featured_order')
                            ->label('Display Order')
                            ->numeric()
                            ->default(0)
                            ->helperText('Lower numbers appear first')
                            ->hidden(fn (Forms\Get $get) => !$get('is_featured')),
                        Forms\Components\Textarea::make('featured_description')
                            ->label('Featured Description')
                            ->rows(4)
                            ->maxLength(300)
                            ->helperText('Short description shown on homepage - max 300 characters (optional)')
                            ->columnSpanFull()
                            ->hidden(fn (Forms\Get $get) => !$get('is_featured')),
                    ])->columns(2),

                Forms\Components\View::make('filament.resources.featured-image-preview'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\IconColumn::make('is_featured')
                    ->label('Featured')
                    ->boolean()
                    ->sortable(),
                Tables\Columns\TextColumn::make('name')
                    ->label('Center Name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('department.name')
                    ->label('Department')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('director')
                    ->label('Director')
                    ->searchable(),
                Tables\Columns\TextColumn::make('contact_email')
                    ->label('Email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Created')
                    ->dateTime('M d, Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('department')
                    ->relationship('department', 'name'),
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
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
            'index' => Pages\ListResearchCenters::route('/'),
            'create' => Pages\CreateResearchCenter::route('/create'),
            'edit' => Pages\EditResearchCenter::route('/{record}/edit'),
        ];
    }
}
