@extends('layouts._partials.form')
@section('form-title', __('Editar Marca')) <!-- Cambia el título según sea necesario -->
@section('form-action', route('brand.update', ['brand' => $brand->id]))
@section('form-method')
    @method('PUT') <!-- Cambia el método según sea necesario -->
@endsection
@section('form-description', __('Edita los detalles de la marca')) <!-- Cambia la descripción según sea necesario -->
@section('form-content')
    @include('admin.brand.form') <!-- Incluye el archivo de vista parcial del formulario -->
@endsection
