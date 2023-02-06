@extends('admin.layout.master')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-around">
            <div class="card bg-primary p-3 d-flex flex-direction-row">
                <h2 class="text-white text-center">User Count</h2>
                <div class="text-white text-center">
                    {{$userCount}}
                </div>
            </div>
            <div class="card bg-primary p-3 d-flex flex-direction-row">
                <h2 class="text-white text-center">Today Income</h2>
                <div class="text-white text-center">
                    {{$totalIncomeCount}}
                </div>
            </div>
            <div class="card bg-primary p-3 d-flex flex-direction-row">
                <h2 class="text-white text-center">Today Outcome</h2>
                <div class="text-white text-center">
                    {{$totalOutcomeCount}}
                </div>
            </div>
            <div class="card bg-primary p-3 d-flex flex-direction-row">
                <h2 class="text-white text-center">Product Count</h2>
                <div class="text-white text-center">
                    {{$totalProductCount}}
                </div>
            </div>
        </div>
    </div>

    <div class="col-6">
        <div class="card card-body">
            <canvas id="sale"></canvas>
        </div>
    </div>
    <div class="col-6">
        <div class="card card-body">
            <canvas id="inout"></canvas>
        </div>
    </div>
</div>
@endsection

@section('js')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('sale');

new Chart(ctx, {
  type: 'bar',
  data: {
    labels: @json($monthArr),
    datasets: [{
      label: '၆လစာအရောင်းစာရင်း',
      data: @json($orderCount),
      borderWidth: 1
    }]
  },
  options: {
    scales: {
      y: {
        beginAtZero: true
      }
    }
  }
});


// income outcome chart
const inout = document.getElementById('inout');

new Chart(inout, {
  type: 'bar',
  data: {
    labels:@json($last6Day),
    datasets: [
        {
      label: '၆ရက်စာ ဝင်ငွေ  စာရင်း ',
      data: @json($totalIncome),
      borderWidth: 1
    },
    {
      label: '၆ရက်စာ ထွက်ငွေ စာရင်း  ',
      data: @json($totalOutcome),
      borderWidth: 1
    },
]
  },
  options: {
    scales: {
      y: {
        beginAtZero: true
      }
    }
  }
});
</script>
@endsection
