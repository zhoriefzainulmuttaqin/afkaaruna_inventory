@extends('layout.navbar')
{{-- @extends('layout.button') --}}
@section('tittle', 'Peminjaman')
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
                            <h3 class="mb-0">Item Lending</h3>
                        </div>
                        <div class="table-responsive">
                            <table class="table align-items-center table-flush" id="tabel-peminjaman">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Item</th>
                                        <th scope="col">Loanee</th>
                                        <th scope="col">Loan Start Date</th>
                                        <th scope="col">Return Date</th>
                                        <th scope="col">Amount</th>
                                        <th scope="col">Description</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($peminjaman as $item)
                                        <tr>
                                            <th scope="row">
                                                <div class="media align-items-center">
                                                    <div class="media-body">
                                                        <span class="mb-0 text-sm">{{ $loop->iteration }}</span>
                                                    </div>
                                                </div>
                                            </th>
                                            <td>
                                                {{ $item->barang->nama }}
                                            </td>
                                            <td>
                                                {{ $item->peminjam }}
                                            </td>
                                            <td>
                                                {{ $item->tgl_peminjaman }}
                                            </td>
                                            <td>
                                                {{ $item->tgl_pengembalian }}
                                            </td>
                                            <td>
                                                {{ $item->jumlahBarang }}
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
                                                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                        <a class="dropdown-item" href="#" data-toggle="modal"
                                                            data-target="#formModalDetail{{ $item->id }}">
                                                            Detail
                                                        </a>
                                                        <a class="dropdown-item" href="#" data-toggle="modal"
                                                            data-target="#formModalEdit{{ $item->id }}">
                                                            Status Finished
                                                        </a>
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
            <form action="/add-peminjaman" method="POST" enctype="multipart/form-data">
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
                                    <label for="inputMessage">Loanee</label>
                                    <textarea class="form-control" id="peminjam" name="peminjam" rows="" placeholder=""></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="tglpinjam">Loan Start Date</label>
                                    <input type="date" class="form-control" id="tgl_peminjaman" name="tgl_peminjaman">
                                </div>
                                <div class="form-group">
                                    <label for="jumlahBarang">Amount</label>
                                    <input type="number" class="form-control" id="jumlahBarang" name="jumlahBarang">
                                </div>
                                <div class="form-group">
                                    <label for="inputMessage">Description</label>
                                    <textarea class="form-control" id="keterangan" name="keterangan" rows="3"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="foto">Image</label>
                                    <input type="file" class="form-control" id="foto" name="foto">
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
            {{-- End Modal Tambah Data --}}

            {{-- Modal Edit Data --}}
            @foreach ($peminjaman as $item)
                <form action="edit-peminjaman" method="POST">
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
                                            <label for="tgl_selesai">Loan End Date</label>
                                            <input type="date" class="form-control" id="tgl_selesai"
                                                name="tgl_selesai" value="{{ $item->tgl_selesai }}">
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

            @foreach ($peminjaman as $item)
                <div class="modal fade" id="formModalDetail{{ $item->id }}" tabindex="-1" role="dialog"
                    aria-labelledby="formModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="formModalLabel">Item Detail</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <div class="card" style="width: 29rem;">
                                        <img src="{{ asset('foto_gudang/' . $item->foto) }}" class="card-img-top"
                                            alt="{{ $item->foto }}">
                                    </div>
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

        @endsection

        @section('script')
            <script>
                const tabel = document.querySelector('#tabel-peminjaman');
                const dataTable = new simpleDatatables.DataTable(tabel)
            </script>
        @endsection
