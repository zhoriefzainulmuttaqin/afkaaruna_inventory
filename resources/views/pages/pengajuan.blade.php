@extends('layout.navbar')
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
                            <h3 class="mb-0">Submission</h3>
                        </div>
                        <div class="table-responsive">
                            <table class="table align-items-center table-flush" id="tabel-peminjaman">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Item</th>
                                        <th scope="col">Loanee</th>
                                        <th scope="col">Amount</th>
                                        <th scope="col">Loan Start Date</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Return Date</th>
                                        <th scope="col">Action</th>
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
                                                {{ $item->barang->nama }}
                                            </td>
                                            <td>
                                                {{ $item->peminjam }}
                                            </td>
                                            <td>
                                                {{ $item->jumlahBarang }}
                                            </td>
                                            <td>
                                                {{ $item->tgl_peminjam }}
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
                                                        <i class="bg-success"></i> {{ $item->status->status }}
                                                    </span>
                                                @endif
                                            </td>
                                            <td>
                                                {{ $item->tgl_pengembalian }}
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
                                                            href="{{ route('approve.pengajuanBarang', $item->id) }}">Approve</a>
                                                        <a class="dropdown-item" href="#" data-toggle="modal"
                                                            data-target="#formModalEdit{{ $item->id }}">
                                                            Status Finished
                                                        </a>
                                                        <a class="dropdown-item"
                                                            href="{{ asset('delete-pengajuanBarang/' . $item->id) }}">Delete</a>
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
            <form action="/add-pengajuanBarang" method="POST" enctype="multipart/form-data">
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
                                    <input type="text" class="form-control" id="peminjam" name="peminjam">
                                </div>
                                <div class="form-group">
                                    <label for="jumlahBarang">Amount</label>
                                    <input type="number" class="form-control" id="jumlahBarang" name="jumlahBarang">
                                </div>
                                <div class="form-group">
                                    <label for="tglpinjam">Loan Start Date</label>
                                    <input type="date" class="form-control" id="tgl_peminjam" name="tgl_peminjam">
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

            {{-- Modal Edit Data --}}
            @foreach ($pengajuan as $item)
                <form action="edit-pengajuanBarang" method="POST">
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



        @endsection

        @section('script')
            <script>
                const tabel = document.querySelector('#tabel-peminjaman');
                const dataTable = new simpleDatatables.DataTable(tabel)
            </script>
        @endsection
