@extends('teacher.layouts.app')
@section('content')
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="//cdn.ckeditor.com/4.20.2/full/ckeditor.js"></script>

    <h3> Edit lesson {{ $lesson->id }}</h3>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <form class="mt-4" id="lessonfrm" action="{{ route('teacher.lesson.update', $lesson->id) }}" method="post">
                    <!-- Form Block -->
                    <div class="mb-5 frm-block form-web">
                        <div class="form-row">
                            <!-- Form group -->
                            <div class="form-group col-md-12">
                                <label for="lesson_name" class="font-weight-bold">Lesson <span
                                        class="red-required">Required</span></label>
                                <input type="text" rows="4" name="lesson_name" class="form-control"
                                    value="{{ $lesson->lesson_name }}" id="lesson_name" placeholder="Enter lesson name">
                            </div>
                            <!-- End Form group -->
                        </div>
                        <!-- Form Row -->

                        <div class="form-row mb-5">
                            <!-- Form group -->
                            <div class="form-group col-md-12">
                                <label for="lesson_name" class="font-weight-bold">Content <span
                                        class="red-required">Optional</span></label>
                                <textarea name="editor" id="editor"></textarea>


                            </div>
                            <!-- End Form group -->
                        </div>

                        <div class="form-row">
                            <!-- Form group -->
                            <div class="form-group col-md-12 row">

                                <label for="lesson_url" class="font-weight-bold">Lesson URL <span
                                        class="red-required">Required</span></label>
                                <input id="lesson_url" rows="4" name="lesson_url" class="form-control" id="lesson_url"
                                    value="{{ $lesson->lesson_url }}">
                                <span class="form-message"></span>
                            </div>
                            <!-- End Form group -->
                        </div>

                        <div class="form-row">
                            <!-- Form group -->
                            <div class="form-group col-md-12">
                                <label for="video" class="font-weight-bold">Lesson slides <span
                                        class="red-required">Required</span></label>
                                <textarea type="text" rows="4" class="form-control" name="video" id="video">{{ $lesson->video }}</textarea>
                            </div>
                            <!-- End Form group -->
                        </div>
                        <!-- End Form Row -->


                        <!-- Form Row -->

                        <!-- Form group -->

                        <ul class="tree">
                            <li>
                                <span class="btn mb-3 blue-btn btn-lg  text-center font-weight-bold"
                                    style="display: inline-block;
                                margin-left: -35px; font-family: Arial, Helvetica, sans-serif">
                                    Chọn Lớp</span>
                                <ul>
                                    <li>
                                        <span class="btn btn-info mb-2 text-center font-weight-bold category-class">
                                            Lớp 1
                                        </span>
                                        <ul>
                                            <div class="container">
                                                <div class="row">
                                                    {{-- style="display:flex; justify-content:space-between " --}}
                                                    @foreach ($subjects as $item)
                                                        @if ($item->class_id == 1)
                                                            <div class="col-3">
                                                                <input type="radio" name="select-class"
                                                                    {{ $item->id == $lesson->subject_id ? 'checked' : '' }}
                                                                    id="{{ $item->id }}">
                                                                <label class="col-md-10" style="border-radius: 30px"
                                                                    for="{{ $item->id }}">{{ $item->subject_name }}</label>
                                                            </div>
                                                        @endif
                                                    @endforeach
                                                </div>
                                            </div>
                                        </ul>
                                    </li>


                                    <li>
                                        <span class="btn btn-info mb-2 text-center font-weight-bold category-class">
                                            Lớp 2
                                        </span>
                                        <ul>
                                            <div class="container">
                                                <div class="row">
                                                    {{-- style="display:flex; justify-content:space-between " --}}
                                                    @foreach ($subjects as $item)
                                                        @if ($item->class_id == 2)
                                                            <div class="col-3">
                                                                <input type="radio" name="select-class"
                                                                    {{ $item->id == $lesson->subject_id ? 'checked' : '' }}
                                                                    id="{{ $item->id }}">
                                                                <label class="col-md-10" style="border-radius: 30px"
                                                                    for="{{ $item->id }}">{{ $item->subject_name }}</label>
                                                            </div>
                                                        @endif
                                                    @endforeach
                                                </div>
                                            </div>
                                        </ul>
                                    </li>

                                    <li>
                                        <span class="btn btn-info mb-2 text-center font-weight-bold category-class">
                                            Lớp 3
                                        </span>
                                        <ul>
                                            <div class="container">
                                                <div class="row">
                                                    {{-- style="display:flex; justify-content:space-between " --}}
                                                    @foreach ($subjects as $item)
                                                        @if ($item->class_id == 3)
                                                            <div class="col-3">
                                                                <input type="radio" name="select-class"
                                                                    {{ $item->id == $lesson->subject_id ? 'checked' : '' }}
                                                                    id="{{ $item->id }}">
                                                                <label class="col-md-10" style="border-radius: 30px"
                                                                    for="{{ $item->id }}">{{ $item->subject_name }}</label>
                                                            </div>
                                                        @endif
                                                    @endforeach
                                                </div>
                                            </div>
                                        </ul>
                                    </li>
                                    <li>
                                        <span class="btn btn-info mb-2 text-center font-weight-bold category-class">
                                            Lớp 4
                                        </span>
                                        <ul>
                                            <div class="container">
                                                <div class="row">
                                                    {{-- style="display:flex; justify-content:space-between " --}}
                                                    @foreach ($subjects as $item)
                                                        @if ($item->class_id == 4)
                                                            <div class="col-3">
                                                                <input type="radio" name="select-class"
                                                                    {{ $item->id == $lesson->subject_id ? 'checked' : '' }}
                                                                    id="{{ $item->id }}">
                                                                <label class="col-md-10" style="border-radius: 30px"
                                                                    for="{{ $item->id }}">{{ $item->subject_name }}</label>
                                                            </div>
                                                        @endif
                                                    @endforeach
                                                </div>
                                            </div>
                                        </ul>
                                    </li>

                                    <li>
                                        <span class="btn btn-info mb-2 text-center font-weight-bold category-class">
                                            Lớp 5
                                        </span>
                                        <ul>
                                            <div class="container">
                                                <div class="row">
                                                    {{-- style="display:flex; justify-content:space-between " --}}
                                                    @foreach ($subjects as $item)
                                                        @if ($item->class_id == 5)
                                                            <div class="col-3">
                                                                <input type="radio" name="select-class"
                                                                    {{ $item->id == $lesson->subject_id ? 'checked' : '' }}
                                                                    id="{{ $item->id }}">
                                                                <label class="col-md-10" style="border-radius: 30px"
                                                                    for="{{ $item->id }}">{{ $item->subject_name }}</label>
                                                            </div>
                                                        @endif
                                                    @endforeach
                                                </div>
                                            </div>
                                        </ul>
                                    </li>

                                    <li>
                                        <span class="btn btn-info mb-2 text-center font-weight-bold category-class">
                                            Lớp 6
                                        </span>
                                        <ul>
                                            <div class="container">
                                                <div class="row">
                                                    {{-- style="display:flex; justify-content:space-between " --}}
                                                    @foreach ($subjects as $item)
                                                        @if ($item->class_id == 6)
                                                            <div class="col-3">
                                                                <input type="radio" name="select-class"
                                                                    {{ $item->id == $lesson->subject_id ? 'checked' : '' }}
                                                                    id="{{ $item->id }}">
                                                                <label class="col-md-10" style="border-radius: 30px"
                                                                    for="{{ $item->id }}">{{ $item->subject_name }}</label>
                                                            </div>
                                                        @endif
                                                    @endforeach
                                                </div>
                                            </div>
                                        </ul>
                                    </li>

                                    <li>
                                        <span class="btn btn-info mb-2 text-center font-weight-bold category-class">
                                            Lớp 7
                                        </span>
                                        <ul>
                                            <div class="container">
                                                <div class="row">
                                                    {{-- style="display:flex; justify-content:space-between " --}}
                                                    @foreach ($subjects as $item)
                                                        @if ($item->class_id == 7)
                                                            <div class="col-3">
                                                                <input type="radio" name="select-class"
                                                                    {{ $item->id == $lesson->subject_id ? 'checked' : '' }}
                                                                    id="{{ $item->id }}">
                                                                <label class="col-md-10" style="border-radius: 30px"
                                                                    for="{{ $item->id }}">{{ $item->subject_name }}</label>
                                                            </div>
                                                        @endif
                                                    @endforeach
                                                </div>
                                            </div>
                                        </ul>
                                    </li>


                                    <li>
                                        <span class="btn btn-info mb-2 text-center font-weight-bold category-class">
                                            Lớp 8
                                        </span>
                                        <ul>
                                            <div class="container">
                                                <div class="row">
                                                    {{-- style="display:flex; justify-content:space-between " --}}
                                                    @foreach ($subjects as $item)
                                                        @if ($item->class_id == 8)
                                                            <div class="col-3">
                                                                <input type="radio" name="select-class"
                                                                    {{ $item->id == $lesson->subject_id ? 'checked' : '' }}
                                                                    id="{{ $item->id }}">
                                                                <label class="col-md-10" style="border-radius: 30px"
                                                                    for="{{ $item->id }}">{{ $item->subject_name }}</label>
                                                            </div>
                                                        @endif
                                                    @endforeach
                                                </div>
                                            </div>
                                        </ul>
                                    </li>

                                    <li>
                                        <span class="btn btn-info mb-2 text-center font-weight-bold category-class">
                                            Lớp 9
                                        </span>
                                        <ul>
                                            <div class="container">
                                                <div class="row">
                                                    {{-- style="display:flex; justify-content:space-between " --}}
                                                    @foreach ($subjects as $item)
                                                        @if ($item->class_id == 9)
                                                            <div class="col-3">
                                                                <input type="radio" name="select-class"
                                                                    {{ $item->id == $lesson->subject_id ? 'checked' : '' }}
                                                                    id="{{ $item->id }}">
                                                                <label class="col-md-10" style="border-radius: 30px"
                                                                    for="{{ $item->id }}">{{ $item->subject_name }}</label>
                                                            </div>
                                                        @endif
                                                    @endforeach
                                                </div>
                                            </div>
                                        </ul>
                                    </li>
                                    <li>
                                        <span class="btn btn-info mb-2 text-center font-weight-bold category-class">
                                            Lớp 10
                                        </span>
                                        <ul>
                                            <div class="container">
                                                <div class="row">
                                                    {{-- style="display:flex; justify-content:space-between " --}}
                                                    @foreach ($subjects as $item)
                                                        @if ($item->class_id == 4)
                                                            <div class="col-3">
                                                                <input type="radio" name="select-class"
                                                                    {{ $item->id == $lesson->subject_id ? 'checked' : '' }}
                                                                    id="{{ $item->id }}">
                                                                <label class="col-md-10" style="border-radius: 30px"
                                                                    for="{{ $item->id }}">{{ $item->subject_name }}</label>
                                                            </div>
                                                        @endif
                                                    @endforeach
                                                </div>
                                            </div>
                                        </ul>
                                    </li>

                                    <li>
                                        <span class="btn btn-info mb-2 text-center font-weight-bold category-class">
                                            Lớp 11
                                        </span>
                                        <ul>
                                            <div class="container">
                                                <div class="row">
                                                    {{-- style="display:flex; justify-content:space-between " --}}
                                                    @foreach ($subjects as $item)
                                                        @if ($item->class_id == 11)
                                                            <div class="col-3">
                                                                <input type="radio" name="select-class"
                                                                    {{ $item->id == $lesson->subject_id ? 'checked' : '' }}
                                                                    id="{{ $item->id }}">
                                                                <label class="col-md-10" style="border-radius: 30px"
                                                                    for="{{ $item->id }}">{{ $item->subject_name }}</label>
                                                            </div>
                                                        @endif
                                                    @endforeach
                                                </div>
                                            </div>
                                        </ul>
                                    </li>

                                    <li>
                                        <span class="btn btn-info mb-2 text-center font-weight-bold category-class">
                                            Lớp 12
                                        </span>
                                        <ul>
                                            <div class="container">
                                                <div class="row">
                                                    {{-- style="display:flex; justify-content:space-between " --}}
                                                    @foreach ($subjects as $item)
                                                        @if ($item->class_id == 12)
                                                            <div class="col-3">
                                                                <input type="radio" name="select-class"
                                                                    {{ $item->id == $lesson->subject_id ? 'checked' : '' }}
                                                                    id="{{ $item->id }}">
                                                                <label class="col-md-12" style="border-radius: 30px"
                                                                    for="{{ $item->id }}">{{ $item->subject_name }}</label>
                                                            </div>
                                                        @endif
                                                    @endforeach
                                                </div>
                                            </div>
                                        </ul>
                                    </li>


                                </ul>
                            </li>
                        </ul>

                        <!-- End Form Row -->
                        <!-- Form Row -->
                        <ul class="tree">
                            <li>
                                <span class="btn mb-3 blue-btn btn-lg  text-center font-weight-bold category-class"
                                    style="font-family: Arial, Helvetica, sans-serif">Chọn chuyên đề</span>

                                <ul>
                                    <div class="container">
                                        <div class="row">
                                            {{-- style="display:flex; justify-content:space-between " --}}
                                            @foreach ($tags as $item)
                                                @if ($lesson->tag_list != null)
                                                    <div class="col-6">
                                                        <input type="checkbox" name="select-tag[]"
                                                            id="tag-{{ $item->id }}"
                                                            {{ in_array($item->id, $lesson->tag_list) ? 'checked' : '' }}>
                                                        <label class="col-md-10" style="border-radius: 30px"
                                                            for="tag-{{ $item->id }}">{{ $item->name }}</label>
                                                    </div>
                                                @else
                                                    <div class="col-6">
                                                        <input type="checkbox" name="select-tag[]"
                                                            id="tag-{{ $item->id }}">
                                                        <label class="col-md-10" style="border-radius: 30px"
                                                            for="tag-{{ $item->id }}">{{ $item->name }}</label>
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                </ul>
                            </li>
                        </ul>
                    </div>
            </div>
        </div>
        </form>
        <div id="questlist-modal" class="modal fade bd-example-modal-lg " tabindex="-1" role="document"
            aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">

                <div class="modal-content">

                    <div class="modal-header ">
                        <div class="mx-auto md-col-10" style="width: 200px;">
                            <h5 class="modal-title text-center"> Question List</h5>

                        </div>
                        <div class="md-col-2">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                    </div>


                    <div class="model-body">
                        <form action="" id="popup_form" id="questionfrm">
                            @csrf
                            <table class="table table-bordered manage-candidates-top mb-2">

                                <thead class="bg-light">
                                    <tr class="text-center">
                                        <th class="w-5" style="width:10%" scope="col"> No#
                                        </th>

                                        <th class="w-18" style="width:50%" scope="col">Title
                                        </th>
                                        <th class="w-18" style="width:10%" scope="col">Add</th>

                                    </tr>
                                </thead>
                                <tbody style="font-family: Arial, Helvetica, sans-serif">

                                    @foreach ($questions as $item)
                                        <tr>
                                            <td class="text-center">{{ $loop->iteration }}</td>
                                            <td>
                                                <div>
                                                    @if (preg_match('/<img\s+src="([^"]+)"/', $item->question_name, $matches))
                                                        <img width="600" src="{{ $matches[1] }}">
                                                    @else
                                                        {!! $item->question_name !!}
                                                    @endif
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                <input type="checkbox" class="checkbox" target="{{ $item->id }}"
                                                    name="questions" value="{{ $item->id }}">
                                            </td>
                                        </tr>
                                    @endforeach


                            </table>

                            <div class="container mb-3 mt-3  text-center">
                                <div class="row text-center">
                                    <div class="col-sm">
                                        <button type="button" class="btn btn-secondary col-md-6" data-dismiss="modal"
                                            onclick="onCancel()">Cancel</button>
                                    </div>
                                    <div class="col-sm">
                                        <input type="button" id="btnQList" name="submit"
                                            class="btn btn-primary submitbtn col-md-6" data-dismiss="modal"
                                            value="Save changes">
                                    </div>
                                </div>
                            </div>

                            </tbody>
                        </form>
                    </div>
                </div>
            </div>

        </div>
        <div id="selected-questions">
            <div class="form-row mt-1">
                <!-- Form group -->
                <div class="col-lg-6 mb-1">
                    <h4>Selected questions</h4>
                </div>
                <!-- Form group -->
                <div class="form-group col-lg-6 text-right mb-1">
                    <button type="button" class="btn blue-btn btn-lg col-md-5 " id="btnOpenModal" data-toggle="modal"
                        data-target="#questlist-modal">New questions &nbsp;
                        <i class="fa fa-plus" aria-hidden="true"></i>
                </div>
            </div>
        </div>
        <table class="table table-hover mb-0" id=" my-table">
            <thead class="bg-light">
                <tr class="text-center">
                    <th>No#</th>
                    <th class="w-75" scope="col">Title</th>
                    <th></th>
                </tr>
            </thead>
            <tbody id="selected-quest" class="text-center" style="font-family: Arial, Helvetica, sans-serif">
                @foreach ($questlist as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            <div>
                                @if (preg_match('/<img\s+src="([^"]+)"/', $item->question_name, $matches))
                                    <img width="600" src="{{ $matches[1] }}">
                                @else
                                    {!! $item->question_name !!}
                                @endif
                            </div>
                        </td>
                        <td>
                            <button type="button" class="removeBtn btn btn-secondary"
                                value="{{ $item->id }}">Remove</button>
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>
    </div>
    <div class="row mt-5">
        <div class="col-md-6 mt-2 text-left">
            <i class="fa-solid fa-square-chevron-left"></i><a class="btn gray-btn btn-lg col-md-4"
                style="text-decoration:none" href="{{ url('/teacher/lesson/list') }}" title="上記内容で登録する">BACK</a>
        </div>

        <div class="col-md-6 mt-2 text-right">
            <input type="button" class="btn yellow-btn btn-lg col-md-4" id="btnLessonsfrm" value="SAVE">
        </div>
    </div>
    </div>
    <style>
        ul {
            list-style: none;
        }

        .category-class {
            display: inline-block;
            margin-left: -35px;
        }

        input[name="select-class"] {
            display: none;
        }

        input[name="select-class"]+label {

            text-align: center;


            font-family: 'Courier New', Courier, monospace;
            background-color: #fdfdffef;
            border: 1px solid #ccc;
            padding: 4px 5px;
            cursor: pointer;
            border-radius: 4px;
        }

        input[name="select-class"]:checked+label {
            background-color: #007bff;
            color: #fff;
        }

        input[name="select-tag[]"] {
            display: none;
        }

        input[name="select-tag[]"]+label {
            text-align: center;
            font-family: 'Courier New', Courier, monospace;
            background-color: #fdfdffef;
            border: 1px solid #ccc;
            padding: 4px 5px;
            cursor: pointer;
            border-radius: 4px;
        }

        input[name="select-tag[]"]:checked+label {
            background-color: #007bff;
            color: #fff;
        }
    </style>
    <script>
        // var quill = new Quill('#editor', {
        //     theme: 'snow',
        //     modules: {
        //         toolbar: [
        //             [{
        //                 'header': [1, 2, 3, 4, 5, 6, false]
        //             }],
        //             [{
        //                 'font': []
        //             }],
        //             ['bold', 'italic', 'underline', 'strike'],
        //             [{
        //                 'color': []
        //             }, {
        //                 'background': []
        //             }],
        //             [{
        //                 'align': []
        //             }],
        //             [{
        //                 'list': 'ordered'
        //             }, {
        //                 'list': 'bullet'
        //             }],
        //             ['link', 'image', 'video'],
        //             ['clean']
        //         ]
        //     },
        //     formats: [
        //         'header', 'font', 'size',
        //         'bold', 'italic', 'underline', 'strike', 'blockquote',
        //         'list', 'bullet', 'indent',
        //         'link', 'image', 'video', 'align'
        //     ]
        // });

        var editor = CKEDITOR.replace('editor', {
            height: '300px'
        });
        const reload = () => window.location.reload();
        let json = @json($questions);
        let qlist = @json($questlist);

        let checkValues = new Set() // new Value
        let checkValuesCache = new Set() //old Value
        const checked_class = [];

        function onCancel() {
            checkValues = new Set(checkValuesCache) //shallow copy
            $('input[name="questions"]:checked').map((i, el) => {
                $(el).prop('checked', false)
            })

            $('input[name="questions"] ').map((i, el) => {
                if (checkValues.has(parseInt($(el).val()))) {
                    $(el).prop('checked', true)
                }
            })
        }

        $(document).ready(function() {
            var selectedTags = $('input[name="select-tag[]"]:checked').map(function() {
                return $(this).attr('id').replace('tag-', '');
            }).get();

            $('input[name="select-tag[]"]').on('change', function() {
                if ($(this).is(':checked')) {
                    selectedTags.push($(this).attr('id').replace('tag-', ''));
                } else {
                    var index = selectedTags.indexOf($(this).attr('id').replace('tag-', ''));
                    if (index > -1) {
                        selectedTags.splice(index, 1);
                    }
                }

                console.log(selectedTags);
            });
            $('.tree li > ul').hide();

            // Toggle visibility of child elements when parent element is clicked
            $('.tree li > span').click(function() {
                $(this).siblings('ul').toggle();
            });
            $('input:checkbox[name=questions]').change(function() {
                checkValues[this.checked ? 'add' : 'delete'](parseInt($(this).val()))
            });
            let content = @json($lesson_content);
            editor.setData(content)
            // $('.category-class li > ul').hide();

            // Toggle visibility of child elements when parent element is clicked
            // $('.category-class li > span').click(function() {
            //     $(this).siblings('ul').toggle();
            // });
            qlist.map((el, i) => {
                checkValues.add(parseInt(el.id))
            })
            $('input[name="select-class"]:checked').each(function() {
                checked_class.push($(this).attr('id'))
            })
            $('input[name="select-class"]').change(function() {
                const value = $(this).attr('id')
                if ($(this).is(':checked')) {
                    checked_class.push(value)
                } else {
                    const index = checked_class.indexOf(value)
                    if (index > -1) {
                        checked_class.splice(index, 1)
                    }
                }

            })

            $('#btnOpenModal').click(function() {
                checkValuesCache = new Set(checkValues)
                $('input[name="questions"] ').map((i, el) => {
                    if (checkValues.has(parseInt($(el).val()))) {
                        $(el).prop('checked', true)
                    }
                })
            })
            $('.removeBtn').click(function() {
                $(this).closest('tr').remove()
                checkValues.delete(parseInt(this.value))
                checkValuesCache = new Set(checkValues)
            })

            $('#btnQList').click(function() {
                checkValuesCache = new Set(checkValues)

                let form = document.getElementById("popup_form")
                let quest_ids = (new FormData(form)).getAll('questions')
                let numArr = []
                for (let index = 0; index < quest_ids.length; index++) {
                    numArr.push(parseInt(quest_ids[index]));
                }
                checkValues = new Set(numArr)
                addQuest()
                checkValuesCache = new Set(checkValues)

            })

            $("#btnLessonsfrm").click(function() {

                let form = document.getElementById('lessonfrm')
                let data = new FormData(form)
                let qdata = (Array.from(checkValuesCache)).sort((a, b) => a - b)
                let lesson_url = (data.getAll('lesson_url')).pop()
                let video = (data.getAll('video')).pop()
                let lesson_name = (data.getAll('lesson_name')).pop()
                let content = CKEDITOR.instances.editor.getData();
                let subject_id = ($('input[name="select-class"]:checked').attr('id'))
                let tag_list = selectedTags;
                $.ajax({
                    type: "POST",
                    url: "<?= route('teacher.lesson.update', $lesson->id) ?>",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    //enctype: 'multipart/form-data',
                    data: {
                        lesson_name: lesson_name,
                        video: video,
                        questions: qdata,
                        subject_id: subject_id,
                        lesson_url: lesson_url,
                        content: content,
                        tag_list: tag_list,
                    },
                    success: function(response) {
                        swal.fire({
                            text: 'Saved',
                            icon: 'success',
                        }).then((result) => {
                            window.location = '{{ route('teacher.lessons-list') }}'
                        })

                    },
                    error: function(er) {}
                });
            })

            function onDelete() {

                var id = parseInt(this.value)
                $(this).closest('tr').remove();
                checkValues.delete(id)

            }

            function addQuest() {
                let wrap = $('#selected-quest')

                $(wrap).empty()
                let copy_json = Array.from(json); //shallow copy         

                copy_json = copy_json.filter(x => checkValues.has(x.id))

                copy_json.map((x, i) => {
                    let questionName = x.question_name;
                    const imgRegex = /<img src="data:image\/[^;]+;base64,([^"]+)"\s*\/?>/g;
                    let match = imgRegex.exec(questionName);
                    if (match) {
                        questionName = `<img width="600" src="data:image/png;base64,${match[1]}">`;
                    }
                    $(wrap).append(`
                <tr class="text-center">
                    <td>${++i}</td>
                    <td>${ questionName}</td>
                    <td >          
                        <button type="button" class="removeBtn btn btn-secondary" value="${ x.id }"  >Remove</button>
                    </td>
                </tr>
              `)
                })
                $('.removeBtn').click(onDelete)
            }
        })
    </script>
@stop
