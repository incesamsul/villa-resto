@extends('layouts.v_template')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Yo sap !</h4>
                </div>
                <div class="card-body">
                    <h5>Hi, Selamat Datang Admin</h5>

                </div>
            </div>
        </div>

    </div>
    </section>
@endsection

@section('script')
    <script>
        $('#liDashboard').addClass('active');
    </script>
@endsection
