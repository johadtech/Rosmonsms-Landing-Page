@extends('layouts.admin')

@section('content')
	<!-- [ Main Content ] start -->
	<div class="pc-container">
		<div class="pc-content">
			<div class="row">
				<!-- [ sample-page ] start -->

				<div class="col-md-6 col-xl-3">
					<div class="card social-widget-card bg-dark">
						<div class="card-body">
							<h3 class="text-white m-0">{{ __(digits_formatter($adminCount)) }} </h3><span class="m-t-10">{{ __('Total Admin User') }}</span> <i class="fa fa-user-secret"></i>
						</div>
					</div>
				</div>
				<div class="col-md-6 col-xl-3">
					<div class="card social-widget-card bg-danger">
						<div class="card-body">
							<h3 class="text-white m-0">{{ __(digits_formatter($nonAdminCount)) }} </h3><span class="m-t-10">{{ __('Total User') }}</span> <i class="fa fa-users"></i>
						</div>
					</div>
				</div>

				<div class="col-md-6 col-xl-3">
					<div class="card social-widget-card bg-primary">
						<div class="card-body">
							<h3 class="text-white m-0">{{ __(digits_formatter($postCount)) }} </h3><span class="m-t-10">{{ __('Total Blog Post') }}</span> <i class="fa fa-blog"></i>
						</div>
					</div>
				</div>
				<div class="col-md-6 col-xl-3">
					<div class="card social-widget-card bg-info">
						<div class="card-body">
							<h3 class="text-white m-0">{{ __(digits_formatter($totalBookings)) }} </h3><span class="m-t-10">{{ __('Total Booking') }}</span> <i class="fa fa-swatchbook"></i>
						</div>
					</div>
				</div>

				<div class="col-lg-7 col-md-12">
					<div class="card">
						<div class="card-body">
							<div class="d-flex align-items-start justify-content-between">
								<h5 class="mb-0 text-center">{{ __('System analytics') }}</h5>
								<select class="form-select rounded-3 form-select-sm w-auto d--none" id="timeframe-selector">
									<option value="today">Today</option>
									<option value="weekly">Weekly</option>
									<option value="monthly" selected>Monthly</option>
									<option value="yearly">Yearly</option>
								</select>
							</div>
							<div id="blog-analytics-chart"></div>
						</div>
					</div>
				</div>

				<div class="col-xl-8 col-md-12">
					<div class="card">
						<div class="card-body">
							<div class="d-flex align-items-center justify-content-center text-center mb-3">
								<h5 class="mb-0">{{ __('Recent Login Activities') }}</h5>
							</div>
							<div class="table-responsive">
								<table class="table table-hover" id="pc-dt-simple">
									<thead>
										<tr>
											<th>Fullname</th>
											<th>IP Address</th>
											<th class="text--end">Country Code</th>
											<th>Country</th>
											<th>City</th>
											<th>Latitude</th>
											<th>Browser</th>
											<th>Longitude</th>
											<th>Operating System</th>
										</tr>
									</thead>
									<tbody>
										@if (!$recentLogs->isEmpty())
										@foreach($recentLogs as $item)
										<tr>
											<td>
												<h6 class="mb-2">{{ $item->user->fullname() }}</h6>
											</td>
											<td>{{ $item->user_ip }}</td>
											<td class="text--end f-w-600">{{ $item->country_code }}</td>
											<td class="f-w-600">{{ $item->country }}</td>
											<td class="f-w-600">{{ $item->city }}</td>
											<td>{{ $item->latitude }}</td>
											<td class="text--end f-w-600">{{ $item->browser }}</td>
											<td class="f-w-600">{{ $item->longitude }}</td>
											<td class="f-w-600">{{ $item->os }}</td>
										</tr>
										@endforeach
										@endif
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>


				<div class="col-xl-8 col-md-12">
					<div class="card">
						<div class="card-body">
							<div class="d-flex align-items-center justify-content-center text-center mb-3">
								<h5 class="mb-0">{{ __('Latest Pending Bookings') }}</h5>
							</div>
							<div class="table-responsive">
								<table class="table table-hover" id="pc-dt-simple">
									<thead>
										<tr>
											<th>Fullname</th>
											<th>IP Address</th>
											<th>Email Address</th>
											<th>Mobile Number</th>
											<th>Appointment Day</th>
											<th>Appointment Time</th>
											<th>Status</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
										@if (!$bookings->isEmpty())
										@foreach($bookings as $item)
										<tr>
											<td>
												<h6 class="mb-2">{{ $item->fullname }}</h6>
											</td>
											<td>{{ $item->ip_address }}</td>
											<td class="text--end f-w-600">{{ $item->email }}</td>
											<td class="f-w-600">{{ $item->mobile }}</td>
											<td class="f-w-600">{{ \Carbon\Carbon::parse($item->appointment_date)->format('jS \of F, Y') }}</td>
											<td class="f-w-600">{{ \Carbon\Carbon::parse($item->appointment_time)->format('g:ia') }}</td>
											<td class="f-w-600"><i class="fas fa-circle f-10 {{ $item->status == 1 ? 'text-success' : 'text-info' }} m-r-10"></i> {{ $item->status == 1 ? 'Active' : 'Pending' }}</td>
											<td>
												@if($item->status == 0)
												<a href="{{ route('admin.bookings.review', $item->id) }}" class="avtar avtar-xs btn-light-success">
													<i class="ti ti-check f-20 text-success"></i>
												</a>
												{{--<button onclick="event.preventDefault(); document.getElementById('form-{{ $item->id }}').submit();" class="avtar avtar-xs btn-link-secondary d-none">
													<i class="ti ti-check f-20 text-success"></i>
												</button>
												<form action="{{ route('admin.bookings.approve', $item->id) }}" method="POST" style="display:none;" id="form-{{$item->id}}">
													@csrf
													@method('PUT')
												</form>--}}
												@else
												<a href="{{ route('admin.bookings.edit', $item->id) }}" class="avtar avtar-xs btn-light-danger">
													<i class="ti ti-edit f-20 text-primary"></i>
												</a>
												@endif
												<button onclick="event.preventDefault(); document.getElementById('block-{{ $item->id }}').submit();" class="avtar avtar-xs btn-link-secondary">
													<i class="ti ti-trash f-20 text-danger"></i>
												</button>
												<form action="{{ route('admin.bookings.delete', $item->id) }}" method="POST" style="display:none;" id="block-{{$item->id}}">
													@csrf
													@method('DELETE')
												</form>
											</td>
										</tr>
										@endforeach
										@endif
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>


			</div>
		</div>
		<!-- [ Main Content ] end -->
	</div>
	<!-- [ Main Content ] end -->
		
