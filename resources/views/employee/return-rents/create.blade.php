@extends('layouts._partials.form')
@section('form-title', __('Crear Renta o Retorno')) <!-- Cambia el título según sea necesario -->
@section('form-action', route('return-and-rents.store')) <!-- Cambia la ruta según sea necesario -->
@section('form-method')
    @method('POST') <!-- Cambia el método según sea necesario -->
@endsection
@section('form-description', __('Agrega una nueva renta o retorno')) <!-- Cambia la descripción según sea necesario -->
@section('form-content')
    @include('employee.return-rents.form') <!-- Incluye el archivo de vista parcial del formulario -->
@endsection
