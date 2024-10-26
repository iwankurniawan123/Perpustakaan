@extends('partials.templates.main')
@section('content')

<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <div class="col-md-12">
                <div class="card">
                  <div class="card-header">
                    <div class="d-flex align-items-center">
                      <h4 class="card-title">Data Buku</h4>
                      <button
                        class="btn btn-primary btn-round ms-auto"
                        
                      >
                        <a href="{{ route('books.create') }}" class="text-white"><i class="fa fa-plus" ></i></a>
                        Add Row
                      </button>
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
                            <th>Title</th>
                            <th>Author</th>
                            <th>Publisher</th>
                            <th style="width: 10%" class="text-center">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                        @foreach ($books as $key => $book)
                          <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $book->title }}</td>
                            <td>{{ $book->author }}</td>
                            <td>{{ $book->publisher }}</td>
                            <td>
                                <div class="form-button-action d-flex align-items-center">
                                    <a href="{{ route('books.edit', $book->id) }}" class="btn btn-link btn-primary btn-lg" data-bs-toggle="tooltip" title="Edit Book">
                                      <i class="fa fa-edit"></i>
                                    </a>
                                    <form action="{{ route('books.destroy', $book->id) }}" method="POST" style="display:inline-block;">
                                      @csrf
                                      @method('DELETE')
                                      <button type="submit" class="btn btn-link btn-danger" data-bs-toggle="tooltip" title="Delete Book" onclick="return confirm('Are you sure you want to delete this book?')">
                                        <i class="fa fa-times"></i>
                                      </button>
                                    </form>
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
        </div>
    </div>
</div>

@endsection