<script>
    "use strict";

    var data = {
        today: {
            views: {{ $viewsToday }},
            sales: {{ $salesToday }}
        },
        weekly: {
            views: {{ $viewsWeekly }},
            sales: {{ $salesWeekly }}
        },
        monthly: {
            views: {{ $viewsMonthly }},
            sales: {{ $salesMonthly }}
        },
        yearly: {
            views: {{ $viewsYearly }},
            sales: {{ $salesYearly }}
        }
    };

    function renderChart(timeframe) {
        var chartData = data[timeframe];

        new ApexCharts(document.querySelector("#blog-analytics-chart"), {
            chart: {
                type: "area",
                height: 300,
                toolbar: {
                    //show: false
                    show: !1
                }
            },
            colors: ["#e58a00", "#4680ff"],
            dataLabels: {
                //enabled: false
                enabled: !1
            },
            legend: {
                //show: true,
                show: !0,
                position: "top"
            },
            markers: {
                size: 1,
                colors: ["#fff", "#fff", "#fff"],
                strokeColors: ["#e58a00", "#4680ff"],
                strokeWidth: 1,
                shape: "circle",
                hover: {
                    size: 4
                }
            },
            stroke: {
                width: 1,
                curve: "smooth"
            },
            fill: {
                type: "gradient",
                gradient: {
                    shadeIntensity: 1,
                    type: "vertical",
                    inverseColors: false,
                    opacityFrom: 0.5,
                    opacityTo: 0
                }
            },
            grid: {
                show: false
            },
            series: [{
                name: "Views",
                data: [chartData.views]
            }, {
                name: "Sales",
                data: [chartData.sales]
            }],
            xaxis: {
                labels: {
                    hideOverlappingLabels: true
                },
                axisBorder: {
                    show: false
                },
                axisTicks: {
                    show: false
                }
            }
        }).render();
    }

    document.addEventListener("DOMContentLoaded", function() {
        renderChart('monthly');

        document.getElementById('timeframe-selector').addEventListener('change', function() {
            var selectedTimeframe = this.value;
            renderChart(selectedTimeframe);
        });
    });
</script>
@endsection
