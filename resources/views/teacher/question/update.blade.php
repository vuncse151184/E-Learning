{{-- <link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script> --}}
@extends('teacher.layouts.app')
@section('content')
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="//cdn.ckeditor.com/4.20.2/full/ckeditor.js"></script>
    <div class="row">
        <div class="col-md-12">
            <div class="section-title-02 mb-4">
                <h4>Edit Question</h4>
            </div>
            <div>
                <!-- Form -->
                <form class="mt-4" action="{{ url('/teacher/question/update/' . $question->id) }}" method="post"
                    id="frm_update" enctype="multipart/form-data">
                    <!-- Form Block -->
                    @csrf
                    <div class="form-row mb-5 frm-block form-web">
                        <div class="form-group col-md-12">
                            <label for="lesson_name" class="font-weight-bold">Question <span
                                    class="red-required">Required</span></label>
                                    <textarea name="editor" id="editor"></textarea>


                        </div>

                        {{--    <div class="form-group col-md-12 mb-2 quest-basic">
                            <label class="font-weight-bold">Question Name <span class="red-required">Optional</span></label>
                            <textarea class="form-control" rows="2" id="quest_name" name="description">{{ $question->description }}</textarea>
                            <span class="form-message"></span>
                        </div>

                        <div class="form-group col-md-12 quest-basic">
                            <label class="font-weight-bold" >Answer option</label>
                            <div class="container">
                                <div class="row ">
                                    <div class="row align-items-center">

                                        @if ($options != null)
                                            @foreach ($options as $item)
                                                <div class="col-md-12 mt-1">

                                                    <label for="options[]">
                                                        {{ ['A', 'B', 'C', 'D'][$loop->index] }}</label>
                                                    <input type="text" id="{{ ['A', 'B', 'C', 'D'][$loop->index] }}"
                                                        class="form-control-sm col-md-7 ml-2" name="options[]"
                                                        value="{{ $item }}" placeholder="">
                                                </div>
                                            @endforeach
                                        @elseif($options==null)
                                            <div class="col-md-12 mb-1">
                                                <label for="A" class="font-weight-bold">A.</label>
                                                <input type="text" class="form-control-sm col-md-7" name="options[]"
                                                    id="A" placeholder="Enter option A">
                                            </div>
    
                                            <div class="col-md-12 mt-1 mb-1">
                                                <label for="B" class="font-weight-bold">B.</label>
                                                <input type="text" class="form-control-sm col-md-7" name="options[]"
                                                    id="B" placeholder="Enter option B">
    
                                            </div>
    
                                            <div class="col-md-12 mt-1 mb-1">
                                                <label for="C" class="font-weight-bold">C.</label>
                                                <input type="text" class="form-control-sm col-md-7" name="options[]"
                                                    id="C" placeholder="Enter option C">
                                            </div>
    
                                            <div class="col-md-12 mt-1">
                                                <label for="D" class="font-weight-bold">D.</label>
                                                <input type="text" class="form-control-sm col-md-7" name="options[]"
                                                    id="D" placeholder="Enter option D">
    
                                            </div>
                                        
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group col-md-12 mb-2 quest-image">
                            <label for="lesson_name" class="font-weight-bold">Question Image</label>
                            <div class="container">
                                <div class="preview">
                                    <img id="img-preview" src="{{ asset($question->question_image) }}" />
                                    <label id="upload-image" for="file-input">Upload Image</label>
                                    <input accept="image/*" type="file" id="file-input" name="question_img" />
                                </div>
                            </div>
                        </div> --}}
                        {{-- <fieldset class="multiswitch ">
                            <div class="slide-container">
                                <input type="radio" name="question-type" id="0"
                                    {{ $question->flag_image == 0 ? 'checked' : '' }}>
                                <label for="0">Basic</label>
                                <input type="radio" name="question-type" id="1"
                                    {{ $question->flag_image == 1 ? 'checked' : '' }}>
                                <label for="1">Image</label>
                                <!-- leave this "slide" -->
                                <a class="slide" aria-hidden="true"></a>
                            </div>
                        </fieldset> --}}

                        <label class="font-weight-bold">Correct answer</label>
                        <div class="container col-md-12 mb-4">
                            <div class="row col-md-12 mt-2">
                                <div class="row align-items-center col-md-12" id="selectedDiv">

                                    <div class="col-md-1">
                                        <label for="A"> A</label>
                                        <input type="checkbox" id="A" name="results[]" value="A">

                                    </div>

                                    <div class="col-md-1">
                                        <label for="B"> B</label>
                                        <input type="checkbox" id="B" name="results[]" value="B">

                                    </div>

                                    <div class="col-md-1">
                                        <label for="C"> C</label>
                                        <input type="checkbox" id="C" name="results[]" value="C">


                                    </div>
                                    <div class="col-md-1">
                                        <label for="D"> D</label>
                                        <input type="checkbox" id="D" name="results[]" value="D">

                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>

                        <!-- End Form Block -->

                        <!-- Button Block-->
                        <div class="col-md-12 text-center mt-5">
                            <div class="row">
                                <div class="col col-md-6">
                                    <a href="{{ url('teacher/question/list') }}"
                                        class="btn gray-btn btn-lg col-md-4">CANCEL</a>
                                </div>
                                <div class="col col-md-6">
                                    <input type="submit" value="SAVE CHANGES" id="btn_save"
                                        class="btn btn-primary btn-lg">
                                </div>
                            </div>
                        </div>



                        <!-- End Button Block-->
                </form>
                <!-- End Form -->
            </div>
        </div>
    </div>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        #file-input {
            display: none;
        }

        .preview {
            padding: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            width: 100%;
            max-width: 30%;
            margin: auto;
            background-color: rgb(255, 255, 255);
            box-shadow: 0 0 20px rgba(170, 170, 170, 0.2);
        }

        img {
            width: 100%;
            object-fit: cover;
            margin-bottom: 20px;
        }

        #upload-image {
            font-weight: 600;
            cursor: pointer;
            color: #fff;
            border-radius: 8px;
            padding: 10px 20px;
            background-color: rgb(101, 101, 255);
        }

        /*
                                                                                                                 CSS for the main interaction
                                                                                                                */
        .multiswitch input {
            position: absolute;
            left: -200vw;
        }

        .multiswitch .slide-container {
            position: relative;
            display: flex;
            max-width: 50em;
            line-height: 2em;
            /* don't allow highlighting the text inside the toggle */
            user-select: none;
        }

        .multiswitch .slide-container label {
            /* Even though we're using "flex" to display, we have to assign widths so that we know exactly where to position the slide */
            width: 50%;
            text-align: center;
            padding-left: 1em;
            padding-right: 1em;
            z-index: 2;
        }

        .multiswitch .slide-container a {
            position: absolute;
            left: 50%;
            z-index: 1;
            height: 100%;
            width: 50%;
            transition: left 0.1s ease-out;
            box-shadow: 1px 0 0 rgba(0, 0, 0, 0.2),
                inset 0 1px 0 rgba(255, 255, 255, 0.15);
        }

        /*
                                                                                                                  Auto adjusting widths
                                                                                                                */
        .multiswitch label:nth-last-child(6),
        .multiswitch label:nth-last-child(6)~label,
        .multiswitch label:nth-last-child(6)~a {
            width: 33.3334%;
        }

        .multiswitch label:nth-last-child(8),
        .multiswitch label:nth-last-child(8)~label,
        .multiswitch label:nth-last-child(8)~a {
            width: 25%;
        }

        .multiswitch label:nth-last-child(10),
        .multiswitch label:nth-last-child(10)~label,
        .multiswitch label:nth-last-child(10)~a {
            width: 20%;
        }

        .multiswitch label:nth-last-child(12),
        .multiswitch label:nth-last-child(12)~label,
        .multiswitch label:nth-last-child(12)~a {
            width: 16.6667%;
        }

        /*
                                                                                                                 Slider
                                                                                                                */

        /* all options, first selected */
        .multiswitch input:checked~a {
            left: 0;
            box-shadow: 1px 0 0 rgba(0, 0, 0, 0.2),
                inset 0 1px 0 rgba(255, 255, 255, 0.25);
        }

        /* 2 options, 2nd selected */
        .multiswitch label:nth-last-child(4)~input:nth-child(3):checked~a {
            left: 50%;
        }

        /* 3 options, 2nd selected */
        .multiswitch label:nth-last-child(6)~input:nth-child(3):checked~a {
            left: 33.3334%;
        }

        /* 3 options, 3rd selected */
        .multiswitch label:nth-last-child(6)~input:nth-child(5):checked~a {
            left: 66.6667%;
        }

        /* 4 options, 2nd selected */
        .multiswitch label:nth-last-child(8)~input:nth-child(3):checked~a {
            left: 25%;
        }

        /* 4 options, 3rd selected */
        .multiswitch label:nth-last-child(8)~input:nth-child(5):checked~a {
            left: 50%;
        }

        /* 4 options, 4th selected */
        .multiswitch label:nth-last-child(8)~input:nth-child(7):checked~a {
            left: 75%;
        }

        /* 5 options, 2nd selected */
        .multiswitch label:nth-last-child(10)~input:nth-child(3):checked~a {
            left: 20%;
        }

        /* 5 options, 3rd selected */
        .multiswitch label:nth-last-child(10)~input:nth-child(5):checked~a {
            left: 40%;
        }

        /* 5 options, 4th selected */
        .multiswitch label:nth-last-child(10)~input:nth-child(7):checked~a {
            left: 60%;
        }

        /* 5 options, 5th selected */
        .multiswitch label:nth-last-child(10)~input:nth-child(9):checked~a {
            left: 80%;
        }

        /* 6 options, 2nd selected */
        .multiswitch label:nth-last-child(12)~input:nth-child(3):checked~a {
            left: 16.6667%;
        }

        /* 6 options, 3rd selected */
        .multiswitch label:nth-last-child(12)~input:nth-child(5):checked~a {
            left: 33.3334%;
        }

        /* 6 options, 4th selected */
        .multiswitch label:nth-last-child(12)~input:nth-child(7):checked~a {
            left: 50%;
        }

        /* 6 options, 5th selected */
        .multiswitch label:nth-last-child(12)~input:nth-child(9):checked~a {
            left: 66.6667%;
        }

        /* 6 options, 6th selected */
        .multiswitch label:nth-last-child(12)~input:nth-child(11):checked~a {
            left: 83.3334%;
        }

        /*
                                                                                                                  Slider shadows
                                                                                                                */
        /* middle spots */
        .multiswitch input:not(:first-child):checked~a {
            box-shadow: 1px 0 0 rgba(0, 0, 0, 0.2),
                -1px 0 0 rgba(0, 0, 0, 0.2),
                inset 0 1px 0 rgba(255, 255, 255, 0.25);
        }

        /* last spots */
        .multiswitch label:nth-last-child(4)~input:nth-child(3):checked~a,
        .multiswitch label:nth-last-child(6)~input:nth-child(5):checked~a,
        .multiswitch label:nth-last-child(8)~input:nth-child(7):checked~a,
        .multiswitch label:nth-last-child(10)~input:nth-child(9):checked~a,
        .multiswitch label:nth-last-child(12)~input:nth-child(11):checked~a {
            box-shadow: -1px 0 0 rgba(0, 0, 0, 0.2),
                inset 0 1px 0 rgba(255, 255, 255, 0.25);
        }


        /*
                                                                                                                 RH Brand Styling
                                                                                                                */
        body {
            font: 16px/1.5em "Overpass", "Open Sans", Helvetica, sans-serif;
            color: #333;
        }

        fieldset {
            border: 0;
            padding: 0;
        }

        fieldset legend {
            display: block;
            margin-bottom: 10px;
            font-weight: 600;
        }

        .multiswitch .slide-container {
            background: #333;
            color: #fff;
            transition: background 0.1s ease-out;
            box-shadow: inset 0 2px 6px rgba(0, 0, 0, 0.3);
        }

        .multiswitch .slide-container label {
            cursor: pointer;
            text-shadow: 0 1px 1px rgba(0, 0, 0, .4);
        }

        .multiswitch .slide-container a {
            background: #0088ce;
            border: 1px solid #005f90;
        }

        /* Stoplight theme */
        .multiswitch[data-theme="stoplight"] .slide-container>a {
            background: #c00;
            border-color: #8a0000;
        }

        .multiswitch[data-theme="stoplight"] input:not(:first-child):checked~a {
            background: #ec7a08;
            border-color: #bc6106;
        }

        .multiswitch[data-theme="stoplight"] label:nth-last-child(4)~input:nth-child(3):checked~a,
        .multiswitch[data-theme="stoplight"] label:nth-last-child(6)~input:nth-child(5):checked~a,
        .multiswitch[data-theme="stoplight"] label:nth-last-child(8)~input:nth-child(7):checked~a,
        .multiswitch[data-theme="stoplight"] label:nth-last-child(10)~input:nth-child(9):checked~a,
        .multiswitch[data-theme="stoplight"] label:nth-last-child(12)~input:nth-child(11):checked~a {
            background: #3f9c35;
            border-color: #307628;
        }

        /*
                                                                                                                 Horizontal layout
                                                                                                                */
        .switch {
            display: inline-flex;
            align-items: center;
            flex-wrap: wrap;
        }

        /*
                                                                                                                 Because a11y
                                                                                                                */
        .multiswitch input:focus~a {
            outline: 2px solid #0088ce;
        }


        /*
                                                                                                                 Demo purposes only
                                                                                                                */
        *,
        *:before,
        *:after {
            box-sizing: border-box;
        }

        body {
            padding: 30px;
        }

        fieldset {
            margin-bottom: 3em;
        }
    </style>
    <script src="{{ asset('/js/validator.js') }}"></script>
    <script>
        var editor = CKEDITOR.replace('editor',{
            height:'300px'
        })

        $(document).ready(function() {
            let results = @json($results); 
            let question = @json($question);
            let checkboxes = $('input[type="checkbox"]');

            editor.setData(question.question_name)
            checkboxes.each(function() {
                let id = $(this).attr('id');
                if (results.includes(id)) {
                    $(this).prop('checked', true)
                }
            });
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('#btn_save').click(function(e) {
                e.preventDefault()
                let form = document.getElementById('frm_update')
                let data = new FormData(form)
                let results = data.getAll('results[]')
                let quest_name = editor.getData()
                $.ajax({
                    type: "post",
                    url: "<?= route('teacher.question.update', $question->id) ?>",
                    data: {
                        results: results,
                        question_name: quest_name,
                    },
                    cache: false,
                    success: function() {
                        swal.fire({
                            contentType: false,
                            cache: false,
                            processData: false,
                            text: "Update Success",
                            icon: 'success',
                        }).then(() => {
                            location = "{{ route('teacher.question.list') }}"
                        })
                    }
                })
            })
        })
    </script>
@stop
