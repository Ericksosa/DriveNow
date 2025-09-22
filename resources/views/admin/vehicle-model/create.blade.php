@extends('layouts._partials.form')
@section('form-title', __('Crear Modelos de Vehículos')) <!-- Cambia el título según sea necesario -->
@section('form-action', route('vehicle-model.store')) <!-- Cambia la ruta según sea necesario -->
@section('form-method')
    @method('POST') <!-- Cambia el método según sea necesario -->
@endsection
@section('form-description', __('Agrega un nuevo modelo de vehículo')) <!-- Cambia la descripción según sea necesario -->
@section('form-content')
    @include('admin.vehicle-model.form') <!-- Incluye el archivo de vista parcial del formulario -->
@endsection
