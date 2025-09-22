@extends('layouts._partials.form')
@section('form-title', __('Editar Tipos de Vehículos')) <!-- Cambia el título según sea necesario -->
@section('form-action', route('vehicle-type.update', ['vehicle_type' => $vehicleType->id]))
@section('form-method')
    @method('PUT') <!-- Cambia el método según sea necesario -->
@endsection
@section('form-description', __('Edita los detalles de los tipos de vehículos')) <!-- Cambia la descripción según sea necesario -->
@section('form-content')
    @include('admin.vehicle-type.form') <!-- Incluye el archivo de vista parcial del formulario -->
@endsection
