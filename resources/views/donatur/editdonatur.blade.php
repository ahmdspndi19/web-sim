@extends('layouts.app-donatur')
@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h2 font-weight-bold mb-4 mt-4 text-gray-800">Edit Donatur</h1>

        <!-- Card -->
        <div class="card shadow mb-4">
            <div class="card-body">
                <form action="{{ route('updatedonatur', ['id' => $donatur->id]) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="name">Nama</label>
                        <input type="text" class="form-control" name="name" id="name"
                            placeholder="Masukkan Nama Donatur" value="{{ $donatur->name }}">
                    </div>
                    <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <input type="text" class="form-control" name="alamat" id="alamat"
                            placeholder="Masukkan Alamat" value="{{ $donatur->alamat }}" required>
                    </div>
                    <div class="form-group">
                        <label for="total">Nominal</label>
                        <input type="text" class="form-control" name="total" id="total"
                            placeholder="Masukkan Nominal" value="{{ $donatur->total }}" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
        <!-- End Card -->

    </div>
    <!-- /.container-fluid -->
@endsection
