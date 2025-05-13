<?php

namespace App\Filament\Resources\ExercicioResource\Pages;

use App\Filament\Resources\ExercicioResource;
use App\Models\Exercicio;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Forms\Set;
use Filament\Resources\Pages\Concerns\InteractsWithRecord;
use Filament\Resources\Pages\CreateRecord;

class CreateExercicio extends CreateRecord
{
    protected static string $resource = ExercicioResource::class;

    protected function beforeFill(): void
    {
        $this->form->fill(['record' => new Exercicio()]);
    }

    /**
     * @return array<Action | ActionGroup>
     */
    protected function getFormActions(): array
    {
        return [
            $this->getCreateFormAction()
                ->label('Salvar para depois'),
            Action::make('Calcular')
                ->label('Calcular')
                ->action(function (array $data): void {
                    if ($data['operation'] === 'min') {
                        $data['total'] = $this->calculateTotal(new Exercicio($data));
                    } else {
                        $data['total'] = $this->calculateTotal(new Exercicio($data));
                    }
                    $data['total'] = $this->calculateTotal(new Exercicio($data));
                    $this->fillForm($data);
                }),
            $this->getCancelFormAction()
                ->label('Cancelar')
                ->requiresConfirmation()
                ->modalHeading('Deseja cancelar?')
                ->modalDescription('Todos os dados serão perdidos.')
                ->modalCancelActionLabel('Não')
                ->modalSubmitActionLabel('Sim'),
        ];
    }

    private function calculateTotal(Exercicio $exercicio): int
    {
        $total = match ($exercicio->operation) {
            'min' => $exercicio->minimizar(),
            'max' => $exercicio->maximizar(),
            default => 0
        };

        return $total;
    }
}
