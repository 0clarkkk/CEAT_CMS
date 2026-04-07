<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CourseResource\Pages;
use App\Models\Course;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class CourseResource extends Resource
{
    protected static ?string $model = Course::class;

    protected static ?string $navigationIcon = 'heroicon-o-book-open';

    protected static ?string $navigationGroup = 'Content Management';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Course Information')
                    ->schema([
                        Forms\Components\Select::make('program_id')
                            ->label('Program')
                            ->relationship('program', 'name')
                            ->required()
                            ->searchable(),
                        Forms\Components\TextInput::make('code')
                            ->label('Course Code')
                            ->required()
                            ->maxLength(20)
                            ->placeholder('e.g., CHE 101'),
                        Forms\Components\TextInput::make('title')
                            ->label('Course Title')
                            ->required()
                            ->maxLength(255),
                    ])->columns(2),

                Forms\Components\Section::make('Course Details')
                    ->schema([
                        Forms\Components\TextInput::make('units')
                            ->label('Units/Credits')
                            ->numeric()
                            ->minValue(1)
                            ->maxValue(10),
                        Forms\Components\Select::make('semester')
                            ->label('Semester')
                            ->options([
                                '1' => '1st Semester',
                                '2' => '2nd Semester',
                                '3' => 'Summer',
                            ]),
                        Forms\Components\Select::make('year_level')
                            ->label('Year Level')
                            ->options([
                                '1' => '1st Year',
                                '2' => '2nd Year',
                                '3' => '3rd Year',
                                '4' => '4th Year',
                                '5' => '5th Year',
                            ]),
                        Forms\Components\TextInput::make('prerequisites')
                            ->label('Prerequisites')
                            ->maxLength(255)
                            ->placeholder('e.g., CHE 100'),
                    ])->columns(2),

                Forms\Components\Section::make('Description')
                    ->schema([
                        Forms\Components\RichEditor::make('description')
                            ->label('Course Description')
                            ->columnSpanFull(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('code')
                    ->label('Code')
                    ->searchable()
                    ->sortable()
                    ->badge(),
                Tables\Columns\TextColumn::make('title')
                    ->label('Title')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('program.name')
                    ->label('Program')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('units')
                    ->label('Units')
                    ->numeric(),
                Tables\Columns\TextColumn::make('year_level')
                    ->label('Year'),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('program')
                    ->relationship('program', 'name'),
                Tables\Filters\SelectFilter::make('year_level')
                    ->options([
                        '1' => '1st Year',
                        '2' => '2nd Year',
                        '3' => '3rd Year',
                        '4' => '4th Year',
                        '5' => '5th Year',
                    ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListCourses::route('/'),
            'create' => Pages\CreateCourse::route('/create'),
            'edit' => Pages\EditCourse::route('/{record}/edit'),
        ];
    }
}
