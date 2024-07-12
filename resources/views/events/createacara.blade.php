@extends('layouts.app-kasmasjid')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h2 font-weight-bold mb-4 mt-4 text-gray-800">Tambah Acara</h1>

        <!-- Card -->
        <div class="card shadow mb-4">
            <div class="card-body">
                <form action="{{ route('store-acara') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="tanggal">Tanggal</label>
                        <input type="date" class="form-control" name="tanggal" id="tanggal"
                            placeholder="Masukkan tanggal">
                    </div>
                    <div class="form-group">
                        <label for="judul">Judul</label>
                        <input type="text" class="form-control" name="judul" id="judul"
                            placeholder="Masukkan judul">
                    </div>
                    <div class="form-row">
                        <div class="col-md-6">
                            <label for="start_time">Waktu Mulai</label>
                            <input type="time" class="form-control" name="start_time" id="start_time"
                                placeholder="Masukkan waktu mulai">
                        </div>
                        <div class="col-md-6">
                            <label for="end_time">Waktu Selesai</label>
                            <input type="time" class="form-control" name="end_time" id="end_time"
                                placeholder="Masukkan waktu selesai">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="presenter">Pembawa Acara</label>
                        <input type="text" class="form-control" name="presenter" id="presenter"
                            placeholder="Masukkan presenter">
                    </div>

                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
        <!-- End Card -->

    </div>
    <!-- /.container-fluid -->
@endsection
