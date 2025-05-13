<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ExercicioResource\Pages;
use App\Filament\Resources\ExercicioResource\RelationManagers;
use App\Models\Exercicio;
use App\Models\Item;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Leandrocfe\FilamentPtbrFormFields\Money;

class ExercicioResource extends Resource
{
    protected static ?string $model = Exercicio::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->default(fn (): string => 'Exercício ' . strval(Exercicio::all()->last()?->id + 1))
                    ->maxLength(100),
                Forms\Components\Select::make('operation')
                    ->options([
                        'max' => 'Maximizar Lucro',
                        'min' => 'Minimizar Custo',
                    ])
                    ->required(),
                Forms\Components\RichEditor::make('description')
                    ->columnSpanFull()
                    ->maxLength(255),
                Forms\Components\Repeater::make('items')
                    ->columnSpanFull()
                    ->columns(4)
                    ->required()
                    ->relationship('items')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('Nome')
                            ->required()
                            ->maxLength(100),
                        Money::make('value')
                            ->label('Valor')
                            ->required(),
                        Forms\Components\TextInput::make('min')
                            ->label('Mínimo')
                            ->integer()
                            ->required(),
                        Forms\Components\TextInput::make('max')
                            ->label('Máximo')
                            ->integer()
                            ->required(),
                    ])
                    ->addAction(function () {
                        new Item([
                            'name' => ' ',
                            'value' => 0,
                            'min' => 0,
                            'max' => 0,
                            'quantity' => 0,
                        ]);
                    }),
                Forms\Components\TextInput::make('limit')
                    ->integer()
                    ->required(),
                Money::make('total')
                    ->default(function (Get $get, Set $set) {
                        $total = 0;
                        $record = $get('record');
                        $items = $get('items');
                        foreach ($items as $item) {
                            $item = new Item($item);
                            $record->attach($item);
                        }
                        match ($get('operation')) {
                            'max' => $total = $record->maximizar(),
                            'min' => $total = $record->minimizar(),
                            default => 0
                        };
                        $set('total', $total);
                    })
                    ->disabled()
                    ->integer()
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListExercicios::route('/'),
            'create' => Pages\CreateExercicio::route('/create'),
            'edit' => Pages\EditExercicio::route('/{record}/edit'),
        ];
    }
}
