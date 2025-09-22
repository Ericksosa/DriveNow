@extends('layouts._partials.form')
@section('form-title', __('Editar Empleado')) <!-- Cambia el título según sea necesario -->
@section('form-action', route('employee.update', ['employee' => $employee->id]))
@section('form-method')
    @method('PUT') <!-- Cambia el método según sea necesario -->
@endsection
@section('form-description', __('Edita los detalles del empleado')) <!-- Cambia la descripción según sea necesario -->
@section('form-content')
    @include('admin.employee.form') <!-- Incluye el archivo de vista parcial del formulario -->
@endsection
