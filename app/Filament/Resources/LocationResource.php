<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LocationResource\Pages;
use App\Filament\Resources\LocationResource\RelationManagers;
use App\Models\Location;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\DB;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\ViewField;

class LocationResource extends Resource
{
    protected static ?string $model = Location::class;

    protected static ?string $navigationIcon = 'heroicon-o-map-pin';

    public static function form(Form $form): Form
    {
        $mapboxApiKey = null;
        $mapboxStyleUrl = 'mapbox://styles/mapbox/streets-v12';

        try {
            $settingsRecord = DB::table('settings')
                                ->where('group', 'general')
                                ->where('name', 'general')
                                ->first();

            if ($settingsRecord && !empty($settingsRecord->payload)) {
                $payload = json_decode($settingsRecord->payload, true);
                if (json_last_error() === JSON_ERROR_NONE) {
                    $mapboxApiKey = $payload['mapbox_api_key'] ?? null;
                    $mapboxStyleUrl = $payload['mapbox_style_url'] ?? 'mapbox://styles/mapbox/streets-v12';
                }
            }
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('[LocationResource] Failed to load Mapbox settings from DB: ' . $e->getMessage());
        }

        return $form
            ->schema([
                Section::make('Filial Məlumatları')
                    ->columns(2)
                    ->schema([
                        TextInput::make('name')
                            ->label('Filial Adı')
                            ->required()
                            ->maxLength(255)
                            ->columnSpanFull(),
                        Textarea::make('address')
                            ->label('Ünvan')
                            ->columnSpanFull(),
                        Textarea::make('description')
                            ->label('Açıqlama (Xəritədə görünəcək)')
                            ->columnSpanFull(),
                        Toggle::make('is_active')
                            ->label('Aktivdir')
                            ->required()
                            ->default(true),
                    ]),
                Section::make('Xəritədə Konum')
                    ->schema([
                        ViewField::make('coordinates')
                            ->label('Konumu Xəritədən Seçin')
                            ->view('filament.forms.components.location-coordinate-picker')
                            ->viewData([
                                'mapboxApiKey' => $mapboxApiKey,
                                'mapboxStyleUrl' => $mapboxStyleUrl,
                                'latitudeName' => 'latitude',
                                'longitudeName' => 'longitude',
                                'currentLatitude' => $form->getRecord()?->latitude,
                                'currentLongitude' => $form->getRecord()?->longitude,
                            ])
                            ->columnSpanFull()
                            ->live(),
                        TextInput::make('latitude')
                            ->label('Enlik (Avtomatik dolacaq)')
                            ->id('latitude')
                            ->required()
                            ->numeric()
                            ->readOnly(),
                        TextInput::make('longitude')
                            ->label('Uzunluq (Avtomatik dolacaq)')
                            ->id('longitude')
                            ->required()
                            ->numeric()
                            ->readOnly(),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Filial Adı')
                    ->searchable(),
                Tables\Columns\TextColumn::make('address')
                    ->label('Ünvan')
                    ->searchable(),
                Tables\Columns\IconColumn::make('is_active')
                    ->label('Aktivdir')
                    ->boolean(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Yaradılma Tarixi')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Yenilənmə Tarixi')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
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
            'index' => Pages\ListLocations::route('/'),
            'create' => Pages\CreateLocation::route('/create'),
            'edit' => Pages\EditLocation::route('/{record}/edit'),
        ];
    }
}
