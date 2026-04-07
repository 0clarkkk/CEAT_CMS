<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProgramResource\Pages;
use App\Models\Program;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ProgramResource extends Resource
{
    protected static ?string $model = Program::class;

    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';

    protected static ?string $navigationGroup = 'Content Management';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Program Information')
                    ->description('Basic program details')
                    ->schema([
                        Forms\Components\Select::make('department_id')
                            ->label('Department')
                            ->relationship('department', 'name')
                            ->required()
                            ->searchable(),
                        Forms\Components\TextInput::make('name')
                            ->label('Program Name')
                            ->required()
                            ->maxLength(255)
                            ->placeholder('e.g., Bachelor of Science in Chemical Engineering'),
                        Forms\Components\TextInput::make('short_name')
                            ->label('Short Name')
                            ->maxLength(50)
                            ->placeholder('e.g., BS ChE'),
                        Forms\Components\TextInput::make('slug')
                            ->label('URL Slug')
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->maxLength(255)
                            ->generateFromFill('name'),
                    ])->columns(2),

                Forms\Components\Section::make('Program Details')
                    ->schema([
                        Forms\Components\Select::make('degree_level')
                            ->label('Degree Level')
                            ->options([
                                'associate' => 'Associate Degree',
                                'bachelor' => 'Bachelor Degree',
                                'master' => 'Master Degree',
                                'phd' => 'PhD',
                            ])
                            ->required(),
                        Forms\Components\TextInput::make('duration_years')
                            ->label('Duration (Years)')
                            ->numeric()
                            ->minValue(1)
                            ->maxValue(10),
                    ])->columns(2),

                Forms\Components\Section::make('Program Description')
                    ->schema([
                        Forms\Components\RichEditor::make('description')
                            ->label('Description')
                            ->columnSpanFull(),
                        Forms\Components\RichEditor::make('objectives')
                            ->label('Learning Objectives')
                            ->columnSpanFull(),
                        Forms\Components\RichEditor::make('career_opportunities')
                            ->label('Career Opportunities')
                            ->columnSpanFull(),
                    ]),

                Forms\Components\Section::make('Status')
                    ->schema([
                        Forms\Components\Toggle::make('is_active')
                            ->label('Active Program')
                            ->default(true),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Program Name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('department.name')
                    ->label('Department')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('degree_level')
                    ->label('Degree Level')
                    ->badge(),
                Tables\Columns\TextColumn::make('duration_years')
                    ->label('Duration')
                    ->suffix(' years')
                    ->numeric(),
                Tables\Columns\IconColumn::make('is_active')
                    ->label('Active')
                    ->boolean(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('department')
                    ->relationship('department', 'name'),
                Tables\Filters\SelectFilter::make('degree_level')
                    ->options([
                        'associate' => 'Associate Degree',
                        'bachelor' => 'Bachelor Degree',
                        'master' => 'Master Degree',
                        'phd' => 'PhD',
                    ]),
                Tables\Filters\TernaryFilter::make('is_active')
                    ->label('Status')
                    ->placeholder('All programs')
                    ->trueLabel('Active')
                    ->falseLabel('Inactive'),
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
            'index' => Pages\ListPrograms::route('/'),
            'create' => Pages\CreateProgram::route('/create'),
            'edit' => Pages\EditProgram::route('/{record}/edit'),
        ];
    }
}
