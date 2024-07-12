@extends('layouts.app-kasmasjid')
@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h2 font-weight-bold mb-4 mt-4 text-gray-800">Tambah Kas Masjid</h1>

        <!-- Card -->
        <div class="card shadow mb-4">
            <div class="card-body">
                <form action="{{route('deletekas',['id'=>$data->id])}}" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="form-group">
                        <label for="keterangan">Keterangan</label>
                        <input type="text" class="form-control" name="keterangan" value="{{$data->keterangan}}" id="keterangan"
                            placeholder="Masukkan Keterangan">

                    </div>

                    <div class="form-group">
                        <label for="jenis">Jenis</label>
                        <select class="form-control" id="jenis" value="{{$data->jenis}}" name="jenis">
                            <option value="Pemasukan">Pemasukan</option>
                            <option value="Pengeluaran">Pengeluaran</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="total">Total</label>
                        <input type="text" class="form-control" value="{{$data->total}}" name="total" id="total"
                            placeholder="Masukkan Nominal">
                    </div>

                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
        <!-- End Card -->

    </div>
    <!-- /.container-fluid -->
@endsection
