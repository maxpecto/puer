<?php

namespace App\Filament\Resources\MenuResource\RelationManagers;

use App\Models\MenuItem;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ItemsRelationManager extends RelationManager
{
    protected static string $relationship = 'items';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('title')
                    ->required()
                    ->maxLength(255),
                TextInput::make('url')
                    ->required()
                    ->maxLength(255),
                Select::make('target')
                    ->options([
                        '_self' => 'Same Tab (_self)',
                        '_blank' => 'New Tab (_blank)',
                    ])
                    ->default('_self')
                    ->required(),
                TextInput::make('icon')
                    ->label('Icon (e.g., heroicon-o-home)')
                    ->maxLength(255),
                Select::make('parent_id')
                    ->label('Parent Item')
                    ->options(function (callable $get, RelationManager $livewire): array {
                        $menuId = $livewire->ownerRecord->id;
                        return MenuItem::where('menu_id', $menuId)
                            ->whereNot('id', fn (Builder $query) => $query->when($livewire->mountedTableActionsData[0]['recordKey'] ?? null, fn($q, $key) => $q->where('id', $key)))
                            ->pluck('title', 'id')
                            ->prepend('None (Root Level)', null)
                            ->all();
                    })
                    ->searchable(),
                TextInput::make('order')
                    ->integer()
                    ->default(0)
                    ->required(),
                Toggle::make('is_active')
                    ->default(true)
                    ->required(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('title')
            ->columns([
                TextColumn::make('id')->sortable(),
                TextColumn::make('title')->searchable()->sortable(),
                TextColumn::make('parent.title')->label('Parent')->placeholder('-')->sortable(),
                TextColumn::make('url')->searchable(),
                TextColumn::make('order')->sortable(),
                IconColumn::make('is_active')->boolean(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
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
            ->reorderable('order');
    }
}
