@extends('partials.templates.main')
@section('content')

<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <div class="col-md-12">
                <div class="card">
                  <div class="card-header">
                    <div class="d-flex align-items-center">
                      <h4 class="card-title">Peminjaman</h4>
                    </div>
                  </div>
                  <div class="card-body">
            
                    <div class="table-responsive">
                      <table
                        id="add-row"
                        class="display table table-striped table-hover"
                      >
                        <thead>
                          <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Judul</th>
                            <th>Tanggal Pinjam</th>
                            <th>Tanggal Kembali</th>
                            <th>Status</th>
                          </tr>
                        </thead>
                        <tbody>
                        @foreach ($peminjaman as $key => $pinjam)
                          <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $pinjam->user->name }}</td>
                            <td>{{ $pinjam->buku->title }}</td>
                            <td>{{ \Carbon\Carbon::parse($pinjam->borrow_date)->format('d-M-Y') }}</td>
                            <td>{{ \Carbon\Carbon::parse($pinjam->return_date)->format('d-M-Y') }}</td>
                            <td>{{ $pinjam->status }}</td>
                          </tr>
                        @endforeach
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
        </div>
    </div>
</div>

@endsection
