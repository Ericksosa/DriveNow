@extends('layouts._partials.form')
@section('form-title', __('Editar Cliente')) <!-- Cambia el título según sea necesario -->
@section('form-action', route('customer.update', ['customer' => $customer->id]))
@section('form-method')
    @method('PUT') <!-- Cambia el método según sea necesario -->
@endsection
@section('form-description', __('Edita los detalles del cliente')) <!-- Cambia la descripción según sea necesario -->
@section('form-content')
    @include('admin.client.form') <!-- Incluye el archivo de vista parcial del formulario -->
@endsection
