@extends('layouts._partials.form')
@section('form-title', __('Crear Cliente')) <!-- Cambia el título según sea necesario -->
@section('form-action', route('customer.store')) <!-- Cambia la ruta según sea necesario -->
@section('form-method')
    @method('POST') <!-- Cambia el método según sea necesario -->
@endsection
@section('form-description', __('Agrega un nuevo cliente')) <!-- Cambia la descripción según sea necesario -->
@section('form-content')
    @include('admin.client.form') <!-- Incluye el archivo de vista parcial del formulario -->
@endsection
