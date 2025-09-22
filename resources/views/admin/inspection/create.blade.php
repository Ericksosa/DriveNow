@extends('layouts._partials.form')
@section('form-title', __('Crear Inspección')) <!-- Cambia el título según sea necesario -->
@section('form-action', route('inspection.store')) <!-- Cambia la ruta según sea necesario -->
@section('form-method')
    @method('POST') <!-- Cambia el método según sea necesario -->
@endsection
@section('form-description', __('Agrega una nueva inspección')) <!-- Cambia la descripción según sea necesario -->
@section('form-content')
    @include('admin.inspection.form') <!-- Incluye el archivo de vista parcial del formulario -->
@endsection
