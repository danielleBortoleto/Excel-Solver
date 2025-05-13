<?php

namespace App\Filament\Resources\ExercicioResource\Pages;

use App\Filament\Resources\ExercicioResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListExercicios extends ListRecords
{
    protected static string $resource = ExercicioResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->before(function () {
                    $record = new \App\Models\Exercicio();
                }),
        ];
    }
}
