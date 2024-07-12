@extends('layouts.app-acara')

@section('content')
    <div class="container-fluid">
        <h1 class="mt-4">Acara</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
            <li class="breadcrumb-item active">Acara</li>
        </ol>
        <div class="mb-4">
            <a href="{{ route('create-acara') }}" class="btn btn-success btn-icon-split" type="submit">Tambah Acara</a>
        </div>
        <div class="card mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>Judul Acara</th>
                                <th>Waktu Pelaksanaan</th>
                                <th>Pengisi Acara</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($events as $event)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $event->tanggal }}</td>
                                    <td>{{ $event->judul }}</td>
                                    <td>{{ $event->start_time }} - {{ $event->end_time }}</td>
                                    <td>{{ $event->presenter }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('edit-acara', ['id' => $event->id]) }}"
                                            class="btn btn-primary btn-icon-split"><span class="text">Edit</span></a>
                                        <button type="button" class="btn btn-danger btn-icon-split" data-toggle="modal"
                                            data-target="#modal-hapus{{ $event->id }}">
                                            <span class="text">Hapus</span>
                                        </button>
                                    </td>
                                </tr>
                                <div class="modal fade" id="modal-hapus{{ $event->id }}" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Hapus</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                Apakah Anda yakin ingin menghapus data ini?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Tutup</button>
                                                <form action="{{ route('delete-acara', ['id' => $event->id]) }}"
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
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
