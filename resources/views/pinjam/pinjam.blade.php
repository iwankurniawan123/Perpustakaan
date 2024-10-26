@extends('partials.templates.main')
@section('content')

<div class="container mb-1">
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">Buku</h3>
            <ul class="breadcrumbs mb-3">
            <li class="nav-home">
                <a href="#">
                <i class="icon-home"></i>
                </a>
            </li>
            <li class="separator">
                <i class="icon-arrow-right"></i>
            </li>
            <li class="nav-item">
                <a href="#">Forms</a>
            </li>
            <li class="separator">
                <i class="icon-arrow-right"></i>
            </li>
            <li class="nav-item">
                <a href="#">Pinjam Buku</a>
            </li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-12">
              <div class="card">
                <form action="{{ route('pinjam.buku.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card-header">
                    <div class="card-title">Pinjam Buku</div>
                    </div>
                    <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 col-lg-12">
                                    <div class="form-group">
                                        <label for="exampleFormControlSelect1"
                                          >Buku</label
                                        >
                                        <select
                                          class="form-select"
                                          id="exampleFormControlSelect1" name="book_id"
                                        >
                                        <option value="">-- Pilih Buku --</option>
                                            @foreach($books as $book)
                                                <option value="{{ $book->id }}">{{ $book->title }}</option>
                                            @endforeach
                                        </select>
                                    </div>                
                                    <div class="form-group">
                                        <label for="borrow_date">Tanggal Pinjam</label>
                                        <input
                                        type="date"
                                        class="form-control"
                                        id="borrow_date"
                                        placeholder="" name="borrow_date"
                                        />
                                    </div>
                                </div>
                            </div>   
                    </div>
                    <div class="card-action">
                        <button class="btn btn-success">Pinjam</button>
                    </div>
                </form> 
              </div>
            </div>
    </div>
</div>
</div>

<div class="container mt-1">
    <div class="page-inner">
        <div class="page-header">
            <div class="col-md-12">
                <div class="card">
                  <div class="card-header">
                    <div class="d-flex align-items-center">
                      <h4 class="card-title">Data Buku</h4>
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
                            <th>Title</th>
                            <th>Author</th>
                            <th>Stok</th>
                          </tr>
                        </thead>
                        <tbody>
                        @foreach ($books as $key => $book)
                          <tr>
                            <td>{{ $book->title }}</td>
                            <td>{{ $book->author }}</td>
                            <td>{{ $book->available }}</td>
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
