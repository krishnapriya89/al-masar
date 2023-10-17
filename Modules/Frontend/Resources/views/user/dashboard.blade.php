@extends('frontend::layouts.app')
@section('title', 'Add New Address')

@section('content')
    <div id="pageWrapper" class="DashBoard InnerPage">
        <section id="proListing">
            <div class="breadCrumb">
                <div class="container">
                    <ul>
                        <li>
                            <a href="{{ route('home') }}">Home </a>
                        </li>
                        <li>
                            <a href="javascript:void(0)">Dashboard</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="container">
                <div class="dashBoardFlx">
                    @include('frontend::includes.sidebar')
                    <div class="rtBx">
                        <div class="dtailBx">
                            {{-- <p>Currently you are logged in at 6.30 pm UAE, hence the order will be delivered only on
                                the next day...</p> --}}
                            <div class="title">Welcome !!!</div>
                            {{-- <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Efficiens dici potest. <br>
                                Equidem, sed audistine modo de Carneade Si alia sentit, inquam, alia loquitur, numquam </p> --}}
                            <div class="gridBx">
                                <div class="item">
                                    <div class="cmnB">
                                        <div class="icon">
                                            <img src="{{ asset('frontend/images/dd1.svg') }}" alt="">
                                        </div>
                                        <div class="txtBx">
                                            <div class="txt">Delivered Order</div>
                                            <div class="num">{{ $delivered_order_count }}</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="cmnB">
                                        <div class="icon">
                                            <img src="{{ asset('frontend/images/dd2.svg') }}" alt="">
                                        </div>
                                        <div class="txtBx">
                                            <div class="txt">Pending</div>
                                            <div class="num">{{ $pending_order_count }}</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="cmnB">
                                        <div class="icon">
                                            <img src="{{ asset('frontend/images/dd2.svg') }}" alt="">
                                        </div>
                                        <div class="txtBx">
                                            <div class="txt">Accepted</div>
                                            <div class="num">{{ $accepted_order_count }}</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="cmnB">
                                        <div class="icon">
                                            <img src="{{ asset('frontend/images/dd2.svg') }}" alt="">
                                        </div>
                                        <div class="txtBx">
                                            <div class="txt">Rejected</div>
                                            <div class="num">{{ $rejected_order_count }}</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="cmnB">
                                        <div class="lBx">
                                            <div class="icon">
                                                <img src="{{ asset('frontend/images/dd2.svg') }}" alt="">
                                            </div>
                                            <div class="ttx">Amount to
                                                be Paid</div>
                                        </div>
                                        <div class="txtBx">
                                            <div class="num">@formattedPrice($total_amount_to_be_py)</div>
                                            <div class="txt">Number of Order Count = {{ $amount_to_be_paid_order_count }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- <div class="chartBox">
                            <div class="chart">
                                <div class="ltXt">Delivered Order Count </div>
                                <canvas id="chart" width="600" height="300"></canvas>
                                <div class="btXt">Months </div>
                            </div>
                        </div> --}}
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.js"></script>
    {{-- <script>
        let ctx = document.getElementById("chart").getContext('2d');

        var gradientStroke = ctx.createLinearGradient(500, 0, 100, 0);
        gradientStroke.addColorStop(0, "#E7151F");
        gradientStroke.addColorStop(1, "#920000");

        var gradientBkgrd = ctx.createLinearGradient(0, 100, 0, 400);
        gradientBkgrd.addColorStop(0, "rgba(244,94,132,0.2)");
        gradientBkgrd.addColorStop(1, "rgba(249,135,94,0)");

        let draw = Chart.controllers.line.prototype.draw;
        Chart.controllers.line = Chart.controllers.line.extend({
            draw: function() {
                draw.apply(this, arguments);
                let ctx = this.chart.chart.ctx;
                let _stroke = ctx.stroke;
                ctx.stroke = function() {
                    ctx.save();
                    //ctx.shadowColor = 'rgba(244,94,132,0.8)';
                    ctx.shadowBlur = 8;
                    ctx.shadowOffsetX = 0;
                    ctx.shadowOffsetY = 6;
                    _stroke.apply(this, arguments)
                    ctx.restore();
                }
            }
        });
        var chart = new Chart(ctx, {
            // The type of chart we want to create
            type: 'line',

            // The data for our dataset
            data: {
                labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sept", "Oct", "Nov", "Dec"],
                datasets: [{
                    label: "",
                    backgroundColor: "rgba(0, 0, 0, 0)",
                    borderColor: gradientStroke,
                    data: [0, 10, 35, 35, 20, 20, 40, 40, 25, 30, 30, 70],
                    pointBorderColor: "rgba(255,255,255,0)",
                    pointBackgroundColor: "rgba(255,255,255,0)",
                    pointBorderWidth: 0,
                    pointHoverRadius: 8,
                    pointHoverBackgroundColor: gradientStroke,
                    pointHoverBorderColor: "rgba(220,220,220,1)",
                    pointHoverBorderWidth: 4,
                    pointRadius: 1,
                    borderWidth: 5,
                    pointHitRadius: 16,

                }]
            },

            // Configuration options go here
            options: {
                tooltips: {
                    backgroundColor: '#fff',
                    displayColors: false,
                    titleFontColor: '#000',
                    bodyFontColor: '#000',
                    fontweight: '400'
                },
                legend: {
                    display: false
                },
                scales: {
                    xAxes: [{
                        gridLines: {
                            display: false
                        }
                    }],
                    yAxes: [{
                        ticks: {
                            // Include a dollar sign in the ticks
                            callback: function(value, index) {
                                return (value);
                            }
                        }
                    }],
                }
            }
        });
    </script> --}}
@endpush
