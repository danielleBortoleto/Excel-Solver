<?php

namespace App\Filament\Resources\ExercicioResource\Pages;

use App\Filament\Resources\ExercicioResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditExercicio extends EditRecord
{
    protected static string $resource = ExercicioResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
