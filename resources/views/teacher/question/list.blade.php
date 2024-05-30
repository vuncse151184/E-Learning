@extends('teacher.layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="section-title-02 mb-4">
                    <div class="row mb-4">
                        <div class="col-md-6 title-block">
                            <h4 class="main-title">All Questions</h4>
                        </div>
                        <div class="col-md-6 text-right">
                            <a href="{{ url('/teacher/question/create') }}" class="btn btn-success btn-sm"
                                title="Add New Lesson">
                                <i class="fa fa-plus" aria-hidden="true"></i> Add New Question
                            </a>
                        </div>
                    </div>
                </div>

            </div>
            @if (!empty($questions) && $questions->count())
                <div class="form-row mb-5 frm-dashboard-block">
                    <div class="user-dashboard-table table-responsive">
                        <table class="table table-bordered manage-candidates-top mb-0">
                            <thead class="bg-light">
                                <tr class="text-center">
                                    <th class="w-10" scope="col">No#</th>
                                    <th class="w-75" scope="col">Title</th>
                                    <th class="w-15" scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($questions->items() as $item)
                                    <tr class="text-center">
                                        <td>{{ ($questions->currentPage() - 1) * 10 + $loop->iteration }}</td>

                                        <td style="font-family: Arial, Helvetica, sans-serif">

                                            @if (preg_match('/<img\s+src="([^"]+)"/', $item->question_name, $matches))
                                                <img width="600" src="{{ $matches[1] }}">
                                            @else
                                                {!! $item->question_name !!}
                                            @endif
                                        <td>
                                            <a href="{{ url('teacher/question/edit/' . $item->id) }}" title="Edit Question">
                                                <button class="active-btn">
                                                    <i class="fas fa-pencil-alt"></i>
                                                </button>
                                            </a>
                                            <form method="POST" action="{{ url('/teacher/question/delete/' . $item->id) }}"
                                                accept-charset="UTF-8" style="display:inline">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <button type="submit" class="active-btn deleteConfirmation deletebtn"
                                                    title="Delete Teacher" data-id="{{ $item->id }}">
                                                    <i class="fas fa-trash" aria-hidden="false"></i></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>

            @endif

            <div class="row col-12 text-center">
                <div class="col-12">
                    {{ $questions->links() }}
                </div>
            </div>

        </div>
    </div>
    </div>


    <script type="text/javascript">
        $('.deletebtn').on('click', function(e) {
            e.preventDefault()
            swal.fire({
                title: 'Delete this question ?',
                text: "You won't be able to revert it!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "DELETE",
                        url: "<?= route('teacher.question.delete', '') ?>/"+$(this).data('id'),
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                        },
                        success: function(response) {
                            if (response.success) {
                                Swal.fire({
                                    text: response.message,
                                    icon: 'success',
                                }).then(() => {
                                    window.location.reload()
                                })
                            } else {
                                Swal.fire({
                                    text: response.message,
                                    icon: 'error',
                                })
                            }
                        }
                    })
                }
            })
        })
    </script>

@stop
