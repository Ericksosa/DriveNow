@extends('layouts._partials.form')
@section('form-title', __('Editar Tipo de Combustible')) <!-- Cambia el título según sea necesario -->
@section('form-action', route('fuel-type.update', ['fuel_type' => $fuelType->id]))
@section('form-method')
    @method('PUT') <!-- Cambia el método según sea necesario -->
@endsection
@section('form-description', __('Edita los detalles del tipo de combustible')) <!-- Cambia la descripción según sea necesario -->
@section('form-content')
    @include('admin.fuel-type.form') <!-- Incluye el archivo de vista parcial del formulario -->
@endsection
