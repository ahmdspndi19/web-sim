@extends('layouts.app-donatur')
@section('donatur')
    <div class="container-fluid">
        <h1 class="mt-4">Kas Masjid</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
            <li class="breadcrumb-item active">Kas Masjid</li>
        </ol>
        <div class="mb-4">
            <a href="{{ route('create') }}" class="btn btn-success btn-icon-split" type="submit">Tambah Kas Masjid</a>
        </div>
        <div class="card mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr class="text-center">
                                <th>No.</th>
                                <th>Keterangan</th>
                                <th>Jenis Transaksi</th>
                                <th>Total</th>
                                <th>Tanggal</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $d)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td>{{ $d->keterangan }}</td>
                                    <td>{{ $d->jenis }}</td>
                                    <td>
                                        @if ($d->jenis == 'Pemasukan')
                                            <i class="fas fa-arrow-up" style="color: green;"></i>
                                        @else
                                            <i class="fas fa-arrow-down" style="color: red;"></i>
                                        @endif
                                        Rp. {{ number_format($d->total, 0, ',', '.') }}
                                    </td>
                                    </td>
                                    <td>{{ $d->created_at }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('kasedit', ['id' => $d->id]) }}"
                                            class="btn btn-primary btn-icon-split"><span class="text">Edit</span></a>
                                        <button type="button" class="btn btn-danger btn-icon-split" data-toggle="modal"
                                            data-target="#modal-hapus{{ $d->id }}">
                                            <span class="text">Hapus</span>
                                        </button>
                                    </td>
                                </tr>
                                <div class="modal fade" id="modal-hapus{{ $d->id }}" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Hapus</h5>
                                            </div>
                                            <div class="modal-body">
                                                Apakah Anda yakin ingin menghapus data ini?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Tutup</button>
                                                <form action="{{ route('deletekas', ['id' => $d->id]) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Hapus</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
