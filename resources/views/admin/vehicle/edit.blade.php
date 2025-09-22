@extends('layouts._partials.form')
@section('form-title', __('Editar Vehículos')) <!-- Cambia el título según sea necesario -->
@section('form-action', route('vehicle.update', ['vehicle' => $vehicle->id]))
@section('form-method')
    @method('PUT') <!-- Cambia el método según sea necesario -->
@endsection
@section('form-description', __('Edita los detalles de los vehículos')) <!-- Cambia la descripción según sea necesario -->
@section('form-content')
    @include('admin.vehicle.form') <!-- Incluye el archivo de vista parcial del formulario -->
@endsection
