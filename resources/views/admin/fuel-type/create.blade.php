@extends('layouts._partials.form')
@section('form-title', __('Crear Tipo de Combustible')) <!-- Cambia el título según sea necesario -->
@section('form-action', route('fuel-type.store')) <!-- Cambia la ruta según sea necesario -->
@section('form-method')
    @method('POST') <!-- Cambia el método según sea necesario -->
@endsection
@section('form-description', __('Agrega un nuevo tipo de combustible')) <!-- Cambia la descripción según sea necesario -->
@section('form-content')
    @include('admin.fuel-type.form') <!-- Incluye el archivo de vista parcial del formulario -->
@endsection
