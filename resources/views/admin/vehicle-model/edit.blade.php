@extends('layouts._partials.form')
@section('form-title', __('Editar Modelos de Vehículos')) <!-- Cambia el título según sea necesario -->
@section('form-action', route('vehicle-model.update', ['vehicle_model' => $vehicleModel->id]))
@section('form-method')
    @method('PUT') <!-- Cambia el método según sea necesario -->
@endsection
@section('form-description', __('Edita los detalles de los modelos de vehículos')) <!-- Cambia la descripción según sea necesario -->
@section('form-content')
    @include('admin.vehicle-model.form') <!-- Incluye el archivo de vista parcial del formulario -->
@endsection
