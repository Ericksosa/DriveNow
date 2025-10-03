@extends('errors::minimal')

@section('title', __('Service Unavailable'))
@section('code', '503')
@section('message', __('El servicio no esta disponible. Inténtalo de nuevo en unos minutos.'))
