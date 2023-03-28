@extends('layouts.v_template')

@section('content')
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header d-flex  justify-content-between">
                        <h4>Detail Pos</h4>
                        <div class="table-tools d-flex justify-content-around ">
                            <a href="{{ URL::to('/admin/transaksi_pos') }}" class="btn btn-info"><i
                                    class="fas fa-arrow-left"></i></a>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <table class="table table-striped table-hover table-user table-action-hover" id="table-data">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <td>nama menu</td>
                                    <td>Harga menu</td>
                                    <td>qty</td>
                                    <td>harga * qty</td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($transaksi as $row)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $row->menu->nama_menu }}</td>
                                        <td>{{ $row->menu->harga }}</td>
                                        <td>{{ $row->qty }}</td>
                                        <td> Rp. {{ number_format($row->menu->harga * $row->qty) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('script')
    <script>
        $(document).ready(function() {





        });

        $('#liTransaksiPos').addClass('active');
    </script>
@endsection
