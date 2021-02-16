@extends('adminlte::page')

@section('plugins.Chartjs', true)

@section('content_header')
    <div class="col-sm-12">
        <div class="row">
            <div class="col-sm-6">
                <h1 class="m-0">Dashboard</h1>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <form action="{{route('painel-days')}}" method="get">
                        <select class="form-control" name="days" onchange="submit()">
                            <option value="" @if(isset($_GET['days']) && $_GET['days'] == "") {{"selected"}} @endif>Última Hora</option>
                            <option value="7" @if(isset($_GET['days']) && $_GET['days'] == "7") {{"selected"}} @endif>Últimos 7 Dias</option>
                            <option value="30" @if(isset($_GET['days']) && $_GET['days'] == "30") {{"selected"}} @endif)>Últimos 30 Dias</option>
                            <option value="60" @if(isset($_GET['days']) && $_GET['days'] == "60") {{"selected"}} @endif>Últimos 2 Meses</option>
                            <option value="90" @if(isset($_GET['days']) && $_GET['days'] == "90") {{"selected"}} @endif>Últimos 3 Meses</option>
                            <option value="120" @if(isset($_GET['days']) && $_GET['days'] == "120") {{"selected"}} @endif>Últimos 6 Meses</option>
                        </select>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3 col-6">
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{$visitorsCount}}</h3>

                        <p>Acessos</p>
                    </div>
                    <div class="icon">
                        <i class="far fa-fw fa-eye"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>{{$onlineCount}}<sup style="font-size: 20px"></sup></h3>
                        <p>Usuários Online</p>
                    </div>
                    <div class="icon">
                        <i class="far fa-fw fa-heart"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3>{{$pagesCount}}</h3>

                        <p>Páginas</p>
                    </div>
                    <div class="icon">
                        <i class="far fa-fw fa-sticky-note"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3>{{$usersCount}}</h3>

                        <p>Usuários</p>
                    </div>
                    <div class="icon">
                        <i class="far fa-fw fa-user"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <section class="col-lg-7">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-chart-pie mr-1"></i>
                        Gráficos
                    </h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body chartjs-wrapper">
                    <canvas id="pagePie" class="chartjs-render-monitor"></canvas>
                </div>
            </div>
        </section>
    </div>
    <script>
        window.onload = function(){
            let ctx = document.getElementById('pagePie').getContext('2d');
            window.pagePie = new Chart(ctx, {
                type:'pie',
                width: 487,
                height: 250,
                data:{
                    labels: {!! $pageLabels !!},
                    datasets:[{
                        label: {!! $pageLabels !!},
                        data:{{$pageValues}},
                        backgroundColor: '#0000FF',
                        hoverOffset: 4
                    }],
                },
                options: {
                    reponsive: true, 
                    legend: {
                        display: false
                    }
                }
            });
        }
    </script>
@endsection