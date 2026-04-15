<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DownloadableFormResource\Pages;
use App\Filament\Resources\DownloadableFormResource\RelationManagers;
use App\Models\DownloadableForm;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class DownloadableFormResource extends Resource
{
    protected static ?string $model = DownloadableForm::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static ?string $navigationLabel = 'Downloadable Forms';

    protected static ?string $modelLabel = 'Form';

    protected static ?int $navigationSort = 11;

    protected static ?string $navigationGroup = 'Downloads';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Form Information')
                    ->schema([
                        Forms\Components\Select::make('category_id')
                            ->relationship('category', 'name')
                            ->required()
                            ->label('Category'),
                        Forms\Components\TextInput::make('title')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\Textarea::make('description')
                            ->maxLength(1000)
                            ->rows(3),
                    ])->columns(1),
                Forms\Components\Section::make('File Information')
                    ->schema([
                        Forms\Components\FileUpload::make('file_path')
                            ->required()
                            ->acceptedFileTypes(['application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'])
                            ->maxSize(10240)
                            ->helperText('Accepted: PDF, DOC, DOCX (Max: 10MB)')
                            ->directory('forms')
                            ->visibility('public'),
                        Forms\Components\TextInput::make('file_type')
                            ->required()
                            ->helperText('File extension (pdf, doc, docx, etc)')
                            ->placeholder('e.g., pdf'),
                        Forms\Components\TextInput::make('file_size')
                            ->numeric()
                            ->helperText('File size in bytes (optional - will be auto-calculated)'),
                    ]),
                Forms\Components\Section::make('Status & Display')
                    ->schema([
                        Forms\Components\TextInput::make('order')
                            ->numeric()
                            ->default(0)
                            ->helperText('Display order (lower numbers appear first)'),
                        Forms\Components\Toggle::make('is_active')
                            ->default(true)
                            ->helperText('Enable/disable this form'),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('category.name')
                    ->label('Category')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('title')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),

                Tables\Columns\TextColumn::make('description')
                    ->limit(40)
                    ->wrap(),

                Tables\Columns\TextColumn::make('file_type')
                    ->label('Type')
                    ->badge()
                    ->formatStateUsing(fn($state) => strtoupper($state))
                    ->color(fn($state) => match ($state) {
                        'pdf' => 'danger',
                        'docx', 'doc' => 'info',
                        default => 'gray',
                    }),

                Tables\Columns\TextColumn::make('download_count')
                    ->label('Downloads')
                    ->sortable(),

                Tables\Columns\IconColumn::make('is_active')
                    ->boolean()
                    ->sortable(),

                Tables\Columns\TextColumn::make('order')
                    ->sortable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('category_id')
                    ->relationship('category', 'name')
                    ->label('Category'),

                Tables\Filters\TernaryFilter::make('is_active')
                    ->label('Active'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('order');
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
            'index' => Pages\ListDownloadableForms::route('/'),
            'create' => Pages\CreateDownloadableForm::route('/create'),
            'edit' => Pages\EditDownloadableForm::route('/{record}/edit'),
        ];
    }
}
