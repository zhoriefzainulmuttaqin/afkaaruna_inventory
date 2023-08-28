@extends('layout.navbar')
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

            {{-- Modal Tambah Data --}}
            <form action="/add-barang" method="POST" enctype="multipart/form-data">
                @csrf
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
                                        <label for="nama">Nama Barang</label>
                                        <input type="text" class="form-control" id="nama" name="nama"
                                            placeholder="Name">
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
                                        <label for="area">Area</label>
                                        <select class="form-control" id="area" name="id_area">
                                            <option value="">Pilih Area</option>
                                            @foreach ($area as $items)
                                                <option value="{{ $items->id }}">{{ $items->area }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="lokasi">Lokasi</label>
                                        <select class="form-control" id="lokasi" name="id_lokasi">
                                            <option value="">Pilih Lokasi</option>
                                            @foreach ($lokasi as $items)
                                                <option value="{{ $items->id }}"
                                                    data-area-id="{{ $items->id_area }}">{{ $items->lokasi }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="area">Type</label>
                                        <select class="form-control" id="type" name="id_type">
                                            <option value="">Pilih Type</option>
                                            @foreach ($type as $items)
                                                <option value="{{ $items->id }}">{{ $items->type }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="tgl_masuk">Tanggal Masuk</label>
                                        <input type="date" class="form-control" id="tgl_masuk" name="tgl_masuk">
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
                                        <label for="inputMessage">Deskripsi</label>
                                        <textarea class="form-control" id="keterangan" rows="3" name="keterangan"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="stock">Stock</label>
                                        <input class="form-control" id="stock" rows="3" name="stock"
                                            type="number"></input>
                                    </div>
                                    <div class="form-group">
                                        <label for="foto">Gambar</label>
                                        <input type="file" class="form-control" id="foto" name="foto">
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save</button>
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
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form>
                                        <div class="form-group">
                                            <input type="hidden" class="form-control" id="id" name="id"
                                                value="{{ $item->id }}">
                                            <label for="nama">Nama Barang</label>
                                            <input type="text" class="form-control" id="nama" name="nama"
                                                placeholder="Nama Barang" value="{{ $item->nama }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="kategori">Kategori</label>
                                            <select class="form-control" id="kategori" name="id_kategori">
                                                <option value="{{ $item->id_kategori }}">
                                                    {{ $item->kategori->kategori ?? 'not selected' }}
                                                </option>
                                                @foreach ($kategori as $items)
                                                    <option value="{{ $items->id }}">{{ $items->kategori }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <input type="hidden" class="form-control" id="id" name="id"
                                                value="{{ $item->id }}">
                                            <label for="area">Area</label>
                                            <select class="form-control" id="area" name="id_area">
                                                <option value="{{ $item->id_area }}">
                                                    {{ $item->area->area ?? 'not selected' }}
                                                </option>
                                                @foreach ($area as $items)
                                                    <option value="{{ $items->id }}">
                                                        {{ $items->area }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="lokasi">Lokasi</label>
                                            <select class="form-control" id="lokasi" name="id_lokasi">
                                                @foreach ($lokasi as $items)
                                                    <option value="{{ $items->id_area }}"
                                                        data-area-id="{{ $items->id_area }}">{{ $items->lokasi }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="lokasi">Type</label>
                                            <select class="form-control" id="type" name="id_type">
                                                <option value=""">
                                                    {{ $item->type->type ?? 'not selected' }}

                                                </option>
                                                @foreach ($type as $items)
                                                    <option value="{{ $items->id }}">{{ $items->type }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="tgl_masuk">Tanggal Masuk</label>
                                            <input type="date" class="form-control" id="tgl_masuk" name="tgl_masuk"
                                                value="{{ $item->tgl_masuk }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="status">Status</label>
                                            <select class="form-control" id="status" name="id_status">
                                                <option value="{{ $item->id_status }}">
                                                    {{ $item->status->status ?? 'not selected' }}
                                                </option>
                                                @foreach ($status as $items)
                                                    <option value="{{ $items->id }}">{{ $items->status }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="keterangan">Deskripsi</label>
                                            <textarea class="form-control" id="keterangan" rows="3" name="keterangan" value="{{ $item->keterangan }}">{{ $item->keterangan }}</textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="stock">Stock</label>
                                            <input class="form-control" id="stock" rows="3" name="stock"
                                                type="number" value="{{ $item->stock }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="foto">Gambar</label>
                                            <input type="file" class="form-control" id="foto" name="foto">
                                            <input class=" form-control" type="hidden" name="gambarLama"
                                                value="{{ $item->foto }}">
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
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
                                <h5 class="modal-title" id="formModalLabel">Details</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form>
                                    <div class="form-group">
                                        <div class="card" style="width: 29rem;">
                                            <img src="{{ asset('foto_gudang/' . $item->foto) }}" class="card-img-top"
                                                alt="{{ $item->foto }}">
                                            <ul class="list-group list-group-flush">
                                                <li class="list-group-item">
                                                    <h5 class="card-title">Nama Barang</h5>
                                                    <p class="card-text">{{ $item->nama }}</p>
                                                </li>
                                                <li class="list-group-item">
                                                    <h5 class="card-title">Kode Barang</h5>
                                                    <p class="card-text">{{ $item->code }}</p>
                                                </li>
                                                <li class="list-group-item">
                                                    <h5 class="card-title">Tanggal Masuk</h5>
                                                    <p class="card-text">{{ $item->tgl_masuk }}</p>
                                                </li>
                                                <li class="list-group-item">
                                                    <h5 class="card-title">Kategori</h5>
                                                    <p class="card-text">
                                                        {{ $item->kategori->kategori ?? 'not selected' }}</p>
                                                </li>
                                                <li class="list-group-item">
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <h5 class="card-title">Lokasi</h5>
                                                            <p class="card-text">
                                                                {{ $item->lokasi->lokasi ?? 'not selected' }}</p>
                                                        </div>
                                                        <div class="col-6">
                                                            <h5 class="card-title">Area</h5>
                                                            <p class="card-text">
                                                                {{ $item->lokasi->area->area ?? 'not selected' }}</p>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="list-group-item">
                                                    <h5 class="card-title">Status</h5>
                                                    <p class="card-text"> {{ $item->status->status ?? 'not selected' }}
                                                    </p>
                                                </li>
                                                <li class="list-group-item">
                                                    <h5 class="card-title">Deskripsi</h5>
                                                    <p class="card-text"> {{ $item->keterangan }}</p>
                                                </li>
                                                <li class="list-group-item">
                                                    <h5 class="card-title">Stock</h5>
                                                    <p class="card-text"> {{ $item->stock }}</p>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

            {{-- End Modal Detail Barang --}}

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
                                    <label for="kategori">Filter Berdasarkan Kategori:</label>
                                    <select name="kategori" id="kategori" class="form-control">
                                        <option value="">Pilih Kategori</option>
                                        @foreach ($kategori as $k)
                                            <option value="{{ $k->id }}"
                                                @if (request()->input('kategori') == $k->id) selected @endif>{{ $k->kategori }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="tgl_masuk_awal">Filter Berdasarkan Rentang Tanggal</label>
                                    <div class="input-group">
                                        <input type="date" class="form-control" id="tgl_masuk_awal"
                                            name="tgl_masuk_awal" value="{{ request()->input('tgl_masuk_awal') }}">
                                        <div class="input-group-prepend input-group-append">
                                            <div class="input-group-text">to</div>
                                        </div>
                                        <input type="date" class="form-control" id="tgl_masuk_akhir"
                                            name="tgl_masuk_akhir" value="{{ request()->input('tgl_masuk_akhir') }}">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="status">Filter Berdasarkan Status</label>
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
                const dataTable = new simpleDatatables.DataTable(tabel)
            </script>
        @endsection
