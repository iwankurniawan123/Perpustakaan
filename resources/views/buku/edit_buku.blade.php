@extends('partials.templates.main')
@section('content')

<div class="container">
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
            <a href="#">Edit Buku</a>
          </li>
        </ul>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <form action="{{ route('books.update', ['id' => $books->id]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-header">
                <div class="card-title">Edit Buku</div>
                </div>
                <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 col-lg-12">
                                <div class="form-group">
                                    <label for="exampleFormControlSelect1"
                                      >Category</label
                                    >
                                    <select
                                      class="form-select"
                                      id="exampleFormControlSelect1" name="category_id"
                                    >
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ $books->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                    @endforeach
                                    </select>
                                </div>                
                                <div class="form-group">
                                    <label for="cover">Cover</label>
                                    <input
                                    type="file"
                                    class="form-control"
                                    id="cover"
                                    placeholder="" name="cover" value="{{ old('cover', $books->cover) }}" accept=".jpg,.png,.jpeg"
                                    />
                                </div>
                                <div class="form-group">
                                    <label for="title">Title</label>
                                    <input
                                    type="text"
                                    class="form-control"
                                    id="title"
                                    placeholder="" name="title" value="{{ old('title', $books->title) }}"
                                    />
                                </div>
                                <div class="form-group">
                                    <label for="author">Author</label>
                                    <input
                                    type="text"
                                    class="form-control"
                                    id="author" 
                                    placeholder="" name="author" value="{{ old('author', $books->author) }}"

                                    />
                                </div>
                                <div class="form-group">
                                    <label for="publisher">Publisher</label>
                                    <input
                                    type="text"
                                    class="form-control"
                                    id="publisher"
                                    placeholder=""  name="publisher" value="{{ old('publisher', $books->publisher) }}"

                                    />
                                </div>
                                <div class="form-group">
                                    <label for="year">Year</label>
                                    <input
                                    type="date"
                                    class="form-control"
                                    id="year"
                                    placeholder="" name="year" value="{{ old('year', $books->year) }}"

                                    />
                                </div>
                                <div class="form-group">
                                    <label for="isbn">ISBN</label>
                                    <input
                                    type="text"
                                    class="form-control"
                                    id="isbn"
                                    placeholder="" name="isbn" value="{{ old('isbn', $books->isbn) }}"

                                    />
                                </div>
                                <div class="form-group">
                                    <label for="available">Available</label>
                                    <input
                                    type="number"
                                    class="form-control"
                                    id="available"
                                    placeholder="" name="available" value="{{ old('available', $books->available) }}"
                                    />
                                </div>
                            </div>
                        </div>   
                </div>
                <div class="card-action">
                    <button class="btn btn-success">Submit</button>
                </div>
            </form> 
          </div>
        </div>
      </div>
    </div>
  </div>

@endsection