<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FacultyMemberResource\Pages;
use App\Models\FacultyMember;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class FacultyMemberResource extends Resource
{
    protected static ?string $model = FacultyMember::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    protected static ?string $navigationGroup = 'Content Management';

    protected static ?string $label = 'Faculty Member';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Personal Information')
                    ->schema([
                        Forms\Components\Select::make('department_id')
                            ->label('Department')
                            ->relationship('department', 'name')
                            ->required()
                            ->searchable(),
                        Forms\Components\TextInput::make('first_name')
                            ->label('First Name')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('last_name')
                            ->label('Last Name')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('email')
                            ->label('Email Address')
                            ->email()
                            ->required()
                            ->maxLength(255)
                            ->unique(table: 'faculty_members', column: 'email', ignoreRecord: true),
                    ])->columns(2),

                Forms\Components\Section::make('Academic Information')
                    ->schema([
                        Forms\Components\TextInput::make('position')
                            ->label('Academic Position')
                            ->required()
                            ->maxLength(255)
                            ->placeholder('e.g., Professor, Associate Professor'),
                        Forms\Components\TextInput::make('specialization')
                            ->label('Specialization')
                            ->maxLength(255)
                            ->placeholder('e.g., Chemical Kinetics, Process Design'),
                    ])->columns(2),

                Forms\Components\Section::make('Background')
                    ->schema([
                        Forms\Components\RichEditor::make('biography')
                            ->label('Biography')
                            ->columnSpanFull(),
                        Forms\Components\Textarea::make('education')
                            ->label('Education (JSON)')
                            ->rows(4)
                            ->helperText('Enter JSON array of education records')
                            ->columnSpanFull(),
                        Forms\Components\Textarea::make('research_interests')
                            ->label('Research Interests (JSON)')
                            ->rows(4)
                            ->helperText('Enter JSON array of research interests')
                            ->columnSpanFull(),
                        Forms\Components\Textarea::make('publications')
                            ->label('Publications (JSON)')
                            ->rows(4)
                            ->helperText('Enter JSON array of publications')
                            ->columnSpanFull(),
                    ]),

                Forms\Components\Section::make('Media')
                    ->schema([
                        Forms\Components\FileUpload::make('photo')
                            ->label('Faculty Photo')
                            ->image()
                            ->imageEditor()
                            ->disk('public')
                            ->directory('faculty')
                            ->maxSize(5120) // 5MB
                            ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                            ->helperText('Upload a photo (JPEG, PNG, or WebP). Max 5MB.')
                            ->deletable(true)
                            ->downloadable()
                            ->previewable(false)
                            ->visibility('public'),
                    ]),

                Forms\Components\Section::make('Status')
                    ->schema([
                        Forms\Components\Toggle::make('is_active')
                            ->label('Active Faculty')
                            ->default(true),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('first_name')
                    ->label('First Name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('last_name')
                    ->label('Last Name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('email')
                    ->label('Email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('position')
                    ->label('Position')
                    ->badge(),
                Tables\Columns\TextColumn::make('department.name')
                    ->label('Department')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\IconColumn::make('is_active')
                    ->label('Active')
                    ->boolean(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('department')
                    ->relationship('department', 'name'),
                Tables\Filters\TernaryFilter::make('is_active')
                    ->label('Status')
                    ->placeholder('All faculty')
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
            'index' => Pages\ListFacultyMembers::route('/'),
            'create' => Pages\CreateFacultyMember::route('/create'),
            'edit' => Pages\EditFacultyMember::route('/{record}/edit'),
        ];
    }
}
