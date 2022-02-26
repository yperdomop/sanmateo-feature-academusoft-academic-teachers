<?php

namespace App\Http\Livewire\Academic\Administrator;

use App\Http\Utils\Session\SessionMock;
use App\Models\Academic\TipoCalificacion;
use App\Models\Academic\TipoCalificacionCualitativa;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;

class EditScoreType extends Component
{
    public string $actionType = 'Editar';
    public int $scoreTypeId;
    public TipoCalificacion $scoreType;
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
    public ?array $cualitativeToDelete;
    public ?array $cualitativeToAdd;



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

    public function mount(int $scoreTypeId) {
        $this->scoreTypeId = $scoreTypeId;
        $scoreType = TipoCalificacion::find($scoreTypeId);
        $this->scoreType = $scoreType;
        $cualitative = $scoreType->TipoCalificacionCualitativa()->get()->map(function($value, $key) {
            return [
                'cual_description' => $value->ticl_descripcion,
                'cual_nomenclature' => $value->ticl_nomenclatura,
                'cual_numericvalue' => $value->ticl_valornumerico,
                'cual_minvalue' => $value->ticl_valorminimo,
                'cual_maxvalue' => $value->ticl_valormaximo,
                'cual_id' => $value->ticl_id,
                'tica_id' => $value->tica_id,
            ];
        });

        $this->description = $scoreType->tica_descripcion;
        $this->cualitativeValues = [];
        $this->cualitativeToDelete = [];
        $this->cualitativeToAdd = [];
        $this->allCualitativeValues = $cualitative->toArray();
        $this->type = $scoreType->tica_tipo;
        $this->passingScore = $scoreType->tica_notaaprobatoria;
        $this->minPassingScore = $scoreType->tica_notaminhabilitacion;
        $this->passingScoreEnabling = $scoreType->tica_notaapruebahabilitacion;
        $this->cuantitativeMinNote = $scoreType->tica_notaminima;
        $this->cuantitativeMaxNote = $scoreType->tica_notamaxima;

        $this->scoreTypes = ['CUALITATIVA', 'CUANTITATIVA'];
    }

    public function render()
    {
        return view('livewire.academic.administrator.create-score-type')
        ->extends('layouts.mainLayout', ['title' => 'Tipo de Calificaciones', 'rol' => 'Administrador'])
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
            array_push($this->cualitativeToAdd, $this->cualitativeValues);
            $this->cualitativeValues = [];
        }
    }

    public function deleteCualitativeValue(int $index) {
        array_push($this->cualitativeToDelete, $this->allCualitativeValues[$index]);
        unset($this->allCualitativeValues[$index]);
    }


    public function saveScoreType() {
        try {
            //ToDo: eliminar mock
            SessionMock::setMockSession();
            $this->validate(NULL, NULL, self::VALIDATOR_NAMES_SCORE_TYPE);
            if($this->validateCualitative()) {
                DB::beginTransaction();
                $this->setScoreType();
                $this->scoreType->save();
                $this->saveCualitativeNewValues();
                $this->deleteCualitativeValues();

                $this->addError('successSaved', 'El registro fue editado exitosamente');
                $this->mount($this->scoreTypeId);
                DB::commit();

            } else {
                $this->addError('allCualitativeValues', 'should have values');
            }
        } catch (\Exception $th) {
            DB::rollBack();
        }
    }

    private function validateCualitative(): bool {
        if($this->type === 'CUALITATIVA') {
            return sizeof($this->allCualitativeValues) > 0;
        }

        return true;
    }

    private function setScoreType(): void {
        $this->scoreType->tica_descripcion = $this->description;
        $this->scoreType->tica_registradopor = Session::get('pegeId');
        $this->scoreType->tica_fechacambio = Carbon::now();
        $this->scoreType->tica_tipo = $this->type;
        $this->scoreType->tica_notaaprobatoria = $this->passingScore;
        $this->scoreType->tica_notaminhabilitacion = $this->minPassingScore;
        $this->scoreType->tica_notaapruebahabilitacion = $this->passingScoreEnabling;
        $this->scoreType->tica_notaminima = $this->cuantitativeMinNote;
        $this->scoreType->tica_notamaxima = $this->cuantitativeMaxNote;
    }

    private function saveCualitativeNewValues(): bool {
        $mappedCualitativeScores = [];
        foreach ($this->cualitativeToAdd as $key => $cualitativeValue) {
            array_push($mappedCualitativeScores, [
                'TICL_DESCRIPCION' => $cualitativeValue['cual_description'],
                'TICL_REGISTRADOPOR' => Session::get('pegeId'),
                'TICL_FECHACAMBIO' => Carbon::now()->format('Y-m-d H:i:s'),
                'TICL_NOMENCLATURA' => $cualitativeValue['cual_nomenclature'],
                'TICA_ID' => $this->scoreType->tica_id,
                'TICL_VALORNUMERICO' => $cualitativeValue['cual_numericvalue'],
                'TICL_VALORMINIMO' => $cualitativeValue['cual_minvalue'],
                'TICL_VALORMAXIMO' => $cualitativeValue['cual_maxvalue'],
            ]);
        }

        return TipoCalificacionCualitativa::insert($mappedCualitativeScores);
    }

    private function deleteCualitativeValues(): bool {
        $ids = new Collection($this->cualitativeToDelete);
        return TipoCalificacionCualitativa::destroy($ids->pluck('cual_id')->toArray());
    }


}
