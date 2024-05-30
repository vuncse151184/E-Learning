@extends('user.layouts.app')
@section('content')
    <div class="content" style="padding-top: 10px; padding-bottom: 100px"> 
        <div class="middle-col">
            <h1>Lớp {{ $i }}</h1>

            <div class="row vj__list" style="padding-top: 50px">
                @foreach ($subjects as $subject)
                    <div class="col-md-6 pb-2">
                        <h3 class="sub-title"><b>{{ $subject->subject_name }}</b></h3>
                        <ul class="list">
                            @foreach ($lessons as $item)
                                @if ($item->class_id == $i)
                                    @if ($item->subject_name == $subject->subject_name)
                                    <li><a href="{{ url('/viewlesson/' . $item->id) }}"><b
                                        style="color:green;">{{ $item->lesson_name }}</b></a></li>
                                    @endif
                                   
                                @endif
                            @endforeach
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
