@extends('user.layout')
{{-- @extends('layout.button') --}}
@section('tittle', 'Barang')
@section('container')
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
                        <div class="alert alert-danger" role="alert">
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
                                <li class="page-item ml-auto">
                                    <a class="page-link" href="#" data-toggle="modal" data-target="#filter"
                                        style="width: 100px; border-radius: 8% !important;font-weight: bold;
                                        ">
                                        Export PDF
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
                            <table class="table align-items-center table-flush" id="tabel-barang">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Kode Barang</th>
                                        <th scope="col">Nama Barang</th>
                                        <th scope="col">Stock</th>
                                        <th scope="col">Kategori</th>
                                        <th scope="col">Type</th>
                                        <th scope="col">Location</th>
                                        <th scope="col">Area</th>
                                        <th scope="col">Level</th>
                                        <th scope="col">Tanggal Masuk</th>
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
                                                {{ $item->code }}
                                            </td>
                                            <td>
                                                {{ $item->nama }}
                                            </td>
                                            <td>
                                                {{ $item->stock }}
                                            </td>
                                            <td>
                                                {{ $item->kategori->kategori ?? '-' }}
                                            </td>
                                            <td>
                                                {{ $item->type->type ?? '-' }}
                                            </td>
                                            <td>
                                                {{ $item->lokasi->lokasi ?? '-' }}
                                            </td>
                                            <td>
                                                {{ $item->area->area ?? '-' }}
                                            </td>
                                            <td>
                                                {{ $item->level ?? '-' }}
                                            </td>
                                            <td>
                                                {{ $item->tgl_masuk }}
                                            </td>
                                            {{-- <td>

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
                                            </td> --}}
                                            <td class="text-right">
                                                <div class="dropdown">
                                                    <a class="btn btn-sm btn-icon-only text-light" href="#"
                                                        role="button" data-toggle="dropdown" aria-haspopup="true"
                                                        aria-expanded="false">
                                                        <i class="fa fa-ellipsis-v"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                        <a class="dropdown-item" href="#" data-toggle="modal"
                                                            data-target="#formModalDetail{{ $item->id }}">
                                                            Detail
                                                        </a>
                                                        <a class="dropdown-item" href="#" data-toggle="modal"
                                                            data-target="#formModalEdit{{ $item->id }}">
                                                            Edit
                                                        </a>
                                                        <a class="dropdown-item"
                                                            href="{{ asset('delete-barang/' . $item->id) }}">Delete</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>


            {{-- filter print --}}
            <form action="/barang/printpdf" method="POST" target="_blank">
                @csrf
                <div class="modal fade" id="filter" tabindex="-1" role="dialog" aria-labelledby="filterLabel"
                    aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="filterLabel">Print PDF</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">

                                <div class="form-group">
                                    <label for="kategori">Filter by Kategori:</label>
                                    <select name="kategori" id="kategori" class="form-control">
                                        <option value="">Select Kategori</option>
                                        @foreach ($kategori as $k)
                                            <option value="{{ $k->id }}"
                                                @if (request()->input('kategori') == $k->id) selected @endif>{{ $k->kategori }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="kepemilikan">Filter by Ownership</label>
                                    <select name="kepemilikan" id="kepemilikan" class="form-control">
                                        <option value="">Select Ownership</option>
                                        @foreach ($barang as $b)
                                            <option value="{{ $b->kepemilikan }}"
                                                @if (request()->input('kepemilikan') == $b->kepemilikan) selected @endif>
                                                {{ $b->kepemilikan }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="tgl_masuk_awal">Filter by Entry Date (Date Range)</label>
                                    <div class="input-group">
                                        <input type="date" class="form-control" id="tgl_masuk_awal" name="tgl_masuk_awal"
                                            value="{{ request()->input('tgl_masuk_awal') }}">
                                        <div class="input-group-prepend input-group-append">
                                            <div class="input-group-text">to</div>
                                        </div>
                                        <input type="date" class="form-control" id="tgl_masuk_akhir"
                                            name="tgl_masuk_akhir" value="{{ request()->input('tgl_masuk_akhir') }}">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="status">Filter by Status</label>
                                    <select class="form-control" id="status" name="status">
                                        <option value="">Select Status</option>
                                        @foreach ($status as $s)
                                            <option value="{{ $s->id }}"
                                                @if (request()->input('status') == $s->id) selected @endif>
                                                {{ $s->status }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="id_area">Filter Berdasarkan Area</label>
                                    <select name="id_area" id="id_area" class="form-control">
                                        <option value="">Select Area</option>
                                        @foreach ($area as $k)
                                            <option value="{{ $k->id }}"
                                                @if (request()->input('id_area') == $k->id) selected @endif>{{ $k->area }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="id_lokasi">Filter Berdasarkan Lokasi</label>
                                    <select name="id_lokasi" id="id_lokasi" class="form-control">
                                        <option value="">Select Lokasi</option>
                                        @foreach ($lokasi as $k)
                                            <option value="{{ $k->id }}"
                                                @if (request()->input('id_lokasi') == $k->id) selected @endif>{{ $k->lokasi }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Print</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            {{-- End Filter Print --}}

        @endsection

        @section('script')
            <script>
                // Menangkap elemen select "Area" dan "Lokasi"
                var areaSelect = document.getElementById('area');
                var lokasiSelect = document.getElementById('lokasi');

                // Menangkap semua opsi dalam elemen select "Lokasi"
                var lokasiOptions = lokasiSelect.getElementsByTagName('option');

                // Ketika area dipilih, atur tampilan opsi lokasi sesuai dengan area yang dipilih
                areaSelect.addEventListener('change', function() {
                    var selectedAreaId = areaSelect.value;

                    // Sembunyikan semua opsi lokasi
                    for (var i = 0; i < lokasiOptions.length; i++) {
                        lokasiOptions[i].style.display = 'none';
                    }

                    // Tampilkan hanya opsi lokasi yang memiliki data-area-id sesuai dengan area yang dipilih
                    for (var i = 0; i < lokasiOptions.length; i++) {
                        if (lokasiOptions[i].getAttribute('data-area-id') === selectedAreaId || lokasiOptions[i].value ===
                            '') {
                            lokasiOptions[i].style.display = 'block';
                        }
                    }

                    // Setel opsi lokasi pertama sebagai pilihan default
                    lokasiSelect.selectedIndex = 0;
                });
            </script>

            <script>
                const tabel = document.querySelector('#tabel-barang');
                const dataTable = new DataTable(tabel, {
                    stateSave: true
                });
            </script>
        @endsection
