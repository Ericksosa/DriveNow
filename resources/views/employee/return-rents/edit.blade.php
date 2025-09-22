@extends('layouts._partials.form')
@section('form-title', __('Editar Renta o Retorno')) <!-- Cambia el título según sea necesario -->
@section('form-action', route('return-and-rents.update', ['return_and_rent' => $returnAndRent->id]))
@section('form-method')
    @method('PUT') <!-- Cambia el método según sea necesario -->
@endsection
@section('form-description', __('Edita los detalles de las rentas o retornos')) <!-- Cambia la descripción según sea necesario -->
@section('form-content')
    @include('employee.return-rents.form') <!-- Incluye el archivo de vista parcial del formulario -->
@endsection
