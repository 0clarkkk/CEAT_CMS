<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DepartmentResource\Pages;
use App\Models\Department;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class DepartmentResource extends Resource
{
    protected static ?string $model = Department::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-office';

    protected static ?string $navigationGroup = 'Content Management';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Basic Information')
                    ->description('Core department details')
                    ->schema([
                        Forms\Components\TextInput::make('code')
                            ->label('Department Code')
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->maxLength(10)
                            ->placeholder('e.g., CHE, CIV, CS'),
                        Forms\Components\TextInput::make('name')
                            ->label('Department Name')
                            ->required()
                            ->maxLength(255)
                            ->placeholder('e.g., Chemical Engineering'),
                        Forms\Components\TextInput::make('slug')
                            ->label('URL Slug')
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->maxLength(255)
                            ->generateFromFill('name'),
                    ])->columns(2),

                Forms\Components\Section::make('Contact & Location')
                    ->description('Department contact information')
                    ->schema([
                        Forms\Components\TextInput::make('building_name')
                            ->label('Building Name')
                            ->maxLength(255)
                            ->placeholder('e.g., Engineering Building A'),
                        Forms\Components\TextInput::make('location')
                            ->label('Location Details')
                            ->maxLength(255)
                            ->placeholder('e.g., 3rd Floor'),
                        Forms\Components\TextInput::make('contact_email')
                            ->label('Contact Email')
                            ->email()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('contact_phone')
                            ->label('Contact Phone')
                            ->tel()
                            ->maxLength(20),
                    ])->columns(2),

                Forms\Components\Section::make('Department Overview')
                    ->description('Mission, vision, and history')
                    ->schema([
                        Forms\Components\RichEditor::make('description')
                            ->label('Description')
                            ->columnSpanFull(),
                        Forms\Components\RichEditor::make('mission')
                            ->label('Mission Statement')
                            ->columnSpanFull(),
                        Forms\Components\RichEditor::make('vision')
                            ->label('Vision Statement')
                            ->columnSpanFull(),
                        Forms\Components\RichEditor::make('history')
                            ->label('Department History')
                            ->columnSpanFull(),
                    ]),

                Forms\Components\Section::make('Status')
                    ->schema([
                        Forms\Components\Toggle::make('is_center_of_excellence')
                            ->label('Center of Excellence')
                            ->helperText('Mark as a center of excellence'),
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
                Tables\Columns\TextColumn::make('name')
                    ->label('Department Name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('contact_email')
                    ->label('Email')
                    ->searchable(),
                Tables\Columns\IconColumn::make('is_center_of_excellence')
                    ->label('Center of Excellence')
                    ->boolean(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Created')
                    ->dateTime('M d, Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('is_center_of_excellence')
                    ->label('Center of Excellence')
                    ->placeholder('All departments')
                    ->trueLabel('Centers of Excellence')
                    ->falseLabel('Regular Departments'),
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
            'index' => Pages\ListDepartments::route('/'),
            'create' => Pages\CreateDepartment::route('/create'),
            'edit' => Pages\EditDepartment::route('/{record}/edit'),
        ];
    }
}
