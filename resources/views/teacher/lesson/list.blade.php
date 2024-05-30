@extends('teacher.layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="section-title-02 mb-4">
                    <div class="row mb-4">
                        <div class="col-md-6 title-block">
                            <h4 class="main-title">All Lesson</h4>
                        </div>
                        <div class="col-md-6 text-right">
                            <a href="{{ url('/teacher/lesson/create') }}" class="btn btn-success btn-sm"
                                title="Add New Lesson">
                                <i class="fa fa-plus" aria-hidden="true"></i> Add New Lesson
                            </a>
                        </div>
                    </div>
                </div>

            </div>

            @if ($lessons!=null)
            <div class="form-row mb-5 frm-dashboard-block"> 
                <div class="user-dashboard-table table-responsive">
                    <table class="table table-bordered manage-candidates-top mb-0">
                        <thead class="bg-light">
                            <tr class="text-center">
                                <th class="w-10" scope="col">Lesson No.</th>
                                <th>Video Link</th>
                                <th>Lesson name</th>
                                <th>Public</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($lessons as $item)
                                <tr class="text-center" data-index="{{$item->id}}">
                                    <td>{{$item->class_name}}</td>
                                    <td class="text-center">
                                        <a href="{{ url('teacher/lesson/viewlesson/' . $item->id) }}">View Lesson</a>
                                    </td>
                                    <td>{{ $item->lesson_name }}</td>
                                    <td>
                                        <label class="el_custom_switch">
                                            <input type="checkbox" name="switch" class="switch"
                                                {{ $item->is_public == 1 ? 'checked' : '' }} value={{ $item->is_public }}>
                                            <span class="el_switch_style"></span>
                                        </label>
                                    </td>
                                    <td>
                                        <a href="{{ url('teacher/lesson/edit/' . $item->id) }}" title="Edit Lesson">
                                            <button class="active-btn">
                                                <i class="fas fa-pencil-alt"></i>
                                            </button>
                                        </a>
                                        <form method="POST" action="{{ url('/teacher/lesson-delete/' . $item->id) }}"
                                            accept-charset="UTF-8" style="display:inline">
                                            {{ method_field('DELETE') }}
                                            {{ csrf_field() }}
                                            <button type="submit" class="active-btn deleteBtn" title="Delete This Lesson" data-id="{{$item->id}}">
                                                <i class="fas fa-trash" aria-hidden="false"></i>
                                            </button>
                                        </form>
                                    </td>

                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
            @else
                <p>No lessons founds</p>
            @endif
            

            <div class="row col-12 text-center" >
                <div class="col-12">
                    {{$lessons->links()}}
                    {{-- <ul class="pagination justify-content-center mb-0">
                        <li class="page-item disabled"> <span class="page-link b-radius-none"><i
                                    class="fas fa-step-backward"></i></span> </li>
                        <li class="page-item disabled"> <span class="page-link b-radius-none"><i
                                    class="fas fa-chevron-left"></i></span> </li>
                        <li class="page-item active" aria-current="page"><span class="page-link">1 </span> <span
                                class="sr-only">(current)</span></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item"><a class="page-link" href="#">...</a></li>
                        <li class="page-item"><a class="page-link" href="#">25</a></li>
                        <li class="page-item"> <a class="page-link" href="#"><i class="fas fa-chevron-right"></i></a>
                        </li>
                        <li class="page-item"> <a class="page-link" href="#"><i class="fas fa-step-forward"></i></a>
                        </li>
                    </ul> --}}
                </div>
            </div>

        </div>
    </div>
    </div>
    <script>
        $(document).ready(function() {
            $('.deleteBtn').click(function(e){
                
                e.preventDefault()
                swal.fire({
                    title: 'Delete this lesson ?',
                    text: "You won't be able to revert it!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'No, cancel!',
                    reverseButtons: true
                    }).then((result) => {
                        if (result.isConfirmed) {     
                    
                            $.ajax({
                                type:"delete",
                                url:"<?=route('teacher.lesson.delete' ,"" )?>/"+$(this).data('id'),
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),                            
                                },
                                success: function(response){
                                    Swal.fire({
                                        text:"Deleted Successful",
                                        icon:'success',
                                    }).then(()=>{
                                        window.location.reload()
                                    })
                                }                                
                            })
                        }
                    })
                })
            
    
           
            $('.switch').click(function() {
                is_public = ($(this).val())
                let tr =this.closest('tr') 
                lesson_id = $(tr).attr('data-index')
                $.ajax({
                    type: "post",
                    url: "<?= route('teacher.lesson.updatePublic') ?>",
                    data: {
                      public: is_public,
                      id: lesson_id,
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                       
                    },
                    error: function(err) {
                        console.log(err)
                    }
                })
            })
        })
    </script>
@stop
