@extends('layouts.app-dashboard')

@section('content')
    <div class="container-fluid">
        <h1 class="mt-4 mb-4">Dashboard {{ $user->username }}</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Dashboard</li>
        </ol>
        <div class="row">
            <div class="col-xl-4 col-md-6">
                <div class="card bg-primary text-white mb-4">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div><strong>
                                <h3>Rp. {{ number_format($saldo['saldo'], 0, ',', '.') }}</h3>
                            </strong>
                            <div>Saldo Kas Masjid</div>
                        </div>
                        <div class="icon-container"><i class="fas fa-wallet fa-3x"></i></div>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="#">View Details</a>
                        <div class="small text-white"><i class="fas fa-eye"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-md-6">
                <div class="card bg-success text-white mb-4">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div><strong>
                                <h3>Rp. {{ number_format($weeklyReport['weeklyPemasukan'], 0, ',', '.') }}</h3>
                            </strong>
                            <div>Pemasukan Per Pekan</div>
                        </div>
                        <div class="icon-container"><i class="fas fa-arrow-up fa-3x"></i></div>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="#">View Details</a>
                        <div class="small text-white"><i class="fas fa-eye"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-md-6">
                <div class="card bg-danger text-white mb-4">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <strong>
                                <h3>Rp. {{ number_format($weeklyReport['weeklyPengeluaran'], 0, ',', '.') }}</h3>
                            </strong>
                            <div>Pengeluaran Per Pekan</div>
                        </div>
                        <div class="icon-container"><i class="fas fa-arrow-down fa-3x"></i></div>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="#">View Details</a>
                        <div class="small text-white"><i class="fas fa-eye"></i></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-4 col-md-6">
                <div class="card bg-secondary text-white mb-4">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <strong>
                                <h1>{{ $jumlahDonatur }}</h1>
                            </strong>
                            <div>Donatur</div>
                        </div>
                        <div class="icon-container"><i class="fas fa-users fa-3x"></i></div>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="#">View Details</a>
                        <div class="small text-white"><i class="fas fa-eye"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-md-6">
                <div class="card bg-warning text-white mb-4">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <strong>
                                <h1>{{ $weeklyEvents->count() }}</h1>
                            </strong>
                            <div>Acara</div>
                        </div>
                        <div class="icon-container"><i class="fas fa-calendar-alt fa-3x"></i></div>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" data-toggle="collapse" href="#weeklyEventsCollapse"
                            role="button" aria-expanded="false" aria-controls="weeklyEventsCollapse">View Details</a>
                        <div class="small text-white"><i class="fas fa-arrow-down"></i></div>
                    </div>
                    <div class="collapse" id="weeklyEventsCollapse">
                        <div class="card-body text-light">
                            <ul>
                                @foreach ($weeklyEvents as $event)
                                    <strong>
                                        <li>{{ $event->dayName }}, {{ $event->tanggal }}: {{ $event->judul }}
                                            ({{ $event->start_time }} - {{ $event->end_time }})
                                            ({{ $event->presenter }})</li>
                                    </strong>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-md-6">
                <div class="card bg-info text-white mb-4">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <strong>
                                <h1>{{ $upcomingEvents->count() }}</h1>
                            </strong>
                            <div>Acara yang Akan Datang</div>
                        </div>
                        <div class="icon-container"><i class="fas fa-calendar-check fa-3x"></i></div>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" data-toggle="collapse" href="#upcomingEventsCollapse"
                            role="button" aria-expanded="false" aria-controls="upcomingEventsCollapse">View Details</a>
                        <div class="small text-white"><i class="fas fa-arrow-down"></i></div>
                    </div>
                    <div class="collapse" id="upcomingEventsCollapse">
                        <div class="card-body text-light">
                            <ul>
                                @foreach ($upcomingEvents as $event)
                                    <strong>
                                        <li>{{ $event->dayName }}, {{ $event->tanggal }}: {{ $event->judul }}
                                            ({{ $event->start_time }} - {{ $event->end_time }})
                                            ({{ $event->presenter }})</li>
                                    </strong>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

        </div>


        <div class="row">
            <div class="col-xl-6">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-chart-bar mr-1"></i>
                        Grafik Per Bulan
                    </div>
                    <div class="card-body"><canvas id="monthlyBarChart" width="100%" height="40"></canvas></div>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-chart-bar mr-1"></i>
                        Grafik Per Pekan
                    </div>
                    <div class="card-body"><canvas id="weeklyBarChart" width="100%" height="40"></canvas></div>
                </div>
            </div>
        </div>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            fetch("{{ route('chart.data') }}")
                .then(response => response.json())
                .then(data => {
                    function getMonthName(monthNumber) {
                        const monthNames = ["January", "February", "March", "April", "May", "June", "July",
                            "August", "September", "October", "November", "December"
                        ];
                        return monthNames[monthNumber - 1];
                    }

                    const monthlyLabels = [];
                    const monthlyIncome = [];
                    const monthlyExpense = [];

                    for (const [year, months] of Object.entries(data.monthly)) {
                        for (const [month, types] of Object.entries(months)) {
                            monthlyLabels.push(getMonthName(parseInt(month)) + ' ' + year);
                            monthlyIncome.push(types.Pemasukan ? types.Pemasukan[0].total : 0);
                            monthlyExpense.push(types.Pengeluaran ? types.Pengeluaran[0].total : 0);
                        }
                    }

                    const weeklyLabels = [];
                    const weeklyIncome = [];
                    const weeklyExpense = [];

                    for (const [year, weeks] of Object.entries(data.weekly)) {
                        for (const [week, types] of Object.entries(weeks)) {
                            weeklyLabels.push(`Week ${week} ${year}`);
                            weeklyIncome.push(types.Pemasukan ? types.Pemasukan[0].total : 0);
                            weeklyExpense.push(types.Pengeluaran ? types.Pengeluaran[0].total : 0);
                        }
                    }

                    new Chart(document.getElementById("monthlyBarChart"), {
                        type: 'bar',
                        data: {
                            labels: monthlyLabels,
                            datasets: [{
                                    label: "Pemasukan",
                                    backgroundColor: "rgba(2,117,216,1)",
                                    borderColor: "rgba(2,117,216,1)",
                                    data: monthlyIncome,
                                },
                                {
                                    label: "Pengeluaran",
                                    backgroundColor: "rgba(217,83,79,1)",
                                    borderColor: "rgba(217,83,79,1)",
                                    data: monthlyExpense,
                                }
                            ],
                        },
                        options: {
                            scales: {
                                x: {
                                    grid: {
                                        display: false
                                    },
                                    ticks: {
                                        maxTicksLimit: 6
                                    }
                                },
                                y: {
                                    min: 0,
                                    maxTicksLimit: 5,
                                    grid: {
                                        display: true
                                    }
                                },
                            },
                            plugins: {
                                legend: {
                                    display: true
                                }
                            }
                        }
                    });

                    new Chart(document.getElementById("weeklyBarChart"), {
                        type: 'bar',
                        data: {
                            labels: weeklyLabels,
                            datasets: [{
                                    label: "Pemasukan",
                                    backgroundColor: "rgba(2,117,216,1)",
                                    borderColor: "rgba(2,117,216,1)",
                                    data: weeklyIncome,
                                },
                                {
                                    label: "Pengeluaran",
                                    backgroundColor: "rgba(217,83,79,1)",
                                    borderColor: "rgba(217,83,79,1)",
                                    data: weeklyExpense,
                                }
                            ],
                        },
                        options: {
                            scales: {
                                x: {
                                    grid: {
                                        display: false
                                    },
                                    ticks: {
                                        maxTicksLimit: 6
                                    }
                                },
                                y: {
                                    min: 0,
                                    maxTicksLimit: 5,
                                    grid: {
                                        display: true
                                    }
                                },
                            },
                            plugins: {
                                legend: {
                                    display: true
                                }
                            }
                        }
                    });
                });
        });
    </script>
@endsection
