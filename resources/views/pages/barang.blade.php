@extends('layout.navbar')
{{-- @extends('layout.button') --}}

@section('container')
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Document</title>
        <link rel="stylesheet" href="./css/table.css">
    </head>

    <body>
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">

        <body>

            <div class="main-content">
                <div class="container mt-7">
                    <!-- Table -->
                    <div class="row">
                        <div class="col">
                            @if ($message = Session::get('success'))
                                <div class="alert alert-success" role="alert">
                                    {{ $message }}
                                </div>
                            @endif
                            @if ($message = Session::get('error'))
                                <div class="alert alert-error" role="alert">
                                    {{ $message }}
                                </div>
                            @endif
                            <div class="card-header border-0">
                                <nav aria-label="...">
                                    <ul class="pagination mb-0">
                                        {{-- tambah --}}
                                        <li class="page-item"><a class="page-link" href="#" data-toggle="modal"
                                                data-target="#formModal"><i class="fa fa-plus" aria-hidden="true"></i>
                                            </a>
                                        </li>
                                        {{-- end tambah --}}
                                    </ul>
                                </nav>
                            </div>
                            <div class="card shadow">
                                <div class="card-header border-0">
                                    <h3 class="mb-0">Barang</h3>
                                </div>
                                <div class="table-responsive">
                                    <table class="table align-items-center table-flush">
                                        <thead class="thead-light">
                                            <tr>
                                                <th scope="col">No</th>
                                                <th scope="col">Nama Barang</th>
                                                <th scope="col">Kategori</th>
                                                <th scope="col">Kepemilikan</th>
                                                <th scope="col">Tanggal Masuk</th>
                                                <th scope="col">Status</th>
                                                <th scope="col">Keterangan</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($barang as $item)
                                                <tr>
                                                    <th scope="row">
                                                        <div class="media align-items-center">
                                                            <div class="media-body">
                                                                <span class="mb-0 text-sm">{{ $loop->iteration }}</span>
                                                            </div>
                                                        </div>
                                                    </th>
                                                    <td>
                                                        {{ $item->nama }}
                                                    </td>
                                                    <td>
                                                        {{ $item->kategori->kategori }}
                                                    </td>
                                                    <td>
                                                        {{ $item->kepemilikan }}
                                                    </td>
                                                    <td>
                                                        {{ $item->tgl_masuk }}
                                                    </td>
                                                    <td>

                                                        @if ($item->status->status == 'Tersedia')
                                                            <span class="badge badge-dot mr-4">
                                                                <i class="bg-success"></i> {{ $item->status->status }}
                                                            </span>
                                                        @elseif ($item->status->status == 'Dipinjam')
                                                            <span class="badge badge-dot mr-4">
                                                                <i class="bg-danger"></i> {{ $item->status->status }}
                                                            </span>
                                                        @elseif ($item->status->status == 'Diperbaiki')
                                                            <span class="badge badge-dot mr-4">
                                                                <i class="bg-danger"></i> {{ $item->status->status }}
                                                            </span>
                                                        @endif


                                                    </td>
                                                    <td>
                                                        {{ $item->keterangan }}
                                                    </td>

                                                    <td class="text-right">
                                                        <div class="dropdown">
                                                            <a class="btn btn-sm btn-icon-only text-light" href="#"
                                                                role="button" data-toggle="dropdown" aria-haspopup="true"
                                                                aria-expanded="false">
                                                                <i class="fa fa-ellipsis-v"></i>
                                                            </a>
                                                            <div
                                                                class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                                <a class="dropdown-item" href="#" data-toggle="modal"
                                                                    data-target="#formModalDetail{{ $item->id }}">
                                                                    Detail
                                                                </a>
                                                                <a class="dropdown-item" href="#" data-toggle="modal"
                                                                    data-target="#formModalEdit{{ $item->id }}">
                                                                    Edit
                                                                </a>
                                                                <a class="dropdown-item"
                                                                    href="{{ asset('delete-barang/' . $item->id) }}">Hapus</a>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>

                                </div>
                                <div class="card-footer py-4">
                                    <nav aria-label="...">
                                        <ul class="pagination justify-content-end mb-0">
                                            <li class="page-item disabled">
                                                <a class="page-link" href="#" tabindex="-1">
                                                    <i class="fa fa-angle-left"></i>
                                                    <span class="sr-only">Previous</span>
                                                </a>
                                            </li>
                                            <li class="page-item active">
                                                <a class="page-link" href="#">1</a>
                                            </li>
                                            <li class="page-item">
                                                <a class="page-link" href="#">2 <span
                                                        class="sr-only">(current)</span></a>
                                            </li>
                                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                                            <li class="page-item">
                                                <a class="page-link" href="#">
                                                    <i class="fa fa-angle-right"></i>
                                                    <span class="sr-only">Next</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Modal Tambah Data --}}
                    <form action="/add-barang" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="modal fade" id="formModal" tabindex="-1" role="dialog"
                            aria-labelledby="formModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">

                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="formModalLabel">Tambah Data</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form>
                                            <div class="form-group">
                                                <label for="nama">Nama Barang</label>
                                                <input type="text" class="form-control" id="nama" name="nama"
                                                    placeholder="Nama Barang">
                                            </div>
                                            <div class="form-group">
                                                <label for="kategori">Kategori</label>
                                                <select class="form-control" id="kategori" name="id_kategori">
                                                    <option value="">Pilih Kategori</option>
                                                    @foreach ($kategori as $items)
                                                        <option value="{{ $items->id }}">{{ $items->kategori }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="kepemilikan">Kepemilikan</label>
                                                <input type="text" class="form-control" id="kepemilikan"
                                                    name="kepemilikan" placeholder="Zhorief">
                                            </div>
                                            <div class="form-group">
                                                <label for="lokasi">Lokasi</label>
                                                <select class="form-control" id="lokasi" name="id_lokasi">
                                                    <option value="">Pilih Lokasi</option>
                                                    @foreach ($lokasi as $items)
                                                        <option value="{{ $items->id }}">{{ $items->lokasi }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="tgl_masuk">Tanggal Masuk</label>
                                                <input type="date" class="form-control" id="tgl_masuk"
                                                    name="tgl_masuk">
                                            </div>
                                            <div class="form-group">
                                                <label for="status">Status</label>
                                                <select class="form-control" id="status" name="id_status">
                                                    <option value="">Pilih Status</option>
                                                    @foreach ($status as $items)
                                                        <option value="{{ $items->id }}">{{ $items->status }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="inputMessage">Keterangan</label>
                                                <textarea class="form-control" id="keterangan" rows="3" name="keterangan"></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="foto">Foto Barang</label>
                                                <input type="file" class="form-control" id="foto"
                                                    name="foto">
                                            </div>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">Tutup</button>
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    {{-- End Modal Tambah Data --}}

                    {{-- Modal Edit Data --}}
                    @foreach ($barang as $item)
                        <form action="edit-barang" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="modal fade" id="formModalEdit{{ $item->id }}" tabindex="-1" role="dialog"
                                aria-labelledby="formModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="formModalLabel">Edit Data</h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form>
                                                <div class="form-group">
                                                    <input type="hidden" class="form-control" id="id"
                                                        name="id" value="{{ $item->id }}">
                                                    <label for="nama">Nama Barang</label>
                                                    <input type="text" class="form-control" id="nama"
                                                        name="nama" placeholder="Nama Barang"
                                                        value="{{ $item->nama }}">
                                                </div>
                                                <div class="form-group">
                                                    <input type="hidden" class="form-control" id="id"
                                                        name="id" value="{{ $item->id }}">
                                                    <label for="kategori">Kategori</label>
                                                    <select class="form-control" id="kategori" name="id_kategori">
                                                        <option value="{{ $item->id_kategori }}">
                                                            {{ $item->kategori->kategori }}
                                                        </option>
                                                        @foreach ($kategori as $items)
                                                            <option value="{{ $items->id }}">{{ $items->kategori }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <input type="hidden" class="form-control" id="id"
                                                        name="id" value="{{ $item->id }}">
                                                    <label for="kepemilikan">Kepemilikan</label>
                                                    <input type="text" class="form-control" id="kepemilikan"
                                                        name="kepemilikan" placeholder="Zhorief"
                                                        value="{{ $item->kepemilikan }}">
                                                </div>
                                                <div class="form-group">
                                                    <input type="hidden" class="form-control" id="id"
                                                        name="id" value="{{ $item->id }}">
                                                    <label for="lokasi">Lokasi</label>
                                                    <select class="form-control" id="lokasi" name="id_lokasi">
                                                        <option value="{{ $item->id_lokasi }}">
                                                            {{ $item->lokasi->lokasi }}
                                                        </option>
                                                        @foreach ($lokasi as $items)
                                                            <option value="{{ $items->id }}">{{ $items->lokasi }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <input type="hidden" class="form-control" id="id"
                                                        name="id" value="{{ $item->id }}">
                                                    <label for="tgl_masuk">Tanggal Masuk</label>
                                                    <input type="date" class="form-control" id="tgl_masuk"
                                                        name="tgl_masuk" value="{{ $item->tgl_masuk }}">
                                                </div>
                                                <div class="form-group">
                                                    <label for="status">Status</label>
                                                    <select class="form-control" id="status" name="id_status">
                                                        <option value="{{ $item->id }}">{{ $item->status->status }}
                                                        </option>
                                                        @foreach ($status as $items)
                                                            <option value="{{ $items->id }}">{{ $items->status }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <input type="hidden" class="form-control" id="id"
                                                        name="id" value="{{ $item->id }}">
                                                    <label for="keterangan">Keterangan</label>
                                                    <textarea class="form-control" id="keterangan" rows="3" name="keterangan" value="{{ $item->keterangan }}">{{ $item->keterangan }}</textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label for="foto">Foto Barang</label>
                                                    <input type="file" class="form-control" id="foto"
                                                        name="foto">
                                                    <input class=" form-control" type="hidden" name="gambarLama"
                                                        value="{{ $item->foto }}">
                                                </div>
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Tutup</button>
                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    @endforeach

                    {{-- End Modal Edit Data --}}

                    {{-- Modal Detail Barang --}}
                    @foreach ($barang as $item)
                        <div class="modal fade" id="formModalDetail{{ $item->id }}" tabindex="-1" role="dialog"
                            aria-labelledby="formModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="formModalLabel">Detail Barang</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form>
                                            <div class="form-group">
                                                <div class="card" style="width: 29rem;">
                                                    <img src="{{ asset('images/' . $item->foto) }}" class="card-img-top"
                                                        alt="{{ $item->foto }}">
                                                    <ul class="list-group list-group-flush">
                                                        <li class="list-group-item">

                                                            <h5 class="card-title">Nama Barang</h5>
                                                            <p class="card-text">{{ $item->nama }}</p>
                                                        </li>
                                                        <li class="list-group-item">
                                                            <h5 class="card-title">Tanggal Masuk</h5>
                                                            <p class="card-text">{{ $item->tgl_masuk }}</p>
                                                        </li>
                                                        <li class="list-group-item">
                                                            <h5 class="card-title">Kepemilikan</h5>
                                                            <p class="card-text">{{ $item->kepemilikan }}</p>
                                                        </li>
                                                        <li class="list-group-item">
                                                            <h5 class="card-title">Kategori</h5>
                                                            <p class="card-text"> {{ $item->kategori->kategori }}</p>
                                                        </li>
                                                        <li class="list-group-item">
                                                            <h5 class="card-title">Lokasi</h5>
                                                            <p class="card-text"> {{ $item->lokasi->lokasi }}</p>
                                                        </li>
                                                        <li class="list-group-item">
                                                            <h5 class="card-title">Status</h5>
                                                            <p class="card-text"> {{ $item->status->status }}</p>
                                                        </li>
                                                        <li class="list-group-item">
                                                            <h5 class="card-title">Keterangan</h5>
                                                            <p class="card-text"> {{ $item->keterangan }}</p>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">Tutup</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    {{-- End Modal Detail Barang --}}
        </body>

    </body>

    </html>
@endsection
