@extends('administrator.layouts.app')
@section('content')
    {{-- <div class="container"> --}}
    {{-- <div class="row">
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">
                        <h2>Laravel 9 Crud</h2>
                    </div>
                    <div class="card-body"> --}}
    <div class="row mb-0 mt-2">
        <div class="col-md-6 title-block">
            <h1 class="main-title">List Teacher</h1>
        </div>
        <div class="col-md-6 mb-0 mt-3 text-right">
            <a href="{{ url('/administrator/teacher-add') }}" id="addTeacherButton" class="btn btn-success btn-sm"
                title="Add New Teacher">
                Add New  &nbsp; <i class="fa fa-plus" aria-hidden="true"></i>
            </a>
        </div>
    </div>

    <div class="card-body table-responsive">
        <table class="table table-hover text-nowrap job-seeker-tbl">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($teachers as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->email }}</td>
                        <td>{{ $item->phone }}</td>
                        <td>{{ $item->is_active == 1 ? 'Enabled' : 'Off' }}
                        <td>
                            {{-- <button class="active-btn"><i class="fas fa-pencil-alt"></i></button>
                                            <button class="active-btn"><i class="far fa-file-alt"></i></button> --}}

                            <a href="{{ url('administrator/teacher-edit/' . $item->id) }}" title="Edit Teacher" style="text-decoration: none">
                                <button class="active-btn">
                                    <i class="fas fa-pencil-alt"></i>
                                </button>
                            </a>
                            <form method="POST" action="{{ url('/administrator/teacher-delete/' . $item->id) }}"
                                accept-charset="UTF-8" style="display:inline">
                                {{ method_field('DELETE') }}
                                {{ csrf_field() }}
                                <button type="submit" class="active-btn" title="Delete Teacher"
                                    onclick="return confirm(&quot;Confirm delete?&quot;)">
                                    <i class="fa fa-trash" aria-hidden="false"></i> </button>

                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="card-footer">
        <!-- Pagination -->
        <div class="row col-12 d-flex justify-content-center text-center">
            {{ $teachers->links() }}
        </div>

        {{-- </div>
                </div>
            </div>
        </div> --}}
        {{-- </div> --}}
       
    @endsection
