@extends('user.layout')
{{-- @extends('layout.button') --}}
@section('tittle', 'Pengajuan')
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
                                {{-- end tambah --}}
                                <li class="page-item ">
                                    <a class="page-link" href="#" data-toggle="modal" data-target="#new"
                                        style="width: 100px; border-radius: 8% !important;font-weight: bold;
                                        ">
                                        <i class="fa fa-plus" aria-hidden="true"></i>
                                        New Item
                                    </a>
                                </li>
                                <li class="page-item ml-auto">
                                    <a class="page-link" href="#" data-toggle="modal" data-target="#filter"
                                        style="width: 100px; border-radius: 8% !important;font-weight: bold;
                                        ">
                                        Export PDF
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                    <div class="card shadow">
                        <div class="card-header border-0">
                            <h3 class="mb-0">Submission</h3>
                        </div>
                        <div class="table-responsive">
                            <table class="table align-items-center table-flush" id="tabel-peminjaman">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Area</th>
                                        <th scope="col">Item Name</th>
                                        <th scope="col">Stock</th>
                                        <th scope="col">Note</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Action</th>

                                        {{-- <th scope="col">Action</th> --}}
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pengajuan as $item)
                                        <tr>
                                            <th scope="row">
                                                <div class="media align-items-center">
                                                    <div class="media-body">
                                                        <span class="mb-0 text-sm">{{ $loop->iteration }}</span>
                                                    </div>
                                                </div>
                                            </th>
                                            <td>
                                                {{ $item->area->area ?? '-' }}
                                            </td>
                                            <td>
                                                @if ($item->barang)
                                                    {{ $item->barang->nama }}
                                                    @if ($item->new_item)
                                                        , {{ $item->new_item }}
                                                    @endif
                                                @elseif ($item->new_item)
                                                    {{ $item->new_item }}
                                                @endif
                                            </td>

                                            <td>
                                                {{ $item->jumlahBarang }}
                                            </td>
                                            <td>
                                                {{ $item->note }}
                                            </td>
                                            <td>
                                                @if ($item->status->status == 'Waiting Approval')
                                                    <span class="badge badge-dot mr-4">
                                                        <i class="bg-warning"></i> {{ $item->status->status }}
                                                    </span>
                                                @elseif ($item->status->status == 'Loaned')
                                                    <span class="badge badge-dot mr-4">
                                                        <i class="bg-danger"></i> {{ $item->status->status }}
                                                    </span>
                                                @elseif ($item->status->status == 'Returned')
                                                    <span class="badge badge-dot mr-4">
                                                        <i class="bg-danger"></i> {{ $item->status->status }}
                                                    </span>
                                                @endif
                                            </td>



                                            <td class="text-right">
                                                <div class="dropdown">
                                                    <a class="btn btn-sm btn-icon-only text-light" href="#"
                                                        role="button" data-toggle="dropdown" aria-haspopup="true"
                                                        aria-expanded="false">
                                                        <i class="fa fa-ellipsis-v"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">

                                                        <a class="dropdown-item"
                                                            href="{{ asset('/pengajuan/printPDF/' . $item->id) }}">Export
                                                            PDF</a>

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
            <form action="/add-pengajuan" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal fade" id="formModal" tabindex="-1" role="dialog" aria-labelledby="formModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="formModalLabel">Add Data</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="namabrg">Item Name</label>
                                    <select class="form-control" id="namabrg" name="id_barang">
                                        <option value="">Item Name</option>
                                        @foreach ($barang as $items)
                                            <option value="{{ $items->id }}">{{ $items->nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="area">Area</label>
                                    <select class="form-control" id="area" name="id_area">
                                        <option value="">Select Area</option>
                                        @foreach ($area as $items)
                                            <option value="{{ $items->id }}">{{ $items->area }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="area">Kategori</label>
                                    <select class="form-control" id="kategori" name="id_kategori">
                                        <option value="">Select Kategori</option>
                                        @foreach ($kategori as $ka)
                                            <option value="{{ $ka->id }}">{{ $ka->kategori }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="jumlahBarang">Amount</label>
                                    <input type="number" class="form-control" id="jumlahBarang" name="jumlahBarang">
                                </div>
                                <div class="form-group">
                                    <label for="required_date">Required Date</label>
                                    <input type="date" class="form-control" id="required_date" name="required_date">
                                </div>
                                <div class="form-group">
                                    <label for="note">Note</label>
                                    <input type="text" class="form-control" id="note" name="note">
                                </div>
                                {{-- <div class="form-group">
                                    <label for="status">Status</label>
                                    <select class="form-control" id="status" name="id_status">
                                        <option value="">Select Status</option>
                                        @foreach ($status as $items)
                                            <option value="{{ $items->id }}">{{ $items->status }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div> --}}
                                {{-- <div class="form-group">
                                    <label for="tglpinjam">Return Date</label>
                                    <input type="date" class="form-control" id="tgl_pengembalian"
                                        name="tgl_pengembalian">
                                </div> --}}
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

            {{-- Modal Tambah New Data --}}
            <form action="/add-new_item" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal fade" id="new" tabindex="-1" role="dialog" aria-labelledby="formModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="formModalLabel">Submit a New Item</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="namabrg">Item Name</label>
                                    <input type="text" class="form-control" id="new_item" name="new_item">
                                </div>
                                <div class="form-group">
                                    <label for="area">Area</label>
                                    <select class="form-control" id="area" name="id_area">
                                        <option value="">Select Area</option>
                                        @foreach ($area as $items)
                                            <option value="{{ $items->id }}">{{ $items->area }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="area">Kategori</label>
                                    <select class="form-control" id="kategori" name="id_kategori">
                                        <option value="">Select Kategori</option>
                                        @foreach ($kategori as $ka)
                                            <option value="{{ $ka->id }}">{{ $ka->kategori }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="jumlahBarang">Amount</label>
                                    <input type="number" class="form-control" id="jumlahBarang" name="jumlahBarang">
                                </div>
                                <div class="form-group">
                                    <label for="required_date">Required Date</label>
                                    <input type="date" class="form-control" id="required_date" name="required_date">
                                </div>
                                <div class="form-group">
                                    <label for="note">Note</label>
                                    <input type="text" class="form-control" id="note" name="note">
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            {{-- End Modal Tambah New Data --}}

            {{-- Modal Edit Data --}}
            @foreach ($pengajuan as $item)
                <form action="edit-pengajuan" method="POST">
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
                                            <label for="tgl_pengembalian">Loan End Date</label>
                                            <input type="date" class="form-control" id="tgl_pengembalian"
                                                name="tgl_pengembalian">
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
            @endforeach
            {{-- End Modal Edit Data --}}

            <form action="/pengajuan/printPDF" method="POST" target="_blank">
                @csrf
                <input type="hidden" name="id_area" value="{{ request()->input('id_area') }}">
                <input type="hidden" name="request_date" value="{{ request()->input('request_date') }}">
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
                                    <label for="kategori">Filter by Area:</label>
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
                                    <label for="tgl_masuk_awal">Filter by Entry Date </label>
                                    <div class="input-group">
                                        <input type="date" class="form-control" id="request_date" name="request_date"
                                            value="{{ request()->input('request_date') }}">

                                    </div>
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
                const tabel = document.querySelector('#tabel-peminjaman');
                const dataTable = new simpleDatatables.DataTable(tabel)
            </script>
        @endsection
