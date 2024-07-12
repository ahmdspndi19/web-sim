@extends('layouts.app-laporan')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h2 font-weight-bold mb-4 mt-4 text-gray-800">Cetak Laporan</h1>

        <!-- Card -->
        <div class="card shadow mb-4">
            <div class="card-body">
                <form action="/" method="">

                    <div class="form-group">
                        <label for="judul">Judul</label>
                        <input type="text" class="form-control" name="judul" id="judul" placeholder="Masukkan judul">
                    </div>
                    <div class="form-row">
                        <div class="col-md-6">
                            <label for="tanggal">Tanggal</label>
                            <input type="date" class="form-control" name="tanggal" id="tanggal"
                                placeholder="Masukkan tanggal">
                        </div>
                        <div class="col-md-6">
                            <label for="tanggal">Tanggal</label>
                            <input type="date" class="form-control" name="tanggal" id="tanggal"
                                placeholder="Masukkan tanggal">
                        </div>
                    </div>
                    <div class="form-group">
                    </div>
                    <button type="submit" class="btn btn-success">Submit</button>
                </form>
            </div>
        </div>
        <!-- End Card -->

    </div>
    <!-- /.container-fluid -->
@endsection
