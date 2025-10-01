<?php

namespace App\Http\Controllers;

use App\Exceptions\InsufficientCreditException;
use App\Models\Customer;
use App\Models\ReturnsAndRents;
use App\Models\Vehicle;
use App\Models\VehicleRating;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReservationController extends Controller
{
    public function showReservations()
    {
        // Obtener el ID del cliente autenticado
        $customerId = Customer::where('user_id', auth()->user()->id)->first()->id;

        // Obtener las reservas con paginación
        $reservations = ReturnsAndRents::with('vehicle', 'ratings')
            ->where('customer_id', $customerId)
            ->paginate(3);

        // Agregar la propiedad `hasRating` a cada reserva
        $reservations->getCollection()->each(function ($reservation) {
            $reservation->hasRating = $reservation->ratings && $reservation->ratings->rent_id === $reservation->id;
        });

        // Cargar los datos del dashboard
        $dashboardData = $this->loadDashboardData($customerId);

        // Pasar los datos a la vista
        return view('my-reservations.reservations', compact('reservations', 'dashboardData'));
    }
    private function loadDashboardData($customerId)
    {
        // Cargar las reservas del cliente
        $reservations = ReturnsAndRents::where('customer_id', $customerId)->get();

        // Calcular los conteos
        $dashboardData = [
            'totalReservations' => $reservations->count(),
            'reservedCount' => $reservations->where('status', 'Reservado')->count(),
            'pendingApprovalCount' => $reservations->where('status', 'Pendiente de aprobación')->count(),
            'returnedCount' => $reservations->where('status', 'Devuelto')->count(),
        ];

        return $dashboardData;
    }
    public function storeReservation(Request $request)
    {
        DB::beginTransaction();
        try {
            // Obtener el cliente autenticado
            $customer = Customer::where('user_id', auth()->user()->id)->first();

            if (!$customer) {
                return redirect()->back()->with('error', 'Cliente no encontrado.');
            }

            // Calcular el monto total de la reserva
            $vehicle = Vehicle::find($request->vehicle_id);
            $totalAmount = $vehicle->amount_per_day * Carbon::parse($request->rent_date)->diffInDays(Carbon::parse($request->return_date));

            // Verificar si el límite de crédito es suficiente
            if ($customer->credit_limit < $totalAmount) {
                throw new InsufficientCreditException('Su límite de crédito es inferior al total del vehículo.');
            }
            // Crear la reserva
            ReturnsAndRents::create([
                'employee_id' => null,
                'customer_id' => $customer->id,
                'vehicle_id' => $request->vehicle_id,
                'rent_date' => $request->rent_date,
                'return_date' => $request->return_date,
                'total_amount' => $totalAmount,
                'status' => 'Pendiente de aprobación',
                'comments' => null,
            ]);

            DB::commit();
            return redirect()->route('showReservations')->with('success', 'Reserva creada correctamente. Su reserva está pendiente de aprobación.');
        } catch (InsufficientCreditException $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Error al crear la reserva');
        }
    }
    public function storeRating(Request $request)
    {
        DB::beginTransaction();
        try {
            VehicleRating::create([
                'vehicle_id' => $request->vehicle_id,
                'rent_id' => $request->rent_id,
                'customer_id' => $request->customer_id,
                'rating' => $request->rating,
                'comment' => $request->comment,
            ]);
            DB::commit();
            return redirect()->route('showReservations')->with('success', 'Calificación creada correctamente.');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Error al crear la calificación');
        }
    }
    public function finalize($id)
    {
        DB::beginTransaction();
        try {
            ReturnsAndRents::where('id', $id)->update(['status' => 'Devuelto']);
            DB::commit();
            return redirect()->route('showReservations')->with('success', 'Reserva finalizada correctamente.');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Error al finalizar la reserva');
        }
    }
    public function cancel($id)
    {
        DB::beginTransaction();
        try {
            ReturnsAndRents::where('id', $id)->update(['status' => 'Cancelado']);
            DB::commit();
            return redirect()->route('showReservations')->with('success', 'Reserva cancelada correctamente.');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Error al finalizar la reserva');
        }
    }
    public function showVehicleReservation(string $id){
        $reservation = ReturnsAndRents::find($id);
        $vehicle = $reservation->vehicle;
        return view('my-reservations.components.show-details', compact('reservation', 'vehicle'));
    }
}
