<?php

namespace App\Filament\Resources;

use App\Filament\Resources\NewsEventResource\Pages;
use App\Models\NewsEvent;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class NewsEventResource extends Resource
{
    protected static ?string $model = NewsEvent::class;

    protected static ?string $navigationIcon = 'heroicon-o-newspaper';

    protected static ?string $navigationGroup = 'Content Management';

    protected static ?string $label = 'News & Event';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Basic Information')
                    ->description('News/event title and category')
                    ->schema([
                        Forms\Components\Select::make('department_id')
                            ->label('Department')
                            ->relationship('department', 'name')
                            ->required()
                            ->searchable(),
                        Forms\Components\TextInput::make('title')
                            ->label('Title')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('slug')
                            ->label('URL Slug')
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->maxLength(255)
                            ->generateFromFill('title'),
                        Forms\Components\Select::make('type')
                            ->label('Type')
                            ->options([
                                'news' => 'News',
                                'event' => 'Event',
                                'announcement' => 'Announcement',
                            ])
                            ->required(),
                    ])->columns(2),

                Forms\Components\Section::make('Content')
                    ->schema([
                        Forms\Components\Textarea::make('excerpt')
                            ->label('Excerpt')
                            ->rows(3)
                            ->maxLength(500)
                            ->columnSpanFull(),
                        Forms\Components\RichEditor::make('content')
                            ->label('Content')
                            ->columnSpanFull(),
                    ]),

                Forms\Components\Section::make('Event Details')
                    ->collapsible()
                    ->schema([
                        Forms\Components\DateTimePicker::make('event_date')
                            ->label('Event Date & Time'),
                        Forms\Components\TextInput::make('location')
                            ->label('Location')
                            ->maxLength(255),
                    ])->columns(2),

                Forms\Components\Section::make('Publishing')
                    ->schema([
                        Forms\Components\DateTimePicker::make('published_at')
                            ->label('Published Date')
                            ->helperText('Leave blank for draft'),
                        Forms\Components\Select::make('status')
                            ->label('Status')
                            ->options([
                                'draft' => 'Draft',
                                'published' => 'Published',
                                'archived' => 'Archived',
                            ])
                            ->required()
                            ->default('draft'),
                        Forms\Components\TextInput::make('featured_image')
                            ->label('Featured Image URL')
                            ->url()
                            ->maxLength(255),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label('Title')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('type')
                    ->label('Type')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'news' => 'info',
                        'event' => 'success',
                        'announcement' => 'warning',
                    }),
                Tables\Columns\TextColumn::make('department.code')
                    ->label('Department')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'draft' => 'gray',
                        'published' => 'success',
                        'archived' => 'danger',
                    }),
                Tables\Columns\TextColumn::make('published_at')
                    ->label('Published')
                    ->dateTime('M d, Y')
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('department')
                    ->relationship('department', 'name'),
                Tables\Filters\SelectFilter::make('type')
                    ->options([
                        'news' => 'News',
                        'event' => 'Event',
                        'announcement' => 'Announcement',
                    ]),
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'draft' => 'Draft',
                        'published' => 'Published',
                        'archived' => 'Archived',
                    ]),
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
            'index' => Pages\ListNewsEvents::route('/'),
            'create' => Pages\CreateNewsEvent::route('/create'),
            'edit' => Pages\EditNewsEvent::route('/{record}/edit'),
        ];
    }
}
