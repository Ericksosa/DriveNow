@extends('layouts._partials.form')
@section('form-title', __('Editar Inspección')) <!-- Cambia el título según sea necesario -->
@section('form-action', route('inspection.update', ['inspection' => $inspection->id]))
@section('form-method')
    @method('PUT') <!-- Cambia el método según sea necesario -->
@endsection
@section('form-description', __('Edita los detalles de las inspecciones')) <!-- Cambia la descripción según sea necesario -->
@section('form-content')
    @include('employee.inspection.form') <!-- Incluye el archivo de vista parcial del formulario -->
@endsection
