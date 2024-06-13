<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Infolists\Infolist;
use Filament\Tables\Table;
use Filament\Infolists\Components\TextEntry; 
use Filament\Infolists\Components\Section;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    protected static ?string $modelLabel = 'Users';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('New User')
                    ->description('Create new user')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('Name')
                            ->placeholder('Enter name')
                            ->maxLength(255)
                            ->columnSpanFull()
                            ->required(),
                            //->style('font-size: 18px'),

                        Forms\Components\TextInput::make('email')
                            ->label('Email')
                            ->placeholder('Enter mail')
                            ->email()
                            //->maxlength(255)
                            ->unique(ignoreRecord: true)
                            ->required(),

                        Forms\Components\TextInput::make('password')
                            ->password()
                            //->maxLength(255)
                            //->columnSpanFull()
                            ->placeholder('Enter password')
                            ->dehydrated(fn($state) =>filled($state))
                            ->required(fn ($livewire) => $livewire instanceof \Filament\Livewire\Pages\CreateRecord)

                            //->required(fn(page $livewire):bool=> $livewire instanceof CreateRecord),

                            // ->placeholder('Enter password')
                            // ->icon(function ($show) {
                            //     return $show ? 'heroicon-o-eye' : 'heroicon-o-eye-off';
                            // })
                            // ->toggleable()
                            // ->required(function ($livewire) {
                            //     return $livewire instanceof \Filament\Livewire\Pages\CreateRecord;
                            // }),
                    ])->columns(2)
                
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Name')
                    ->searchable()
                    //->searchable(isIndividual:true,isGlobal:false)
                    //->visible(auth()->user()->email == 'admin@gmail.com')
                    ->sortable(),

                Tables\Columns\TextColumn::make('email')
                    ->label('Email')
                    ->sortable(),
                
               // Tables\Columns\TextColumn::make('users')->counts('users'),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Created At')
                    ->dateTime()
                    ->toggleable(isToggledHiddenByDefault:true)
                    ->sortable(),
            ])
            ->filters([
                // Tables\Filters\TextColumn::make('name')
                // ->label('Name'),

                // Tables\Filters\TextColumn::make('email')
                // ->label('Email'),
            ])
            ->actions([
                //Tables\Actions\ActionGroup::make([
                    Tables\Actions\ViewAction::make(),
                    //->icon('heroicon-o-eye'),
                    Tables\Actions\EditAction::make(),
                    // ->icon('heroicon-o-pencil'),
                    Tables\Actions\DeleteAction::make(),
                    // ->icon('heroicon-o-trash'),
                //])
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
    
    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
        ->schema([
        Section::make('User Info')
        ->schema([ 
                TextEntry::make('name')->label('Name'),
                TextEntry::make('email')->label('Mail'),      
            ])->columns(2)
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
