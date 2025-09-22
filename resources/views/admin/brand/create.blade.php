@extends('layouts._partials.form')
@section('form-title', __('Crear Marca')) <!-- Cambia el título según sea necesario -->
@section('form-action', route('brand.store')) <!-- Cambia la ruta según sea necesario -->
@section('form-method')
    @method('POST') <!-- Cambia el método según sea necesario -->
@endsection
@section('form-description', __('Agrega una nueva marca')) <!-- Cambia la descripción según sea necesario -->
@section('form-content')
    @include('admin.brand.form') <!-- Incluye el archivo de vista parcial del formulario -->
@endsection
