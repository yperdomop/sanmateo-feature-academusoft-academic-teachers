<?php

namespace App\Http\Livewire\Academic\Administrator;

use App\Http\Utils\Session\SessionMock;
use App\Models\Academic\TipoCalificacion;
use App\Models\Academic\TipoCalificacionCualitativa;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;
use phpDocumentor\Reflection\Types\Null_;

class CreateScoreType extends Component
{
    public string $actionType = 'Crear';
    public array $scoreTypes;
    public string $description = '';
    public string $type;
    public float $passingScore = 0;
    public float $minPassingScore = 0;
    public float $passingScoreEnabling = 0;
    public ?float $cuantitativeMinNote = 0;
    public ?float $cuantitativeMaxNote = 0;
    public ?array $cualitativeValues;
    public ?array $allCualitativeValues;

    protected array $rules = [
        'description' => 'required',
        'type' => 'required',
        'passingScore' => 'required|min:0',
        'minPassingScore' => 'required|min:0',
        'passingScoreEnabling' => 'required|min:0',
        'cuantitativeMinNote' => 'required_if:type,CUANTITATIVA|min:0',
        'cuantitativeMaxNote' => 'required_if:type,CUANTITATIVA|min:0',
    ];

    const VALIDATOR_NAMES_CUALITATIVE_TYPE = [
        'cual_description' => 'Descripción',
        'cual_nomenclature' => 'Nomenclatura',
        'cual_numericvalue' => 'Valor numérico',
        'cual_minvalue' => 'Valor mínimo',
        'cual_maxvalue' => 'Valor máximo',
    ];

    const VALIDATOR_NAMES_SCORE_TYPE = [
        'description' => 'Descripción',
        'type' => 'Tipo de calificación',
        'passingScore' => 'Nota aprobatoria',
        'minPassingScore' => 'Nota mínima',
        'passingScoreEnabling' => 'Nota aprobatoria habilitación',
        'cuantitativeMinNote' => 'Nota mínima',
        'cuantitativeMaxNote' => 'Nota máxima',
    ];

    public function mount() {
        $this->description = '';
        $this->cualitativeValues = [];
        $this->allCualitativeValues = [];
        $this->type = '';
        $this->passingScore = 0;
        $this->minPassingScore = 0;
        $this->passingScoreEnabling = 0;
        $this->cuantitativeMinNote = 0;
        $this->cuantitativeMaxNote = 0;

        $this->scoreTypes = ['CUALITATIVA', 'CUANTITATIVA'];
    }

    public function render()
    {
        return view('livewire.academic.administrator.create-score-type')
        ->extends('layouts.mainLayout', ['title' => 'Crear tipo de calificación', 'rol' => 'Administrador'])
        ->section('content');
    }

    public function setCualitativeValue() {
        $this->resetValidation();
        $validator = Validator::make($this->cualitativeValues, [
            'cual_description' => 'required',
            'cual_nomenclature' => 'required',
            'cual_numericvalue' => 'required',
            'cual_minvalue' => 'required',
            'cual_maxvalue' => 'required',
        ]);


        $validator->setAttributeNames(self::VALIDATOR_NAMES_CUALITATIVE_TYPE);
        $validated = $validator->fails();
        $this->setErrorBag($validator->errors()->messages());
        if(!$validated) {
            array_push($this->allCualitativeValues, $this->cualitativeValues);
            $this->cualitativeValues = [];
        }
    }

    public function saveScoreType() {
        try {
            //ToDo: eliminar mock
            SessionMock::setMockSession();
            $this->validate(NULL, NULL, self::VALIDATOR_NAMES_SCORE_TYPE);
            if($this->validateCualitative()) {
                DB::beginTransaction();
                $scoreType = $this->getScoreType();
                if($this->type === 'CUALITATIVA') {
                    $this->saveCualitativeScoreType($scoreType);
                } else {
                    $this->saveCuantitativeScoreType($scoreType);
                }

                $this->addError('successSaved', 'El registro fue guardado exitosamente');
                $this->mount();
                DB::commit();

            } else {
                $this->addError('allCualitativeValues', 'should have values');
            }
        } catch (\Exception $th) {
            DB::rollBack();
        }
    }



    public function deleteCualitativeValue(int $index) {
        unset($this->allCualitativeValues[$index]);
    }

    private function validateCualitative(): bool {
        if($this->type === 'CUALITATIVA') {
            return sizeof($this->allCualitativeValues) > 0;
        }

        return true;
    }

    private function saveCualitativeScoreType(TipoCalificacion $scoreType): bool {
        $scoreType->fill([
            'TICA_NOTAMINIMA' => 0,
            'TICA_NOTAMAXIMA' => 0,
        ]);
        $scoreType->save();
        $cualitativeScore = $this->mapCualitativeScore($scoreType->tica_id);
        return TipoCalificacionCualitativa::insert($cualitativeScore);

    }

    private function saveCuantitativeScoreType(TipoCalificacion $scoreType): bool {
        $scoreType->fill([
            'TICA_NOTAMINIMA' => $this->cuantitativeMinNote,
            'TICA_NOTAMAXIMA' => $this->cuantitativeMaxNote,
        ]);
        return $scoreType->save();
    }

    private function mapCualitativeScore(int $scoreTypeId): array {
        $mappedCualitativeScores = [];
        foreach ($this->allCualitativeValues as $key => $cualitativeValue) {
            array_push($mappedCualitativeScores, [
                'TICL_DESCRIPCION' => $cualitativeValue['cual_description'],
                'TICL_REGISTRADOPOR' => Session::get('pegeId'),
                'TICL_FECHACAMBIO' => Carbon::now()->format('Y-m-d H:i:s'),
                'TICL_NOMENCLATURA' => $cualitativeValue['cual_nomenclature'],
                'TICA_ID' => $scoreTypeId,
                'TICL_VALORNUMERICO' => $cualitativeValue['cual_numericvalue'],
                'TICL_VALORMINIMO' => $cualitativeValue['cual_minvalue'],
                'TICL_VALORMAXIMO' => $cualitativeValue['cual_maxvalue'],
            ]);
        }

        return $mappedCualitativeScores;
    }

    private function getScoreType(): TipoCalificacion {
        $scoreType = new TipoCalificacion;
        $scoreType->fill([
            'TICA_DESCRIPCION' => $this->description,
            'TICA_REGISTRADOPOR' => Session::get('pegeId'),
            'TICA_FECHACAMBIO' => Carbon::now(),
            'TICA_TIPO' => $this->type,
            'TICA_NOTAAPROBATORIA' => $this->passingScore,
            'TICA_NOTAMINHABILITACION' => $this->minPassingScore,
            'TICA_NOTAAPRUEBAHABILITACION' => $this->passingScoreEnabling,
        ]);
        return $scoreType;
    }
}
