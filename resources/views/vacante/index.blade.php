@extends('layouts.logged')

@section('styles')
<style>
        input[type=checkbox] {
                width: 25px;
                height: 25px;
                margin-right: 5px;
        }
</style>
@endsection

@section('title')
Consultar Vacantes
@endsection
@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{route('inicio.index')}}">Inicio</a></li>
<li class="breadcrumb-item active" aria-current="page"><a href="{{route('vacante.index')}}">Vacantes</a></li>
@endsection
@section('logged-content')

<div class="container-fluid mb-5">
        <form action="">
                <div class="row">
                        <div class="col-md-4">
                                <div class="row">
                                        <div class="form-inline">
                                                <x-form-group fieldName="creada" fieldDescription="Creada:"
                                                        :errors="$errors">
                                                        <input type="checkbox" name="estado[]" value="creada"
                                                                @if(collect(request()->get('estado'))->contains('creada'))
                                                        checked @endif >
                                                </x-form-group>
                                                <x-form-group fieldName="abierta" fieldDescription="Abierta:"
                                                        :errors="$errors">
                                                        <input type="checkbox" name="estado[]" value="abierta"
                                                                @if(collect(request()->get('estado'))->contains('abierta'))
                                                        checked @endif>
                                                </x-form-group>
                                                <x-form-group fieldName="cerrada" fieldDescription="Cerrada:"
                                                        :errors="$errors">
                                                        <input type="checkbox" name="estado[]" value="cerrada"
                                                                @if(collect(request()->get('estado'))->contains('cerrada'))
                                                        checked @endif>
                                                </x-form-group>
                                                <x-form-group fieldName="finalizada" fieldDescription="Finalizada:"
                                                        :errors="$errors">
                                                        <input type="checkbox" name="estado[]" value="finalizada"
                                                                @if(collect(request()->get('estado'))->contains('finalizada'))
                                                        checked @endif>
                                                </x-form-group>
                                        </div>
                                </div>
                                <div class="row">
                                        <x-form-group-select-materia :selected="request()->get('id-materia')" />
                                </div>
                        </div>
                        <div class="col-md-4">
                                <div class="row">
                                        <div class="form-inline">
                                                <x-form-group fieldName="" fieldDescription="Apertura: "
                                                        :errors="$errors">
                                                        <x-form-group-date-picker fieldName="apertura_fecha_inicio"
                                                                fieldId="apertura_fecha_inicio" fieldDescription=""
                                                                :errors="$errors"
                                                                :value="request()->get('apertura_fecha_inicio')" />
                                                        <x-form-group-date-picker fieldName="apertura_fecha_fin"
                                                                fieldId="apertura_fecha_fin" fieldDescription=""
                                                                :errors="$errors"
                                                                :value="request()->get('apertura_fecha_fin')" />
                                                </x-form-group>
                                        </div>
                                </div>
                                <div class="row">
                                        <div class="form-inline">
                                                <x-form-group fieldName="" fieldDescription="Cierre: "
                                                        :errors="$errors">
                                                        <x-form-group-date-picker fieldName="cierre_fecha_inicio"
                                                                fieldId="cierre_fecha_inicio" fieldDescription=""
                                                                :errors="$errors"
                                                                :value="request()->get('cierre_fecha_inicio')" />
                                                        <x-form-group-date-picker fieldName="cierre_fecha_fin"
                                                                fieldId="cierre_fecha_fin" fieldDescription=""
                                                                :errors="$errors"
                                                                :value="request()->get('cierre_fecha_fin')" />
                                                </x-form-group>
                                        </div>
                                </div>
                        </div>
                        <div class="col-md-4">
                                <div class="row">
                                        <div class="form-inline">
                                                <x-form-group fieldName="" fieldDescription="Orden de Merito: "
                                                        :errors="$errors">
                                                        <x-form-group-date-picker fieldName="orden_fecha_inicio"
                                                                fieldId="orden_fecha_inicio" fieldDescription=""
                                                                :errors="$errors"
                                                                :value="request()->get('orden_fecha_inicio')" />
                                                        <x-form-group-date-picker fieldName="orden_fecha_fin"
                                                                fieldId="orden_fecha_fin" fieldDescription=""
                                                                :errors="$errors"
                                                                :value="request()->get('orden_fecha_fin')" />
                                                </x-form-group>
                                        </div>
                                </div>
                        </div>
                </div>
                <div class="row mb-3">
                        <div class="col-12">
                                <button class="btn btn-primary float-right ml-1" type="submit">Filtrar</button>
                                <button class="btn btn-success float-right" type="reset">Borrar filtros</button>
                        </div>
                </div>
        </form>
        <hr>

        @if(count($vacantes) > 0)
        <x-table tableId="dataTable">
                <x-slot name="header">
                        <x-table-row>
                                <x-table-header>Materia</x-table-header>
                                <x-table-header>Nombre Puesto</x-table-header>
                                <x-table-header>Estado</x-table-header>
                                <x-table-header>Fecha Apertura</x-table-header>
                                <x-table-header>Fecha Cierre Estipulada</x-table-header>
                                <x-table-header>Fecha Cierre</x-table-header>
                                <x-table-header>Fecha Orden Mérito</x-table-header>
                                <x-table-header>Postulantes</x-table-header>
                                <x-table-header></x-table-header>
                        </x-table-row>
                </x-slot>
                @foreach ($vacantes as $vacante)
                <x-table-row>
                        <x-table-cell>{{$vacante->materia->nombre}}</x-table-cell>
                        <x-table-cell>{{$vacante->nombre_puesto}}</x-table-cell>
                        <x-table-cell>{{$vacante->status}}</x-table-cell>
                        <x-table-cell>{{\Carbon\Carbon::parse($vacante->fecha_apertura)->format('d-m-Y')}}
                        </x-table-cell>
                        <x-table-cell>{{\Carbon\Carbon::parse($vacante->fecha_cierre_estipulada)->format('d-m-Y')}}
                        </x-table-cell>
                        <x-table-cell>
                                @if(empty($vacante->fecha_cierre))
                                <x-form route="vacante.cerrarAnticipadamente" method="PUT" :id="$vacante->id"
                                        hideButton="true">
                                        <x-split-button buttonType="button" displayName="Cerrar Ahora"
                                                className="btn-danger" iconName="fa-window-close"></x-split-button>
                                </x-form>
                                @else
                                {{\Carbon\Carbon::parse($vacante->fecha_cierre)->format('d-m-Y')}}
                                @endif
                        </x-table-cell>
                        <x-table-cell>
                                @if ($vacante->fecha_orden_merito)
                                {{\Carbon\Carbon::parse($vacante->fecha_orden_merito)->format('d-m-Y')}}
                                @endif
                        </x-table-cell>
                        <x-table-cell>
                                {{$vacante->postulaciones->count()}}
                        </x-table-cell>
                        <x-table-cell>
                                <x-split-button displayName="Detalle" className="btn-success" iconName="fa-list"
                                        routeName="{{route('vacante.show', $vacante->id)}}"></x-split-button>
                        </x-table-cell>
                </x-table-row>
                @endforeach
        </x-table>
        {{ $vacantes->links() }}
        @else
        No hay vacantes en este momento.
        @endif
</div>
@endsection