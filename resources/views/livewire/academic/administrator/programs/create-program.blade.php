<div>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Inicio</a></li>
        <li class="breadcrumb-item"><a href="/academico/administrador">Administrador</a></li>
        <li class="breadcrumb-item"><a href="/academico/administrador/programas">Programas</a></li>
        <li class="breadcrumb-item active" aria-current="page">Crear</li>
        </ol>
    </nav>

    @error('successSaved')
        <div class="alert alert-success" role="alert">
            {{ $message }}
        </div>
    @enderror

    <form wire:submit.prevent="saveProgram">
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label for="IcfesCode">Código ICFES</label>
                    <input name="IcfesCode" type="text" class="form-control">
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="approvalDate">Fecha aprobación ICFES</label>
                    <input name="approvalDate" type="date" class="form-control" value="{{$approvalDate}}">
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="programCode">Código Programa</label>
                    <input wire:model.defer="programCode" type="text" class="form-control">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-1">
                <div class="form-check">
                    <input type="checkbox" wire:model.defer="status" class="form-check-input" checked>
                    <label for="status" class="form-check-label">Activo</label>
                </div>
                <div class="form-check">
                    <input type="checkbox" wire:model.defer="agreement" class="form-check-input">
                    <label for="agreement" class="form-check-label">Convenio</label>
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="programName">Nombre de programa</label>
                    <input type="text" wire:model.defer="programName" class="form-control">
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="complexity">Complejidad</label>
                    <input type="text" wire:model.defer="complexity" class="form-control">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-2">
                <div class="form-group">
                    <label for="period">Nro. periodos</label>
                    <input type="number" wire:model.defer="period" class="form-control">
                    @error('period') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="abbreviation">Abreviatura</label>
                    <input type="text" wire:model.defer="abbreviation" class="form-control">
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="titleAwarded">Titulo otorgado</label>
                    <input type="text" wire:model.defer="titleAwarded" class="form-control">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <label for="programType">Tipo de Programa</label>
                <select wire:model.defer="programType" id="programType" class="form-control">
                    <option>Selecciona una opción</option>
                    @foreach ($programTypes as $key => $programType)
                        <option value="{{$key}}">{{$programType}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col">
                <label for="modality">Modalidad</label>
                <select wire:model.defer="modality"  id="modality" class="form-control">
                    <option>Selecciona una opción</option>
                    @foreach ($modalities as $modality)
                        <option value="{{$modality->moda_id}}">{{$modality->moda_descripcion}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col">
                <label for="methodology">Metodología</label>
                <select wire:model.defer="methodology"  id="methodology" class="form-control">
                    <option>Selecciona una opción</option>
                    @foreach ($methodologies as $methodology)
                        <option value="{{$methodology->meto_id}}">{{$methodology->meto_descripcion}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col">
                <label for="workingDay">Jornada</label>
                <select wire:model.defer="workingDay"  id="workingDay" class="form-control">
                    <option>Selecciona una opción</option>
                    @foreach ($workingDays as $workingDay)
                        <option value="{{$workingDay->jorn_id}}">{{$workingDay->jorn_descripcion}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col">
                <label for="typeAcademicPeriod">Tipo de Periodo Académico</label>
                <select wire:model.defer="typeAcademicPeriod"  id="typeAcademicPeriod" class="form-control">
                    <option>Selecciona una opción</option>
                    @foreach ($academicPeriodTypes as $typeAcademicPeriod)
                        <option value="{{$typeAcademicPeriod->tppa_id}}">{{$typeAcademicPeriod->tppa_descripcion}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        </div>
        <div class="mt-2 d-flex justify-content-end">
            <input type="submit" class="btn btn-success" value="Guardar">
        </div>
    </form>

</div>
