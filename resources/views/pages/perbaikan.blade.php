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
                                    <h3 class="mb-0">Perbaikan</h3>
                                </div>
                                <div class="table-responsive">
                                    <table class="table align-items-center table-flush">
                                        <thead class="thead-light">
                                            <tr>
                                                <th scope="col">No</th>
                                                <th scope="col">Barang</th>
                                                <th scope="col">Biaya</th>
                                                <th scope="col">Tanggal Mulai</th>
                                                <th scope="col">Tanggal Selesai</th>
                                                <th scope="col">Keterangan</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($perbaikan as $item)
                                                <tr>
                                                    <th scope="row">
                                                        <div class="media align-items-center">
                                                            <div class="media-body">
                                                                <span class="mb-0 text-sm">{{ $loop->iteration }}</span>
                                                            </div>
                                                        </div>
                                                    </th>
                                                    <td>
                                                        <div class="form-group">
                                                            <input type="hidden" class="form-control" id="id"
                                                                name="id" value="{{ $item->id }}">
                                                            <label for="kategori">Kategori</label>
                                                            <select class="form-control" id="kategori" name="id_kategori">
                                                                <option value="{{ $item->id_kategori }}">
                                                                    {{ $item->kategori->kategori }}
                                                                </option>
                                                                @foreach ($kategori as $items)
                                                                    <option value="{{ $items->id }}">
                                                                        {{ $items->kategori }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        {{ $item->biaya }}
                                                    </td>
                                                    <td>
                                                        {{ $item->tgl_mulai }}
                                                    </td>
                                                    <td>
                                                        {{ $item->tgl_selesai }}
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
                                                                    data-target="#formModalEdit">
                                                                    Edit
                                                                </a>
                                                                <a class="dropdown-item" href="#">Hapus</a>
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

                    <div class="modal fade" id="formModal" tabindex="-1" role="dialog" aria-labelledby="formModalLabel"
                        aria-hidden="true">
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
                                            <label for="namabrg">Barang</label>
                                            <select class="form-control" id="namabrg">
                                                <option>1</option>
                                                <option>2</option>
                                                <option>3</option>
                                                <option>4</option>
                                                <option>5</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="nama">Biaya</label>
                                            <input type="text" class="form-control" id="namabrg"
                                                placeholder="Rp.10.000">
                                        </div>
                                        <div class="form-group">
                                            <label for="tglpinjam">Tanggal Dipinjam</label>
                                            <input type="date" class="form-control" id="tglpinjam">
                                        </div>
                                        <div class="form-group">
                                            <label for="tglpengembalian">Tanggal Pengembalian</label>
                                            <input type="date" class="form-control" id="tglpengembalian">
                                        </div>
                                        <div class="form-group">
                                            <label for="inputMessage">Keterangan</label>
                                            <textarea class="form-control" id="keterangan" rows="3"></textarea>
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                    <button type="button" class="btn btn-primary">Simpan</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- End Modal Tambah Data --}}

                    {{-- Modal Edut Data --}}

                    <div class="modal fade" id="formModalEdit" tabindex="-1" role="dialog"
                        aria-labelledby="formModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="formModalLabel">Edit Data</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form>
                                        <div class="form-group">
                                            <label for="namabrg">Barang</label>
                                            <select class="form-control" id="namabrg">
                                                <option>1</option>
                                                <option>2</option>
                                                <option>3</option>
                                                <option>4</option>
                                                <option>5</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="nama">Biaya</label>
                                            <input type="text" class="form-control" id="namabrg"
                                                placeholder="Rp.10.000">
                                        </div>
                                        <div class="form-group">
                                            <label for="tglpinjam">Tanggal Dipinjam</label>
                                            <input type="date" class="form-control" id="tglpinjam">
                                        </div>
                                        <div class="form-group">
                                            <label for="tglpengembalian">Tanggal Pengembalian</label>
                                            <input type="date" class="form-control" id="tglpengembalian">
                                        </div>
                                        <div class="form-group">
                                            <label for="inputMessage">Keterangan</label>
                                            <textarea class="form-control" id="keterangan" rows="3"></textarea>
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                    <button type="button" class="btn btn-primary">Simpan</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- End Modal Edit Data --}}

        </body>

    </body>

    </html>
@endsection
