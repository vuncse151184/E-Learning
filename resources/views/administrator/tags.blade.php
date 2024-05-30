@extends('administrator.layouts.app')
@section('content')
    <br />
    <!-- Button trigger modal -->
    <div class="text-right">
        <button type="button" class="btn btn-success pr-2 " data-toggle="modal" data-target="#addTagModal">
            New Tag &nbsp;<i class="fa fa-plus-circle" aria-hidden="true"></i>
        </button>

    </div>

    <!--Add Tag Modal -->
    <div class="modal fade" id="addTagModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form method="POST" action="route('administrator.add-tag')">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Create new tag</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="tag">Tag name</label>
                            <textarea type="text" name="tag" id="tagId" class="form-control"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="class_id">Select class</label>
                            <div class="container-fluid">
                                <div class="row">
                                    @for ($i = 1; $i <= 12; $i++)
                                        <div class="col-3">
                                            <input type="checkbox" name="select-class[]" class="modal1-class"
                                                id="class_id{{ $i }}">
                                            <label style="border-radius: 30px" for="class_id{{ $i }}">Lớp
                                                {{ $i }}</label>
                                        </div>
                                    @endfor
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" id="createTagButton" class="btn btn-primary">Save changes</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
    <div class="card-body table-responsive">
        <table class="table table-hover text-nowrap job-seeker-tbl">
            <thead>
                <tr>
                    <th class="w-10">ID</th>
                    <th class="w-75">Tag</th>
                    <th class="w-15">Action</th>

                </tr>
            </thead>
            <tbody>
                @if ($tags_list)
                    @foreach ($tags_list as $item)
                        <tr>
                            <td>{{ $item['id'] }}</td>
                            <td class="text-left">{{ $item['name'] }}</td>
                            <td>
                                <!-- Button trigger modal -->
                                <button class="active-btn" data-toggle="modal"
                                    data-target="#editTagModal{{ $item['id'] }}" id="editTagButton"
                                    data-id="{{ $item['id'] }}">
                                    <i class="fas fa-pencil-alt"></i>
                                </button>

                                <!-- Modal -->
                                <div class="modal fade" id="editTagModal{{ $item['id'] }}" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">

                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Edit tag {{ $item['id'] }}</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body text-left">
                                                <div class="form-group ">
                                                    <label for="tag">Tag name</label>
                                                    <textarea type="text" name="tag" id="editTagName{{ $item['id'] }}" class="form-control">{{ $item['name'] }}</textarea>
                                                </div>

                                                <div class="form-group">
                                                    <label for="class_id">Select class</label>
                                                    <div class="container-fluid">
                                                        <div class="row">
                                                            @for ($i = 1; $i <= 12; $i++)
                                                                <div class="col-3">
                                                                    <input type="checkbox" name="update-class[]"
                                                                        class="modal2-class"
                                                                        id="update_class_id{{ $i }}"
                                                                        {{ in_array($i, $item['class_id']) ? 'checked' : '' }}>
                                                                    <label style="border-radius: 30px"
                                                                        for="update_class_id{{ $i }}">Lớp
                                                                        {{ $i }}</label>
                                                                </div>
                                                            @endfor
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Close</button>
                                                <button class="btn btn-primary updateTagButton"
                                                    data-id="{{ $item['id'] }}">Save changes</button>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <button type="submit" class="active-btn deleteTagButton" title="Delete This Lesson"
                                    data-id="{{ $item['id'] }}">
                                    <i class="fas fa-trash" aria-hidden="false"></i>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                @endif

            </tbody>
        </table>
    </div>
    <div class="card-footer">
        <!-- Pagination -->
        <div class="row col-12 d-flex justify-content-center text-center">

        </div>
    @endsection
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            var selected_class = [];

            $("#addTagModal .modal1-class").change(function() {
                var value = $(this).attr('id').substring(8);
                if ($(this).is(':checked')) {
                    selected_class.push(value);
                } else {
                    selected_class.splice(selected_class.indexOf(value), 1);
                }
                console.log('Checked values:', selected_class);
            });



            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });


            $('#createTagButton').click(function() {
                let tag = $('#tagId').val()
                $.ajax({
                    url: "<?= route('administrator.add-tag') ?>",
                    type: "POST",
                    cache: false,
                    data: {
                        tag_name: tag,
                        class_id: selected_class,
                    },
                    success: function(data) {
                        $('#addTagModal').modal('hide');
                        window.location.reload()
                    },
                    error: function(err) {
                        console.error("Error:", err);
                    }
                });

            })




            

            $('.updateTagButton').click(function() {
                var update_selected_class = [];
                var dataId = $(this).data('id');
                var tag_name = $('#editTagName' + dataId).val();
                $('#editTagModal' + dataId + ' .modal2-class:checked').each(function() {
                    var class_id = $(this).attr('id').substring(15);
                    update_selected_class.push(class_id);
                });
                $('#editTagModal' + dataId + '.modal2-class').change(function() {
                var value = $(this).attr('id').substring(15);

                if ($(this).is(':checked')) {
                    update_selected_class.push(value);
                } else {
                    update_selected_class.splice(update_selected_class.indexOf(value), 1);
                }
            });
                $.ajax({
                    url: "<?= route('administrator.update-tag') ?>",
                    type: "POST",
                    cache: false,
                    data: {
                        id: dataId,
                        tag_name: tag_name,
                        class_id: update_selected_class,
                    },
                    success: function(data) {
                        if (data.success) {
                            Swal.fire({
                                title: data.message,
                                icon: 'success',
                                timer: 2000,
                                willClose: () => {
                                    window.location.reload();
                                }
                            })
                            $('#editTagModal' + dataId).modal('hide')
                        } else {
                            Swal.fire(
                                'Error! Tag not found or update failed',
                                data.message,
                                'error'
                            )
                        }
                    },
                    error: function(err) {
                        console.error("Error:", err);
                    }
                })
            })

            $('.deleteTagButton').click(function() {
                var dataId = $(this).data('id');
                var trElement = $(this).closest('tr');
                $.ajax({
                    url: "<?= route('administrator.delete-tag') ?>",
                    cache: false,
                    type: 'POST',
                    data: {
                        id: dataId,
                    },
                    success: function(data) {
                        Swal.fire({
                            title: 'Are you sure?',
                            text: "You won't be able to revert this!",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Yes, delete it!'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                trElement.remove();
                                Swal.fire(
                                    'Deleted!',
                                    'Your file has been deleted.',
                                    'success'
                                )
                            }
                        })
                    }
                })
            })

        })
    </script>
    <style>
        input[type="checkbox"] {
            display: none;
        }

        input[type="checkbox"]+label {
            text-align: center;
            font-family: 'Courier New', Courier, monospace;
            background-color: #fdfdffef;
            border: 1px solid #ccc;
            padding: 4px 5px;
            cursor: pointer;
            border-radius: 4px;
        }

        input[type="checkbox"]:checked+label {
            background-color: #007bff;
            color: #fff;
        }
    </style>
