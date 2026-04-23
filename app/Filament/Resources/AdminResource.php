<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AdminResource\Pages;
use App\Models\Department;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class AdminResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-shield-check';

    protected static ?string $navigationLabel = 'Administrators';

    protected static ?string $modelLabel = 'Administrator';

    protected static ?string $pluralModelLabel = 'Administrators';

    protected static ?string $slug = 'administrators';

    protected static ?int $navigationSort = 4;

    protected static ?string $navigationGroup = 'User Management';

    /**
     * Only superadmins can see and interact with this resource.
     */
    public static function canViewAny(): bool
    {
        return auth()->user()?->role === 'superadmin';
    }

    public static function canCreate(): bool
    {
        return auth()->user()?->role === 'superadmin';
    }

    public static function canEdit($record): bool
    {
        return auth()->user()?->role === 'superadmin';
    }

    public static function canDelete($record): bool
    {
        return auth()->user()?->role === 'superadmin'
            && $record->id !== auth()->id();
    }

    /**
     * Scope this resource to admin-role users only.
     */
    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->where('role', 'admin');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Account Information')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->maxLength(255)
                            ->placeholder('Full name'),

                        Forms\Components\TextInput::make('email')
                            ->email()
                            ->required()
                            ->unique(table: User::class, column: 'email', ignoreRecord: true)
                            ->maxLength(255)
                            ->placeholder('email@uphsd.edu.ph'),

                        Forms\Components\TextInput::make('password')
                            ->password()
                            ->revealable()
                            ->dehydrateStateUsing(fn ($state) => Hash::make($state))
                            ->dehydrated(fn ($state) => filled($state))
                            ->required(fn (string $operation) => $operation === 'create')
                            ->maxLength(255)
                            ->helperText('Leave blank to keep current password (edit only)'),

                        Forms\Components\Select::make('department_id')
                            ->label('Department')
                            ->options(Department::orderBy('name')->pluck('name', 'id'))
                            ->searchable()
                            ->nullable()
                            ->placeholder('— No department —'),
                    ])->columns(2),

                Forms\Components\Section::make('Account Status')
                    ->schema([
                        Forms\Components\Toggle::make('is_active')
                            ->label('Active')
                            ->default(true)
                            ->helperText('Inactive admins cannot log in to the system'),

                        Forms\Components\DateTimePicker::make('email_verified_at')
                            ->label('Email Verified At')
                            ->helperText('Leave empty to mark as unverified')
                            ->nullable(),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),

                Tables\Columns\TextColumn::make('email')
                    ->searchable()
                    ->sortable()
                    ->copyable(),

                Tables\Columns\TextColumn::make('department.name')
                    ->label('Department')
                    ->searchable()
                    ->sortable()
                    ->placeholder('—')
                    ->badge()
                    ->color('primary'),

                Tables\Columns\IconColumn::make('is_active')
                    ->label('Active')
                    ->boolean()
                    ->trueColor('success')
                    ->falseColor('danger')
                    ->sortable(),

                Tables\Columns\TextColumn::make('last_login_at')
                    ->label('Last Login')
                    ->dateTime('M d, Y H:i')
                    ->sortable()
                    ->placeholder('Never')
                    ->toggleable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Created')
                    ->dateTime('M d, Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('is_active')
                    ->label('Active Status')
                    ->placeholder('All admins')
                    ->trueLabel('Active only')
                    ->falseLabel('Inactive only'),
            ])
            ->actions([
                Tables\Actions\Action::make('toggleActive')
                    ->label(fn (User $record) => $record->is_active ? 'Deactivate' : 'Activate')
                    ->icon(fn (User $record) => $record->is_active ? 'heroicon-o-x-circle' : 'heroicon-o-check-circle')
                    ->color(fn (User $record) => $record->is_active ? 'danger' : 'success')
                    ->requiresConfirmation()
                    ->modalHeading(fn (User $record) => $record->is_active ? 'Deactivate Admin' : 'Activate Admin')
                    ->modalDescription(fn (User $record) => $record->is_active
                        ? "Are you sure you want to deactivate \"{$record->name}\"? They will no longer be able to log in."
                        : "Are you sure you want to activate \"{$record->name}\"?")
                    ->action(function (User $record) {
                        if ($record->id === auth()->id()) {
                            \Filament\Notifications\Notification::make()
                                ->title('Action blocked')
                                ->body('You cannot deactivate your own account.')
                                ->danger()
                                ->send();
                            return;
                        }
                        $record->update(['is_active' => ! $record->is_active]);
                        \Filament\Notifications\Notification::make()
                            ->title('Status updated')
                            ->body("Admin \"{$record->name}\" has been " . ($record->is_active ? 'activated' : 'deactivated') . '.')
                            ->success()
                            ->send();
                    }),

                Tables\Actions\EditAction::make(),

                Tables\Actions\DeleteAction::make()
                    ->before(function (User $record, Tables\Actions\DeleteAction $action) {
                        if ($record->id === auth()->id()) {
                            \Filament\Notifications\Notification::make()
                                ->title('Action blocked')
                                ->body('You cannot delete your own account.')
                                ->danger()
                                ->send();
                            $action->cancel();
                        }
                    }),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('created_at', 'desc')
            ->emptyStateIcon('heroicon-o-shield-check')
            ->emptyStateHeading('No administrators yet')
            ->emptyStateDescription('Create the first admin account using the button above.');
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListAdmins::route('/'),
            'create' => Pages\CreateAdmin::route('/create'),
            'edit'   => Pages\EditAdmin::route('/{record}/edit'),
        ];
    }

}
