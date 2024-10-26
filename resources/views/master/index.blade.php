@extends('partials.templates.main')
@section('content')

<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <div class="col-md-12">
                <div class="card">
                  <div class="card-header">
                    <div class="d-flex align-items-center">
                      <h4 class="card-title">Kategori</h4>
                      <button
                        class="btn btn-primary btn-round ms-auto"
                        data-bs-toggle="modal"
                        data-bs-target="#addRowModal"
                      >
                    <i class="fa fa-plus" ></i>
                        Add Row
                      </button>
                    </div>
                  </div>
                  <div class="card-body">
                    <div id="alertPlaceholder"></div>
                    <!-- Modal -->
                    <div
                      class="modal fade"
                      id="addRowModal"
                      tabindex="-1"
                      role="dialog"
                      aria-hidden="true"
                    >
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header border-0">
                            <h5 class="modal-title">
                              <span class="fw-mediumbold"> Data</span>
                              <span class="fw-light"> Kategori </span>
                            </h5>
                            <button
                              type="button"
                              class="close"
                              data-bs-dismiss="modal"
                              aria-label="Close"
                            >
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <form id="categoryForm">
                              <div class="row">
                                <div class="col-sm-12">
                                  <div class="form-group form-group-default">
                                    <label>Name</label>
                                    <input
                                      id="addName"
                                      type="text"
                                      class="form-control"
                                      placeholder=""
                                    />
                                  </div>
                                </div>
                                <div class="col-md-12">
                                  <div class="form-group form-group-default">
                                    <label>Description</label>
                                    <input
                                      id="addDescription"
                                      type="text"
                                      class="form-control"
                                      placeholder=""
                                    />
                                  </div>
                                </div>
                              </div>
                            </form>
                          </div>
                          <div class="modal-footer border-0">
                            <button
                              type="button"
                              id="addRowButton"
                              class="btn btn-primary"
                            >
                              Add
                            </button>
                            <button
                              type="button"
                              class="btn btn-danger"
                              data-bs-dismiss="modal"
                            >
                              Close
                            </button>
                          </div>
                        </div>
                      </div>
                    </div>
            
                    <div class="table-responsive">
                      <table
                        id="add-row"
                        class="display table table-striped table-hover"
                      >
                        <thead>
                          <tr>
                            <th>Name</th>
                            <th>Description</th>
                            <th style="width: 10%" class="text-center">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach($categories as $category)
                            <tr>
                                <td>{{ $category->name }}</td>
                                <td>{{ $category->description }}</td>
                                <td>
                                    <div class="form-button-action">
                                        <button type="button" class="btn btn-link btn-primary edit-category" data-id="{{ $category->id }}" title="Edit">
                                            <i class="fa fa-edit"></i>
                                        </button>
                                        <button type="button" class="btn btn-link btn-danger delete-category" data-id="{{ $category->id }}" title="Remove">
                                            <i class="fa fa-times"></i>
                                        </button>
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

<script>
    $(document).ready(function () {
        $('#addRowButton').click(function () {
    var name = $('#addName').val();
    var description = $('#addDescription').val();
    var id = $(this).data('id'); // Ambil ID dari data tombol jika ada

    // Cek apakah ini Add atau Update berdasarkan ID
    if (id) {
        // Jika ID ada, maka lakukan Update
        $.ajax({
            url: "{{ url('categories') }}/" + id,
            type: "PUT", // Gunakan PUT untuk update
            data: {
                name: name,
                description: description,
                _token: '{{ csrf_token() }}'
            },
            success: function (response) {
                location.reload(); // Reload halaman setelah update
            },
            error: function (error) {
                console.log(error);
            }
        });
    } else {
        // Jika ID tidak ada, lakukan Add (create)
        $.ajax({
            url: "{{ route('categories.store') }}",
            type: "POST",
            data: {
                name: name,
                description: description,
                _token: '{{ csrf_token() }}'
            },
            success: function (response) {
                location.reload(); // Reload halaman setelah add
            },
            error: function (error) {
                console.log(error);
            }
        });
    }
});

// Reset form dan tombol setelah modal ditutup
$('#addRowModal').on('hidden.bs.modal', function () {
    $('#categoryForm')[0].reset();
    $('#addRowButton').removeData('id').text('Add'); // Reset tombol kembali menjadi Add
});

        // Handle edit category
        $(document).on('click', '.edit-category', function () {
            var id = $(this).data('id');

            $.get("{{ url('categories') }}/" + id, function (data) {
                $('#addName').val(data.name);
                $('#addDescription').val(data.description);
                $('#addRowButton').data('id', id).text('Update'); // Update button
                $('#addRowModal').modal('show');
            });
        });

        // Handle delete category
        $(document).on('click', '.delete-category', function () {
            var id = $(this).data('id');

            $.ajax({
                url: "{{ url('categories') }}/" + id,
                type: "DELETE",
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function (response) {
                    location.reload(); // Reload the page after deleting
                },
                error: function (error) {
                    console.log(error);
                }
            });
        });
    });
</script>

@endsection