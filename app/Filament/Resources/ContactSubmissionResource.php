<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ContactSubmissionResource\Pages;
use App\Filament\Resources\ContactSubmissionResource\RelationManagers;
use App\Models\ContactSubmission;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Placeholder;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ContactSubmissionResource extends Resource
{
    protected static ?string $model = ContactSubmission::class;

    protected static ?string $navigationIcon = 'heroicon-o-envelope';

    protected static ?string $navigationGroup = 'Site Content';

    protected static ?int $navigationSort = 5;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')->readOnly(),
                TextInput::make('email')->readOnly(),
                TextInput::make('phone')->readOnly(),
                TextInput::make('subject')->readOnly(),
                Textarea::make('message')
                    ->columnSpanFull()
                    ->readOnly(),
                Placeholder::make('created_at')
                    ->label('Submitted At')
                    ->content(fn (ContactSubmission $record): ?string => $record->created_at?->diffForHumans()),
                Toggle::make('is_read')
                    ->label('Mark as Read')
                    // ->disabledOn('view') // view sayfasında disable etmeye gerek yok, direkt güncellenebilir
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('email')
                    ->searchable()
                    ->copyable()
                    ->copyMessage('Email address copied')
                    ->copyMessageDuration(1500),
                TextColumn::make('subject')
                    ->searchable()
                    ->limit(50),
                IconColumn::make('is_read')
                    ->label('Read')
                    ->boolean()
                    ->sortable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(), // Okundu olarak işaretlemek için Edit action lazım
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('created_at', 'desc');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageContactSubmissions::route('/'),
        ];
    }
}
