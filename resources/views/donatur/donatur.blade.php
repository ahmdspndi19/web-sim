@extends('layouts.app-donatur')
@section('donatur')
    <div class="container-fluid">
        <h1 class="mt-4">Donatur</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
            <li class="breadcrumb-item active">Donatur</li>
        </ol>
        <div class="mb-4">
            <a href="{{ route('donatur-add') }}" class="btn btn-success btn-icon-split" type="submit">Tambah Donatur</a>
        </div>
        <div class="card mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr class="text-center">
                                <th>No.</th>
                                <th>Nama</th>
                                <th>Alamat</th>
                                <th>Total</th>
                                <th>Tanggal</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($donaturlist as $data)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td>{{ $data->name }}</td>
                                    <td>{{ $data->alamat }}</td>
                                    <td>Rp. {{ number_format($data->total, 0, ',', '.') }}</td>
                                    <td>{{ $data->created_at }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('donaturedit', ['id' => $data->id]) }}"
                                            class="btn btn-primary btn-icon-split"><span class="text">Edit</span></a>
                                        <button type="button" class="btn btn-danger btn-icon-split" data-toggle="modal"
                                            data-target="#modal-hapus{{ $data->id }}">
                                            <span class="text">Hapus</span>
                                        </button>
                                    </td>
                                </tr>
                                <div class="modal fade" id="modal-hapus{{ $data->id }}" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Hapus</h5>
                                            </div>
                                            <div class="modal-body">
                                                Apakah Anda yakin ingin menghapus data {{ $data->name }}?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Tutup</button>
                                                <form action="{{ route('deletedonatur', ['id' => $data->id]) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Hapus</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
