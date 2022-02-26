<?php

namespace App\Http\Livewire\Academic\Teacher;

use App\Http\Utils\Database\Group\GroupStudents;
use App\Http\Utils\Database\Student\StudentRatings;
use App\Models\Academic\Calificacion;
use App\Models\Academic\GrupoMatriculado;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class SetStudentScore extends Component
{
    use GroupStudents;
    use StudentRatings;

    public string $menu;
    public array $editingNotes;
    public array $newNotes;
    public int $indexScore;
    public Collection $subjectRatingWithDates;
    public int $groupId;
    public ?array $selectedScore;
    public Collection $groupSubjectInfo;
    protected ?Collection $students;
    public array $studentsWithRate;

    const RATING_STATUS = 'ACTIVO';

    public function mount() {
        $this->groupId = session()->get('groupId');
        $this->subjectRatingWithDates = $this->getGroupDates($this->groupId);
        $this->groupSubjectInfo = $this->getGroupSubject($this->groupId);
        $this->studentsWithRate = [];
        $this->students = new Collection();
        $this->editingNotes = [];
        $this->newNotes = [];
        $this->menu = '<li class="breadcrumb-item"><a href="/academico/docente">Docente</a></li>
        <li class="breadcrumb-item"><a href="/academico/docente/mis-clases">Mis clases</a></li>
        <li class="breadcrumb-item active" aria-current="page">Calificar</li>';
        // ToDO: habilitar cuando se tengan datos de periodos activos : $this->subjectRatingWithDates = $this->getAvailableRates();
    }

    public function render()
    {
        return view('livewire.academic.teacher.set-student-score')
        ->extends('layouts.mainLayout', ['title' => 'Calificar', 'rol' => 'Docente'])
        ->section('content');
    }

    public function selectScoreToRate(int $index) {
        $this->indexScore = $index;
        $this->selectedScore = $this->subjectRatingWithDates->get($index);
        $this->students = $this->getStudentsByGroup($this->groupId)->keyBy('estpid');
        $studentEstpId = $this->students->pluck('estpid')->toArray();
        $studentRatings = $this->getStudentRatingsByGroup($studentEstpId, $this->groupId, $this->selectedScore['evacid'])->groupBy('estpid');
        $this->studentsWithRate = $this->students->groupByKeys($studentRatings, 'ratings')->toArray();
    }

    public function resetSelectedScore() {
        $this->selectedScore = [];
        $this->studentsWithRate = [];
        $this->students = new Collection();
        $this->editingNotes = [];
    }

    protected function getAvailableRates(): Collection {
        return $this->subjectRatingWithDates->filter(function($value) {
            $initDay = Carbon::createFromFormat('Y-m-d H:i:s', $value['mindate']);
            $finishDay = Carbon::createFromFormat('Y-m-d H:i:s', $value['maxdate']);


            return Carbon::now()->between($initDay, $finishDay);
        });
    }

    public function editNote(int $noteToEdit): void {
        array_push($this->editingNotes, $noteToEdit);
        $this->newNotes[$noteToEdit] = $this->studentsWithRate[$noteToEdit]['ratings'][0]['ratingvalue'];
    }

    public function cancelEditNote(int $noteToCancelEdit): void {
        $indexToDelete = array_search($noteToCancelEdit, $this->editingNotes);
        unset($this->editingNotes[$indexToDelete]);
        unset($this->newNotes[$noteToCancelEdit]);
    }

    public function confirmNote(int $estpId): void {

        try {
            DB::beginTransaction();
            $rating = $this->mapCalification($estpId);
            empty($this->studentsWithRate[$estpId]['ratings']) ? $rating->save() : $rating->update();
            $this->updateFinalNote($estpId, $this->studentsWithRate[$estpId]['grmaid']);
            session()->flash('groupId', $this->groupId);
            $this->addError('successSaved', 'Las notas fueron registradas exitósamente');
            $this->cancelEditNote($estpId);
            $this->selectScoreToRate($this->indexScore);
            DB::commit();
        } catch (\Throwable $th) {
            dd($th);
            DB::rollback();
            $this->addError('errorSaved', 'Ocurrió un problema al guardar el registro');
        }
    }

    public function saveAllNotes(): void {
        try {
            DB::beginTransaction();
            foreach ($this->newNotes as $estpId => $value) {
                $rating = $this->mapCalification($estpId);
                empty($this->studentsWithRate[$estpId]['ratings']) ? $rating->save() : $rating->update();
                $this->cancelEditNote($estpId);
            }
            session()->flash('groupId', $this->groupId);
            $this->addError('successSaved', 'Las notas fueron registradas exitósamente');
            $this->selectScoreToRate($this->indexScore);
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollback();
            $this->addError('errorSaved', 'Ocurrió un problema al guardar los registros, intente de nuevo, por favor');
        }
    }

    protected function mapCalification(int $estpId): Calificacion {
        $rating = new Calificacion();
        $existentRating = $this->studentsWithRate[$estpId];

        $calfId = empty($existentRating['ratings']) ? null : $existentRating['ratings'][0]['calfid'];
        $rating = (is_null($calfId)) ? $rating : Calificacion::find($calfId);
        $rating->fill([
            'CALF_ID' => $calfId,
            'CALF_ESTADO' => self::RATING_STATUS,
            'NOTA_ID' => $this->selectedScore['notaid'],
            'GRMA_ID' => $existentRating['grmaid'],
            'CALF_REGISTRADOPOR' => Session::get('pegeId'),
            'CALF_FECHACAMBIO' => Carbon::now()->format('Y-m-d H:i:s'),
            'CALF_VALOR' => $this->newNotes[$estpId]
        ]);

        return $rating;
    }

    protected function updateFinalNote(int $estpId, int $grmaId): void {
        $totalRating = $this->getTotalRatingByStudents($estpId, $grmaId)->toArray()[0];
        $grupoMatriculado = GrupoMatriculado::find($grmaId);
        $grupoMatriculado->fill([
            'GRMA_REGISTRADOPOR' => Session::get('pegeId'),
            'GRMA_FECHACAMBIO' => Carbon::now()->format('Y-m-d H:i:s'),
            'GRMA_DEFINITIVA' => $totalRating['totalrating'],
            'GRMA_FINAL' => $totalRating['totalrating'],
        ]);
        $grupoMatriculado->save();
    }
}
