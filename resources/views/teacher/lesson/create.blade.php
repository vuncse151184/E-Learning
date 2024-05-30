@extends('teacher.layouts.app')
@section('content')
    <link href="/css/quill-snow.css" rel="stylesheet">
    <script src="/js/quill.min.js"></script>
    <script src="/js/jquery.min.js"></script>
    <script src="//cdn.ckeditor.com/4.20.2/full/ckeditor.js"></script>

    <h3>Create new Lesson </h3>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <form class="mt-2" action="{{ url('teacher/lesson/store') }}" id="lessonfrm" method="POST">
                    @csrf

                    <!-- Form Block -->
                    <div class="mb-5 frm-block form-web">

                        <div class="form-row">
                            <!-- Form group -->
                            <div class="form-group col-md-12">
                                <label for="lesson_name" class="font-weight-bold">Lesson name <span
                                        class="red-required">Required</span></label>
                                <input type="text" rows="4" id="lesson_name" name="lesson_name"
                                    class="form-control" id="lesson_name" placeholder="Enter lesson name">
                                <span class="form-message"></span>
                            </div>
                            <!-- End Form group -->
                        </div>

                        <div class="form-row mb-5">
                            <!-- Form group -->
                            <div class="form-group col-md-12">
                                <label for="lesson_name" class="font-weight-bold">Content <span
                                        class="red-required">Optional</span></label>

                                <textarea name="editor" id="editor"></textarea>

                            </div>
                            <!-- End Form group -->
                        </div>
                        <script>
                            CKEDITOR.replace('editor');
                        </script>


                        <div class="form-row">
                            <!-- Form group -->
                            <div class="form-group col-md-12">
                                <label for="lesson_url" class="font-weight-bold">Lesson URL <span
                                        class="red-required">Required</span></label>
                                <input type=text id="lesson_url" rows="4" name="lesson_url" class="form-control" id="lesson_url"
                                    placeholder="Embedded from Google">
                                <span class="form-message"></span>
                            </div>
                            <!-- End Form group -->
                        </div>
                        <!-- Form Row -->
                        <div class="form-row">
                            <!-- Form group -->
                            <div class="form-group col-md-12">
                                <label for="video" class="font-weight-bold">Lesson slides <span
                                        class="red-required">Required</span></label>
                                <textarea placeholder="Embedded from GoogleDocs" id="video_url" rows="4" name="video" class="form-control"
                                    id="video"></textarea>
                                <span class="form-message"></span>
                            </div>
                            <!-- End Form group -->
                        </div>
                        <!-- End Form Row -->

                        <!-- Form Row -->
                        <ul class="tree">
                            <li>
                                <span class="btn mb-3 blue-btn btn-lg  text-center font-weight-bold category-class"
                                    style="font-family: Arial, Helvetica, sans-serif">Chọn Lớp</span>
                                <ul>

                                    <li>
                                        <span class="btn btn-info mb-2 text-center font-weight-bold category-class">
                                            Lớp 1
                                        </span>
                                        <ul>
                                            <div class="container">
                                                <div class="row">
                                                    @foreach ($subjects as $item)
                                                        @if ($item->class_id == 1)
                                                            <div class="col-3">
                                                                <input type="radio" name="select-class"
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
                                                    @foreach ($subjects as $item)
                                                        @if ($item->class_id == 2)
                                                            <div class="col-3">
                                                                <input type="radio" name="select-class"
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
                                                    @foreach ($subjects as $item)
                                                        @if ($item->class_id == 3)
                                                            <div class="col-3">
                                                                <input type="radio" name="select-class"
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
                                                    @foreach ($subjects as $item)
                                                        @if ($item->class_id == 4)
                                                            <div class="col-3">
                                                                <input type="radio" name="select-class"
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
                                                    @foreach ($subjects as $item)
                                                        @if ($item->class_id == 5)
                                                            <div class="col-3">
                                                                <input type="radio" name="select-class"
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
                                                    @foreach ($subjects as $item)
                                                        @if ($item->class_id == 6)
                                                            <div class="col-3">
                                                                <input type="radio" name="select-class"
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
                                                    @foreach ($subjects as $item)
                                                        @if ($item->class_id == 7)
                                                            <div class="col-3">
                                                                <input type="radio" name="select-class"
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
                                                    @foreach ($subjects as $item)
                                                        @if ($item->class_id == 8)
                                                            <div class="col-3">
                                                                <input type="radio" name="select-class"
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
                                                    @foreach ($subjects as $item)
                                                        @if ($item->class_id == 9)
                                                            <div class="col-3">
                                                                <input type="radio" name="select-class"
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
                                                    @foreach ($subjects as $item)
                                                        @if ($item->class_id == 10)
                                                            <div class="col-3">
                                                                <input type="radio" name="select-class"
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
                                                    @foreach ($subjects as $item)
                                                        @if ($item->class_id == 11)
                                                            <div class="col-3">
                                                                <input type="radio" name="select-class"
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
                                                    @foreach ($subjects as $item)
                                                        @if ($item->class_id == 12)
                                                            <div class="col-3">
                                                                <input type="radio" name="select-class"
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
                                                <div class="col-6">
                                                    <input type="checkbox" name="select-tag[]"
                                                        id="tag-{{ $item->id }}">
                                                    <label class="col-md-10" style="border-radius: 30px"
                                                        for="tag-{{ $item->id }}">{{ $item->name }}</label>
                                                </div>
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
                            <h5 class="modal-title "> Question List</h5>
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
                            @if ($questions != null)
                                <table class="table table-bordered manage-candidates-top">
                                    <thead class="bg-light">
                                        <tr class="text-center">
                                            <th class="w-10" style="width:10%" scope="col">No#</th>

                                            <th class="w-18" style="width:50%" scope="col">Title</th>
                                            <th class="w-18" style="width:10%" scope="col"> </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($questions as $item)
                                            <tr>
                                                <td class="text-center">{{ $loop->iteration }}</td>

                                                <td>
                                                    <div>

                                                        <div class="question"
                                                            style="font-family: Arial, Helvetica, sans-serif">
                                                            @if (preg_match('/<img\s+src="([^"]+)"/', $item->question_name, $matches))
                                                                <img width="400" src="{{ $matches[1] }}">
                                                            @else
                                                                {!! $item->question_name !!}
                                                            @endif
                                                        </div>

                                                    </div>
                                                </td>
                                                <td class="text-center">
                                                    <input type="checkbox" class="checkbox" target="{{ $item->id }}"
                                                        name="questions" value="{{ $item->id }}">
                                                </td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            @else
                                <p>No questions found</p>
                            @endif


                        </form>
                    </div>

                    <div class="modal-footer">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-6 text-right">
                                    <button type="button" class="btn btn-secondary btn-lg col-md-6" data-dismiss="modal"
                                        onclick="onCancel()">Cancel</button>
                                </div>
                                <div class="col-md-6">
                                    <input type="button" id="btnQList" name="submit"
                                        class="btn btn-primary btn-lg submitbtn col-md-6 " data-dismiss="modal"
                                        value="Save changes">
                                </div>
                            </div>
                        </div>
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
                <div class="form-group col-lg-6 text-right mb-1">
                    {{-- <div class="form-inline frm-inline text-right"> --}}
                    <button type="button" class="btn blue-btn btn-lg col-md-5 text-center font-weight-bold"
                        id="btnOpenModal" data-toggle="modal" data-target="#questlist-modal">New Question &nbsp;
                        <i class="fa fa-plus" aria-hidden="true"></i></button>
                    {{-- </div> --}}
                </div>
            </div>
            <div class="form-row added " id="text"></div>

            <table class="table table-hover mb-0" id=" my-table">
                <thead class="bg-light">
                    <tr class="text-center">
                        <th class="w-25" scope="col">No#</th>
                        <th class="w-50" scope="col">Question</th>
                        <th class="w-25" scope="col"> </th>
                    </tr>
                </thead>
                <tbody id="selected-quest">
                </tbody>
            </table>
        </div>

        <div class="containter col-md-12 mb-4 mt-5">
            <div class="row">
                <div class="col-md-6 ">
                    <a class="btn gray-btn btn-lg col-md-4" href="{{ url('teacher/lesson/list') }}"
                        title="">BACK</a>

                </div>
                <div class="col-md-6 text-right">
                    <input type="button" class="btn yellow-btn btn-lg col-md-4" id="btnLessonsfrm" value="SAVE">
                </div>
            </div>
        </div>
    </div>
    </div>
    <script src="{{ asset('/js/validator.js') }}"></script>
    <style>
        * {
            font-family: Arial, Helvetica, sans-serif,

        }

        ul {
            list-style: none;
        }

        .category-class {
            font-family: "Gill Sans", sans-serif;
            display: inline-block;
            margin-left: -35px;
        }

        input[type="radio"] {
            display: none;
        }

        input[type="radio"]+label {
            text-align: center;
            font-family: 'Courier New', Courier, monospace;
            background-color: #fdfdffef;
            border: 1px solid #ccc;
            padding: 4px 5px;
            cursor: pointer;
            border-radius: 4px;
        }

        input[type="radio"]:checked+label {
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
        Validator({
            form: '#lessonfrm',
            rules: [
                Validator.isRequired('#lesson_name'),
                Validator.isRequired('#video_url'),
            ]
        })
    </script>

    <script>
        const reload = () => window.location.reload();
        let json = @json($questions);
        let checkValues = new Set() // new Value
        let checkValuesCache = new Set() //old Value
        const checked_class = [];
        $(document).ready(function() {
            var selectedTags = [];

            $('input[name="select-tag[]"]').on('change', function() {
                if ($(this).is(':checked')) {
                    selectedTags.push($(this).attr('id').replace('tag-', ''));
                } else {
                    var index = selectedTags.indexOf($(this).attr('id').replace('tag-', ''));
                    if (index > -1) {
                        selectedTags.splice(index, 1);
                    }
                }
            });
            $('.tree li > ul').hide();

            // Toggle visibility of child elements when parent element is clicked
            $('.tree li > span').click(function() {
                $(this).siblings('ul').toggle();
            });
            $('input:checkbox[name=questions]').change(function() {
                checkValues[this.checked ? 'add' : 'delete'](parseInt($(this).val()))
            });
            $("#btnQList").click(function() {
                let form = document.getElementById("popup_form")
                let quest_ids = (new FormData(form)).getAll('questions[]')
                addQuest()
                checkValuesCache = new Set(checkValues) //shallow copy

            })
            $("button[type='button']").click(function() {
                checkValuesCache = new Set(checkValues)

                $('input[name="questions"]:checked').map((i, el) => {
                    $(el).prop('checked', false)
                })

                $('input[name="questions"] ').map((i, el) => {
                    if (checkValues.has(parseInt($(el).val()))) {
                        $(el).prop('checked', true)
                    }
                })
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
            $("#btnLessonsfrm").click(function(e) {
                e.preventDefault()
                let form = document.getElementById('lessonfrm')
                let data = new FormData(form)
                let qdata = (Array.from(checkValuesCache)).sort((a, b) => a - b)
                let lesson_name = (data.getAll('lesson_name')).pop()
                let video = (data.getAll('video')).pop()
                let content = CKEDITOR.instances.editor.getData();
                let lesson_url = (data.getAll('lesson_url')).pop()
                let subject_id = $('input[name="select-class"]:checked').attr('id')
                let tag_list = selectedTags;
                $.ajax({
                    type: "POST",
                    cache: false,
                    url: "<?= route('teacher.lesson.store') ?>",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
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
                            text: 'Create success',
                            icon: 'success',
                        }).then(() => {
                            window.location = '{{ route('teacher.lessons-list') }}'
                        })


                    },
                    error: function(er) {
                        console.log(er)
                    }
                });
            })
        });

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
                    <tr>
                        <td class="text-center">${++i}</td>
                        <td style="font-family: Arial, Helvetica, sans-serif">${ questionName }</td>
                        <td class="text-center">
                            <button type="button" value="${ x.id }" class="removeBtn btn btn-secondary">Remove</button>
                        </td>
                    </tr>
                `)
            })
            $('.removeBtn').click(onDelete)
        }

        function onDelete() {
            var id = parseInt(this.value)
            $(this).closest('tr').remove();
            checkValues.delete(id)
        }

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
    </script>
@stop
