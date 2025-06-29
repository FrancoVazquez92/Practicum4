@extends('layouts.master')

@section('content')
<div class="container">
    <h1>📊 Dashboard Hospital</h1>

    @if (!empty($alertas))
        @foreach ($alertas as $alerta)
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                {{ $alerta }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
            </div>
        @endforeach
    @endif
    <div class="row text-center my-4">
        <div class="col-md-3">
            <div class="card shadow">
                <div class="card-body">
                    <h5>Total Citas</h5>
                    <h2 id="totalCitas">{{$totalCitas}}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow">
                <div class="card-body">
                    <h5>Citas Hoy</h5>
                    <h2 id="citasHoy">{{$citasHoy}}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow">
                <div class="card-body">
                    <h5>Pacientes</h5>
                    <h2 id="totalPacientes">{{$pacientes}}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow">
                <div class="card-body">
                    <h5>Médicos</h5>
                    <h2 id="totalMedicos">{{$medicos}}</h2>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-4">
        <h4>📈 Tendencia de Citas por Mes</h4>
        <canvas id="graficoCitas"></canvas>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    
    const meses = @json($citasPorMes->pluck('mes_nombre'));
    const totales = @json($citasPorMes->pluck('total'));
    

    const ctx = document.getElementById('graficoCitas').getContext('2d');
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: meses,
            datasets: [{
                label: 'Citas por mes',
                data: totales,
                borderColor: 'rgba(75, 192, 192, 1)',
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                tension: 0.4
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { display: true },
                title: {
                    display: true,
                    text: 'Tendencia de citas médicas por mes'
                }
            }
        }
    });
});
</script>
@endsection
