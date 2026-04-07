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
                            ->label('Center Name')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('slug')
                            ->label('URL Slug')
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->maxLength(255)
                            ->generateFromFill('name'),
                    ])->columns(2),

                Forms\Components\Section::make('Leadership & Contact')
                    ->schema([
                        Forms\Components\TextInput::make('director')
                            ->label('Director Name')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('contact_email')
                            ->label('Contact Email')
                            ->email()
                            ->maxLength(255),
                    ])->columns(2),

                Forms\Components\Section::make('Description & Focus Areas')
                    ->schema([
                        Forms\Components\RichEditor::make('description')
                            ->label('Description')
                            ->columnSpanFull(),
                        Forms\Components\Textarea::make('research_areas')
                            ->label('Research Areas (JSON)')
                            ->rows(4)
                            ->helperText('Enter JSON array of research areas')
                            ->columnSpanFull(),
                        Forms\Components\Textarea::make('facilities')
                            ->label('Facilities & Equipment')
                            ->rows(4)
                            ->columnSpanFull(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
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
