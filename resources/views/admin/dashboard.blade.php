<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Panel de Administración') }}
            </h2>
            <div class="flex items-center gap-4">
                <div class="text-sm text-gray-600 dark:text-gray-400">
                    {{ now()->format('l, d F Y - H:i') }}
                </div>
                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400">
                    <span class="w-2 h-2 bg-green-500 rounded-full mr-2 animate-pulse"></span>
                    Sistema Activo
                </span>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <!-- Stats Cards - Row 1 -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">

                <!-- Total Vehículos -->
                <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl shadow-lg p-6 text-white">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center backdrop-blur-sm">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                            </svg>
                        </div>
                        <span class="text-3xl font-bold">{{ $totalVehicles ?? 0 }}</span>
                    </div>
                    <h3 class="text-sm font-medium text-white/80">Total Vehículos</h3>
                    <div class="flex items-center justify-between mt-2">
                        <p class="text-xs text-white/60">{{ $availableVehicles ?? 0 }} disponibles</p>
                        <p class="text-xs text-white/60">{{ $rentedVehicles ?? 0 }} rentados</p>
                    </div>
                </div>

                <!-- Total Clientes -->
                <div class="bg-gradient-to-br from-green-500 to-green-600 rounded-2xl shadow-lg p-6 text-white">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center backdrop-blur-sm">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                            </svg>
                        </div>
                        <span class="text-3xl font-bold">{{ $totalCustomers ?? 0 }}</span>
                    </div>
                    <h3 class="text-sm font-medium text-white/80">Total Clientes</h3>
                    <p class="text-xs text-white/60 mt-2">{{ $newCustomersThisMonth ?? 0 }} nuevos este mes</p>
                </div>

                <!-- Total Empleados -->
                <div class="bg-gradient-to-br from-purple-500 to-purple-600 rounded-2xl shadow-lg p-6 text-white">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center backdrop-blur-sm">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <span class="text-3xl font-bold">{{ $totalEmployees ?? 0 }}</span>
                    </div>
                    <h3 class="text-sm font-medium text-white/80">Total Empleados</h3>
                    <p class="text-xs text-white/60 mt-2">{{ $activeEmployees ?? 0 }} activos</p>
                </div>

                <!-- Ingresos Totales -->
                <div class="bg-gradient-to-br from-yellow-500 to-yellow-600 rounded-2xl shadow-lg p-6 text-white">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center backdrop-blur-sm">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <span class="text-3xl font-bold">RD${{ number_format($totalRevenue ?? 0, 0) }}</span>
                    </div>
                    <h3 class="text-sm font-medium text-white/80">Ingresos Totales</h3>
                    <p class="text-xs text-white/60 mt-2">RD${{ number_format($monthlyRevenue ?? 0, 0) }} este mes</p>
                </div>

            </div>

            <!-- Stats Cards - Row 2 -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-6">

                <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-lg p-6">
                    <div class="flex items-center justify-between mb-3">
                        <div class="w-10 h-10 bg-blue-100 dark:bg-blue-900/30 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                        </div>
                        <span class="text-2xl font-bold text-gray-900 dark:text-white">{{ $rentedVehicles ?? 0 }}</span>
                    </div>
                    <h3 class="text-sm font-medium text-gray-600 dark:text-gray-400">Rentas Activas</h3>
                </div>

                <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-lg p-6">
                    <div class="flex items-center justify-between mb-3">
                        <div class="w-10 h-10 bg-green-100 dark:bg-green-900/30 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
                            </svg>
                        </div>
                        <span class="text-2xl font-bold text-gray-900 dark:text-white">{{ $totalInspections ?? 0 }}</span>
                    </div>
                    <h3 class="text-sm font-medium text-gray-600 dark:text-gray-400">Inspecciones</h3>
                </div>

                <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-lg p-6">
                    <div class="flex items-center justify-between mb-3">
                        <div class="w-10 h-10 bg-purple-100 dark:bg-purple-900/30 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                            </svg>
                        </div>
                        <span class="text-2xl font-bold text-gray-900 dark:text-white">{{ $totalBrands ?? 0 }}</span>
                    </div>
                    <h3 class="text-sm font-medium text-gray-600 dark:text-gray-400">Marcas</h3>
                </div>

                <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-lg p-6">
                    <div class="flex items-center justify-between mb-3">
                        <div class="w-10 h-10 bg-orange-100 dark:bg-orange-900/30 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-orange-600 dark:text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                            </svg>
                        </div>
                        <span class="text-2xl font-bold text-gray-900 dark:text-white">{{ $totalModels ?? 0 }}</span>
                    </div>
                    <h3 class="text-sm font-medium text-gray-600 dark:text-gray-400">Modelos</h3>
                </div>

                <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-lg p-6">
                    <div class="flex items-center justify-between mb-3">
                        <div class="w-10 h-10 bg-red-100 dark:bg-red-900/30 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-red-600 dark:text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                            </svg>
                        </div>
                        <span class="text-2xl font-bold text-gray-900 dark:text-white">{{ $pendingApproval ?? 0 }}</span>
                    </div>
                    <h3 class="text-sm font-medium text-gray-600 dark:text-gray-400">Pendiente de Aprobación</h3>
                </div>

            </div>

            <!-- Quick Actions -->
            <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-lg p-6">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Acciones Rápidas</h3>
                <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-4">
                    <a href="{{ route('vehicle.create') }}" class="flex flex-col items-center justify-center p-4 bg-blue-50 dark:bg-blue-900/20 hover:bg-blue-100 dark:hover:bg-blue-900/30 rounded-xl transition-colors duration-200 group">
                        <div class="w-12 h-12 bg-blue-500 rounded-xl flex items-center justify-center mb-3 group-hover:scale-110 transition-transform duration-200">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                            </svg>
                        </div>
                        <span class="text-xs font-medium text-gray-900 dark:text-white text-center">Nuevo Vehículo</span>
                    </a>

                    <a href="{{ route('customer.create') }}" class="flex flex-col items-center justify-center p-4 bg-green-50 dark:bg-green-900/20 hover:bg-green-100 dark:hover:bg-green-900/30 rounded-xl transition-colors duration-200 group">
                        <div class="w-12 h-12 bg-green-500 rounded-xl flex items-center justify-center mb-3 group-hover:scale-110 transition-transform duration-200">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                            </svg>
                        </div>
                        <span class="text-xs font-medium text-gray-900 dark:text-white text-center">Nuevo Cliente</span>
                    </a>

                    <a href="{{ route('employee.create') }}" class="flex flex-col items-center justify-center p-4 bg-purple-50 dark:bg-purple-900/20 hover:bg-purple-100 dark:hover:bg-purple-900/30 rounded-xl transition-colors duration-200 group">
                        <div class="w-12 h-12 bg-purple-500 rounded-xl flex items-center justify-center mb-3 group-hover:scale-110 transition-transform duration-200">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <span class="text-xs font-medium text-gray-900 dark:text-white text-center">Nuevo Empleado</span>
                    </a>

                    <a href="{{ route('return-and-rents.create') }}" class="flex flex-col items-center justify-center p-4 bg-yellow-50 dark:bg-yellow-900/20 hover:bg-yellow-100 dark:hover:bg-yellow-900/30 rounded-xl transition-colors duration-200 group">
                        <div class="w-12 h-12 bg-yellow-500 rounded-xl flex items-center justify-center mb-3 group-hover:scale-110 transition-transform duration-200">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                        </div>
                        <span class="text-xs font-medium text-gray-900 dark:text-white text-center">Nueva Renta</span>
                    </a>

                    <a href="{{ route('brand.index') }}" class="flex flex-col items-center justify-center p-4 bg-indigo-50 dark:bg-indigo-900/20 hover:bg-indigo-100 dark:hover:bg-indigo-900/30 rounded-xl transition-colors duration-200 group">
                        <div class="w-12 h-12 bg-indigo-500 rounded-xl flex items-center justify-center mb-3 group-hover:scale-110 transition-transform duration-200">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                            </svg>
                        </div>
                        <span class="text-xs font-medium text-gray-900 dark:text-white text-center">Gestionar Marcas</span>
                    </a>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

                <!-- Estado de la Flota -->
                <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-lg overflow-hidden">
                    <div class="p-6 border-b border-gray-200 dark:border-gray-700">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Estado de la Flota</h3>
                    </div>
                    <div class="p-6 space-y-4">
                        <div class="flex items-center justify-between p-4 bg-green-50 dark:bg-green-900/20 rounded-xl">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 bg-green-500 rounded-lg flex items-center justify-center">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-900 dark:text-white">Disponibles</p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">Listos para rentar</p>
                                </div>
                            </div>
                            <span class="text-2xl font-bold text-green-600 dark:text-green-400">{{ $availableVehicles ?? 0 }}</span>
                        </div>

                        <div class="flex items-center justify-between p-4 bg-blue-50 dark:bg-blue-900/20 rounded-xl">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 bg-blue-500 rounded-lg flex items-center justify-center">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-900 dark:text-white">Rentados</p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">En uso actualmente</p>
                                </div>
                            </div>
                            <span class="text-2xl font-bold text-blue-600 dark:text-blue-400">{{ $rentedVehicles ?? 0 }}</span>
                        </div>

                        <div class="flex items-center justify-between p-4 bg-yellow-50 dark:bg-yellow-900/20 rounded-xl">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 bg-yellow-500 rounded-lg flex items-center justify-center">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-900 dark:text-white">Pendiente de Aprobación</p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">En espera de aprobación</p>
                                </div>
                            </div>
                            <span class="text-2xl font-bold text-yellow-600 dark:text-yellow-400">{{ $pendingApproval ?? 0 }}</span>
                        </div>

                        <div class="flex items-center justify-between p-4 bg-red-50 dark:bg-red-900/20 rounded-xl">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 bg-red-500 rounded-lg flex items-center justify-center">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-900 dark:text-white">Malas condiciones</p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">No disponibles</p>
                                </div>
                            </div>
                            <span class="text-2xl font-bold text-red-600 dark:text-red-400">{{ $outOfServiceVehicles ?? 0 }}</span>
                        </div>
                    </div>
                </div>

                <!-- Resumen Financiero -->
                <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-lg overflow-hidden">
                    <div class="p-6 border-b border-gray-200 dark:border-gray-700">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Resumen Financiero</h3>
                    </div>
                    <div class="p-6 space-y-4">
                        <div class="p-4 bg-gradient-to-br from-green-500 to-green-600 rounded-xl text-white">
                            <p class="text-sm font-medium text-white/80 mb-1">Ingresos del Mes</p>
                            <p class="text-3xl font-bold">RD${{ number_format($monthlyRevenue ?? 0, 2) }}</p>
                            <div class="flex items-center gap-2 mt-2">
                                <span class="text-xs bg-white/20 px-2 py-1 rounded">{{ $completedRentsThisMonth ?? 0 }} rentas</span>
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div class="p-4 bg-blue-50 dark:bg-blue-900/20 rounded-xl">
                                <p class="text-xs text-gray-500 dark:text-gray-400 mb-1">Ingresos Hoy</p>
                                <p class="text-xl font-bold text-gray-900 dark:text-white">RD${{ number_format($todayRevenue ?? 0, 2) }}</p>
                            </div>
                            <div class="p-4 bg-purple-50 dark:bg-purple-900/20 rounded-xl">
                                <p class="text-xs text-gray-500 dark:text-gray-400 mb-1">Promedio/Renta</p>
                                <p class="text-xl font-bold text-gray-900 dark:text-white">RD${{ number_format($averageRentAmount ?? 0, 2) }}</p>
                            </div>
                        </div>

                        <div class="p-4 bg-slate-50 dark:bg-slate-700/50 rounded-xl">
                            <p class="text-sm font-medium text-gray-900 dark:text-white mb-2">Ingresos Anuales</p>
                            <p class="text-2xl font-bold text-gray-900 dark:text-white">RD${{ number_format($yearlyRevenue ?? 0, 2) }}</p>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Rentas Recientes y Actividad -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

                <!-- Rentas Recientes -->
                <div class="lg:col-span-2 bg-white dark:bg-slate-800 rounded-2xl shadow-lg overflow-hidden">
                    <div class="p-6 border-b border-gray-200 dark:border-gray-700">
                        <div class="flex items-center justify-between">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Rentas Recientes</h3>
                            <a href="{{ route('return-and-rents.index') }}" class="text-sm text-blue-600 dark:text-blue-400 hover:underline">Ver todas</a>
                        </div>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead class="bg-gray-50 dark:bg-slate-700/50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Cliente</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Vehículo</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Empleado</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Monto</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Estado</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                                @forelse($recentRents as $rent)
                                <tr class="hover:bg-gray-50 dark:hover:bg-slate-700/50 transition-colors duration-150">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900 dark:text-white">{{ ($rent->customer->user->name ?? "")." ".($rent->customer->user->last_name ?? "") }}</div>
                                        <div class="text-xs text-gray-500 dark:text-gray-400">{{ $rent->customer->user->email ?? '' }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900 dark:text-white">{{ $rent->vehicle->name ?? 'N/A' }}</div>
                                        <div class="text-xs text-gray-500 dark:text-gray-400">{{ $rent->vehicle->plate_number ?? '' }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900 dark:text-white">{{ ($rent->employee->user->name ?? "") . " ". ($rent->employee->user->last_name ?? "") }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-semibold text-gray-900 dark:text-white">{{ number_format($rent->total_amount, 2) }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if($rent->status === 'Reservado')
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400">
                                                Activa
                                            </span>
                                        @elseif($rent->status === 'Devuelto')
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-400">
                                                Completada
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800 dark:bg-gray-900/30 dark:text-gray-400">
                                                {{ ucfirst($rent->status) }}
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-8 text-center text-gray-500 dark:text-gray-400">
                                        No hay rentas recientes
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>

            <!-- Vehículos Más Rentados y Clientes Top -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

                <!-- Vehículos Más Rentados -->
                <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-lg overflow-hidden">
                    <div class="p-6 border-b border-gray-200 dark:border-gray-700">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Vehículos Más Rentados</h3>
                    </div>
                    <div class="p-6 space-y-4">
                        @forelse($topVehicles as $index => $vehicle)
                        <div class="flex items-center gap-4 p-4 bg-slate-50 dark:bg-slate-700/50 rounded-xl">
                            <div class="flex-shrink-0 w-10 h-10 bg-gradient-to-br from-blue-500 to-blue-600 rounded-lg flex items-center justify-center text-white font-bold">
                                {{ $index + 1 }}
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-medium text-gray-900 dark:text-white truncate">{{ $vehicle->name }}</p>
                                <p class="text-xs text-gray-500 dark:text-gray-400">{{ $vehicle->plate_number }}</p>
                            </div>
                            <div class="text-right">
                                <p class="text-sm font-bold text-gray-900 dark:text-white">{{ $vehicle->rent_count ?? 0 }}</p>
                                <p class="text-xs text-gray-500 dark:text-gray-400">rentas</p>
                            </div>
                        </div>
                        @empty
                        <div class="text-center py-8 text-gray-500 dark:text-gray-400">
                            No hay datos disponibles
                        </div>
                        @endforelse
                    </div>
                </div>

                <!-- Clientes Top -->
                <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-lg overflow-hidden">
                    <div class="p-6 border-b border-gray-200 dark:border-gray-700">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Mejores Clientes</h3>
                    </div>
                    <div class="p-6 space-y-4">
                        @forelse($topCustomers as $index => $customer)
                        <div class="flex items-center gap-4 p-4 bg-slate-50 dark:bg-slate-700/50 rounded-xl">
                            <div class="flex-shrink-0 w-10 h-10 bg-gradient-to-br from-green-500 to-green-600 rounded-full flex items-center justify-center text-white font-bold">
                                {{ substr($customer->user->name, 0, 1) }}
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-medium text-gray-900 dark:text-white truncate">{{ $customer->user->name }}</p>
                                <p class="text-xs text-gray-500 dark:text-gray-400">{{ $customer->user->email }}</p>
                            </div>
                            <div class="text-right">
                                <p class="text-sm font-bold text-gray-900 dark:text-white">{{ number_format($customer->total_spent ?? 0, 0) }}</p>
                                <p class="text-xs text-gray-500 dark:text-gray-400">{{ $customer->rent_count ?? 0 }} rentas</p>
                            </div>
                        </div>
                        @empty
                        <div class="text-center py-8 text-gray-500 dark:text-gray-400">
                            No hay datos disponibles
                        </div>
                        @endforelse
                    </div>
                </div>

            </div>

        </div>
    </div>
</x-app-layout>