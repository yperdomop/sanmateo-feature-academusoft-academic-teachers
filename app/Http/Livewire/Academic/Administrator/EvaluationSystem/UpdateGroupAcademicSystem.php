<?php

namespace App\Http\Livewire\Academic\Administrator\EvaluationSystem;

use App\Models\Academic\Grupo;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithFileUploads;
use PhpOffice\PhpSpreadsheet\IOFactory;

class UpdateGroupAcademicSystem extends Component
{
    const EXPECTED_HEADERS = [
        "index" => "Nº",
        "subjectCode" => "COD MAT",
        "subjectName" => "MATERIA",
        "groupId" => "GRUP_ID",
        "groupName" => "GRUPO",
        "academicSystemId" => "SIEV_ID",
        "academicSystemName" => "SISTEMA DE EVALUACION"
    ];

    const MASSIVE_UPDATE_CHARS = [
        "`", '"', "\n", "'", ";"
    ];
    const MASSIVE_REPLACE_CHARS = [
        "", '', "", "", ""
    ];

    use WithFileUploads;

    public $file;
    public int $updatedCount = 0;

    public function render()
    {
        return view('livewire.academic.administrator.evaluation-system.update-group-academic-system')
        ->extends('layouts.mainLayout', ['title' => 'Cargar Sistema Evaluación Grupo', 'rol' => 'Administrador'])
        ->section('content');
    }

    public function uploadFile() {
        if(!is_null($this->file)) {
            $spreadsheet = IOFactory::load($this->file->getRealPath());
            $sheet        = $spreadsheet->getActiveSheet();
            $row_limit    = $sheet->getHighestDataRow();
            $row_range    = range( 1, $row_limit );
            $startcount = 2;

            $header = $this->getRow($sheet, 1);
            $isHeaderOk = $this->isHeaderOk($header);
            array_shift($row_range);

            if($isHeaderOk) {
                $data = $this->makeDataStructure($row_range, $sheet);
                try {
                    $result =  collect($data)->groupBy('siev_id')->each(function($value, $key) {
                        Grupo::whereIn('grup_id', $value->pluck('grup_id')->toArray())->update(['siev_id' => $key]);
                        $this->updatedCount += sizeof($value);
                        return true;
                    });

                    $this->addError('successSaved', 'Se actualizaron '. $this->updatedCount . ' grupos');

                } catch (\Throwable $th) {
                    $this->addError('errorSaved', 'Ocurrió un error al actualizar estados');
                }

            } else {
                $this->addError('errorSaved', 'Por favor verifique la primer fila del archivo');
            }
        } else {
            $this->addError('errorSaved', 'Adjunte un archivo');
        }

    }

    protected function isHeaderOk(array $firstRow): bool {
        return (self::EXPECTED_HEADERS === $firstRow);
    }

    protected function getRow($sheet, int $index): array {
        return [
            "index" =>  $sheet->getCell( 'A' . $index )->getValue(),
            "subjectCode" =>  $sheet->getCell( 'B' . $index )->getValue(),
            "subjectName" =>  $sheet->getCell( 'C' . $index )->getValue(),
            "groupId" =>  $sheet->getCell( 'D' . $index )->getValue(),
            "groupName" =>  $sheet->getCell( 'E' . $index )->getValue(),
            "academicSystemId" => $sheet->getCell( 'F' . $index )->getValue(),
            "academicSystemName" => $sheet->getCell( 'G' . $index )->getValue(),
        ];
    }

    protected function getDataForUpdate($sheet, int $index): array {
        return [
            "grup_id" =>  (int) $sheet->getCell( 'D' . $index )->getValue(),
            "siev_id" => (int) $sheet->getCell( 'F' . $index )->getValue(),
        ];
    }

    protected function makeDataStructure(array $rowRange, $sheet): array {
        $data = [];
        foreach ( $rowRange as $row ) {
            $data[] = $this->getDataForUpdate($sheet, $row);
        }

        return $data;
    }
}
