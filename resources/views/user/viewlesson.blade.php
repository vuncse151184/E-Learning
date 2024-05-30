<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>Document</title>
    <!--   -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js"
        integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous">
    </script>
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js"
        integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous">
    </script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>

    <div class="row mr-4 mt-1">
        <div class="col-md-6 pl-4 pt-1">
            <a style="text-decoration: none" href="/" class="bn3637 bn36">
                <i class="fa fa-chevron-left" aria-hidden="true"></i> &nbsp; Back</a>
        </div>
        <div class="col-md-6 text-right mt-2">
            @if (!auth('user')->check())
                <section id="wb-so">
                    <a class="btn btn-primary" href="{{ route('home.login') }}"><span class="visible-xs">Sign
                            in</a>
                </section>
            @else
                <section id="wb-so">
                    <button class="btn btn-secondary" type="button">
                        {{ auth('user')->user()->name }} <i class="fa fa-user" aria-hidden="true"></i>
                    </button>
        </div>


    </div>
    </section>
    @endif
    </div>

    <div class="mx-auto ifram_wrapper mt-3">

        <iframe data-index="{{ $lesson_id }}" src="{{ $src }}" frameborder="0" width="800" height="400"
            allowfullscreen="true" mozallowfullscreen="true" webkitallowfullscreen="true" id="lesson_video"></iframe>
    </div>


    <div class="container mt-5 mb-5">

        <div class="row d-flex justify-content-center">
            <div id="card" class="col-md-8" style="border-radius: 20px; border : 1px solid black">
                <div id="timing" class="pt-1 pr-1">
                    <h5 class="card-text float-right font-weight-bold"> Total Time <br>
                        <span style="display:block; margin:0 auto">(00: <span id="time">00</span>)</span>
                    </h5>

                </div>
                <div class="card-body" id="numberOfQuestion">
                    <h5>( <span id="number">0</span> of <span class="last_q">5</span>)<br>

                </div>

                <div id="start_page" class="text-center pt-2 pb-3">
                    <h5 style="text-align: center">Leeson' quizzes</h5>
                    <button class="btn  d-flex mx-auto mt-4 mb-1" id="btn-start">
                        <h5 style="margin-top:10px">START <i class="fa fa-arrow-right" aria-hidden="true"></i></h5>
                    </button>
                </div>
                <div class="popup-container" hidden id="pop-up-notice">
                    <div class="popup-content">
                        <img src="path/to/image.jpg" alt="Image description">
                        <p>Oops, no questions have been found</p>
                        <button class="close-btn">Close</button>
                    </div>
                </div>
                <div id="main" class="pb-3">

                </div>
                {{-- <div id="review-title" class="text-center " style="display:none">
                    <h2> <span id="correct">0</span>/<span id="total">5</span> are correct!<br></h2>
                </div> --}}
                <div class="row col-md-12">
                    <div id="review-answer" class="col-md-12">

                    </div>
                </div>

                <!-- Result-->
                <div id="result">
                    {{-- <h3 class="mt-4"><span id="correct-answer">3</span> out of <span class="last_q"></span> are
                        correct
                    </h3> --}}
                    <h3 class="mt-4 "> Result : <span id="percentage">100%</span></h3>
                </div>

            </div>

        </div>

        <div class=" col-md-8 pt-4" style="display:flex; justify-content: space-around; margin:0 auto">
            <button class="btn col-md-3 " style="display:none" onclick="previous()" id="prev">Previous</button>
            <button class="btn col-md-3 " style="display:none" onclick="next()" id="next"
                data-index="1">Next</button>


        </div>
        <div class="pt-5" style="display:flex ;justify-content:center">

            <button class="btn btn-primary col-md-3 btn-lg mx-auto" id="finish" onclick="submit()">Finish</button>

        </div>
        <div class="pt-5" style="display:flex ;justify-content:center; ">

            <button class="btn btn-primary col-md-3 btn-lg mx-auto" style="display: none" id="btn-show-result"
                onclick="show_result()">View answer</button>

        </div>


        <script>
            var current_q = 0;
            var time = 100;
            var marks = 0;
            var timer;
            let json = @json($questions);
            let question_list = json
            var answers = new Array(question_list.length)
            var correct_answer = new Array()
            var current_a = new Array()
            let newArray = [];

            $(document).ready(function() {
                console.log(question_list)
                $('#main').hide()
                $('#result').hide()
                $('#numberOfQuestion').hide()
                $('#timing').hide()
                $('#finish').hide()

                question_list.map((el, i) => {
                    newArray.push(el.results)
                })
                newArray.forEach(function(element) {
                    let parsedElement = JSON.parse(element);
                    correct_answer.push(parsedElement);
                });
            })


            function show_question() {
                $('#number').text(current_q + 1)
                $('[id*=question_wrapper_]').map((idx, el) => {
                    $(el).hide()
                })
                $('#question_wrapper_' + current_q).show()
            }




            $('#btn-start').click(function(e){
                if (question_list.length === 0) {
                    e.preventDefault()
                    Swal.fire({
                        title: 'This lesson does not have any quizzes !',
                        icon: 'warning',
                        showConfirmButton: false,
                        timer: 2500,
                    })
                } else {
                    $('#lesson_video').hide()
                    $('#main').show()
                    $('#timing').show()
                    $('#numberOfQuestion').show()
                    $('#finish').show()
                    $('#prev').show()
                    $('#next').show()
                    add_quest()
                    show_question()
                    $('#start_page').hide()
                    timer = setInterval(timer_function, 1000);

                    function timer_function() {
                        $('#time').text(time)
                        if (time < 1) {
                            Swal.fire({
                                title: 'Time out!',
                                icon: 'warning',
                                width: '700px',
                                heightAuto: true,
                                color: '#716add',
                                showConfirmButton: false,
                                timer: 1500,

                            })
                            clearInterval(timer);
                            create_result(answers)
                            $('#finish').hide()
                            $('#main').hide()
                            $('#result').show()
                            $('#prev').hide()
                            $('#next').hide()
                            $('#numberOfQuestion').hide()
                            $('#btn-show-result').show()
                        }
                        time--;
                    }
                }
            })

            function submit() {
                let flag = 0;
                answers.map((el, i) => {

                    if (el == correct_answer[i]) {
                        flag++;
                    }
                })

                result = Math.round((flag / question_list.length) * 1000);
                let lesson_id = $('iframe').attr('data-index')

                $.ajax({
                    type: "post",
                    url: "<?= route('user.store-result') ?>",
                    data: {
                        result: result,
                        lesson_id: lesson_id
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        Swal.fire({
                            title: 'You are about to submit!?',
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Submit'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                create_result(answers)
                                Swal.fire(
                                    'Submitted!',
                                    'Your answer has been submitted.',
                                    'success'
                                )
                                clearInterval(timer)
                                $('#prev').hide()
                                $('#next').hide()
                                $('#numberOfQuestion').hide()
                                $('#finish').hide()
                                $('#btn-show-result').show()
                            }
                        })
                    },
                    error: function(er) {
                        console.log(er)
                    }
                })


            }

            function next() {
                current_q++
                if (current_q >= question_list.length) {

                    current_q = question_list.length - 1
                }
                $('#next').data('index')
                $('#main').show()
                show_question()
                this.current_a = new Array();
            }


            function previous() {
                current_q--
                if (current_q < 0) {
                    current_q = 0
                }
                $('#main').show()
                show_question()
                this.current_a = new Array();
            }


            function add_quest() {
                $('.last_q').text(question_list.length)
                question_list.map((el, i) => {
                    let questionName = el.question_name;
                    const imgRegex = /<img src="data:image\/[^;]+;base64,([^"]+)"\s*\/?>/g;
                    let match = imgRegex.exec(questionName);
                    if (match) {
                        questionName = `<img width="550" src="data:image/png;base64,${match[1]}">`;
                    }
                    $('#main').append(`
                        <div id="question_wrapper_${i}" class="pl-3">
                            <div class="mb-5 col-md-12 text-center">
                                ${questionName}
                            </div>
                            <div class="container">
                                <div class="row">
                                    ${add_option(el, i)}
                                </div>
                            </div>
                        </div>
                    `);
                });
            }

            function add_option(el, i) {
                let a = ""
                for (let index = 1; index <= 4; index++) {
                    a += `
                            <div class="col mr-3 option_wrapper_${index}_${i}">
                                <input type="checkbox" name="option_${i}" class="option-${index}" id="option_${index}_${i}" data-index="${['A', 'B', 'C', 'D'][index-1]}"
                                    onclick="select_ans('option_${index}_${i}')">
                                <label style="border-radius: 30px;"  class=" col-md-10  option option_${index}" for="option_${index}_${i}" >  ${[['A', 'B', 'C', 'D'][index-1]]} </label>              
                            </div>
                        `
                }
                return a
            }


            function create_result(data) {
                data.map((el, i) => {
                    if (JSON.stringify(el.sort()) === JSON.stringify(correct_answer[i].sort())) {
                        marks++;
                    }
                })
                $('#main').hide()
                $('#percentage').text(Math.round((marks / question_list.length) * 100) + "%")
                $('#result').show()
                $('#options').hide()
                $('#timing').hide()
            }

            function select_ans(eds) {
                if (answers[current_q] != undefined || answers[current_q] != null) {
                    current_a = answers[current_q];
                }
                if ($('#' + eds).is(':checked')) {
                    // Checkbox is checked
                    current_a.push($('#' + eds).data("index"));
                    answers[current_q] = current_a;
                } else {
                    // Checkbox is not checked
                    current_a.pop($('#' + eds).data("index"))
                };

            }

            function get_current_question() {
                if ($('#next').click()) {
                    current_q++
                    if (current_q >= question_list.length) {
                        current_q = question_list.length - 1
                    }
                }
                if ($('#prev').click()) {
                    current_q--
                    if (current_q < 0) {
                        current_q = 0
                    }
                }
                return current_q;
            }

            function show_question_to_review() {

                $('.last_q').text(question_list.length)
                question_list.map((el, i) => {
                    let questionName = el.question_name;
                    const imgRegex = /<img src="data:image\/[^;]+;base64,([^"]+)"\s*\/?>/g;
                    let match = imgRegex.exec(questionName);
                    if (match) {
                        questionName = `<img width="550" src="data:image/png;base64,${match[1]}">`;
                    }
                    $('#review-answer').append(`
                        <div class="mt-5">
                            <h4>Question ${i+1}</h4>
                            <div  id="result_wrapper_${i} >
                                
                                <div class="mb-2"> ${questionName}</div>
                                    <div class="container">
                                        <div class="col mt-4">
                                            ${add_option(el,i)} 
                                        </div>
                                    </div>.
                                </div>  
                            </div> 
                        </div>
                    `)
                })
            }

            function show_option_to_review(el, i) {
                let a = ""
                for (let index = 1; index <= 4; index++) {
                    a += `
                            <div class=" col-md-6 option_wrapper_${index}_${i} ">
                                <input type="checkbox" name="option_${i}" class="option-${index}" id="option_${index}_${i}" data-index="${['A', 'B', 'C', 'D'][index-1]}"
                                    onclick="select_ans('option_${index}_${i}')">
                                <label style="border-radius: 30px;"  class=" col-md-10  option option_${index}" for="option_${index}_${i}" >  ${[['A', 'B', 'C', 'D'][index-1]]} </label>              
                            </div>
                        `
                }


                return a
            }

            function show_result() {
                $('#btn-show-result').hide()
                $('#review-title').show()

                let correct = 0
                show_question_to_review()
                for (let i = 0; i < answers.length; i++) {
                    for (let j = 1; j <= 4; j++) {
                        let data = $('input[id=option_' + j + '_' + i + ']').data("index")
                        if (data != null || data != 0) {
                            if (answers[i].includes(data)) {
                                $('input[id=option_' + j + '_' + i + ']').prop('checked', true)
                                if (!correct_answer[i].includes(data)) {
                                    $('label[for=option_' + j + '_' + i + ']').css("color", "red")

                                    $('label[for=option_' + j + '_' + i + ']').css("color", "red")
                                    $('.option_wrapper_' + j + '_' + i).append(`
                                <span><i style="color:red" class="fa fa-times" aria-hidden="true"></i></span>
                            `)
                                }
                                // if (correct_answer[i].includes(data)) {
                                //     console.log("A:", correct_answer[i])
                                //     console.log("B:", data)

                                //     // if (JSON.stringify(correct_answer[i].sort()) === JSON.stringify(data.sort())) {
                                //     //     marks++;
                                //     // }
                                //     correct++
                                // }

                            };

                            if (correct_answer[i].includes(data)) {
                                $('.option_wrapper_' + j + '_' + i).append(`
                                <span><i style="color:green" class="fa fa-check" aria-hidden="true"></i></span>
                            `)
                                $('label[for=option_' + j + '_' + i + ']').css("color", "green")
                            };
                        }
                    }
                }

                $('#total').text(question_list.length)
                $('#result').hide()
                $('input[type=checkbox]').prop('disabled', true)
            }
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
                background-color: #8f9eae;
                color: #fff;
            }

            /* .option-1:checked:checked~.option_1,
            .option-2:checked:checked~.option_2,
            .option-3:checked:checked~.option_3,
            .option-4:checked:checked~.option_4 {
                background: rgba(199, 129, 129, 0.155);
                border-color: rgba(129, 164, 199, 0.559);
            } */

            .ifram_wrapper {
                display: flex;
                justify-content: center;
            }

            body {
                background: rgb(238, 174, 202);
                background: radial-gradient(circle, rgba(238, 174, 202, 1) 0%, rgba(148, 187, 233, 1) 100%);
            }

            #card {
                box-shadow: 12px 12px 2px 1px rgba(0, 0, 255, 0.081);
                width: 600px;
                padding: 30px;
                border-radius: 20px;
                background: rgba(255, 255, 255, 0.4);
            }

            #next,
            #prev {
                background: rgba(199, 129, 129, 0.155);
                border-color: rgba(199, 129, 129, 0.559);

            }

            #finish {
                background: rgba(223, 101, 101, 0.752);
                border-color: rgba(223, 101, 101, 0.752);
            }

            #btn-show-result {
                background: rgba(223, 101, 101, 0.752);
                border-color: rgba(223, 101, 101, 0.752);
            }

            .bn3637 {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                padding: 0.7rem 1.5rem 0.7rem 1.7rem;
                font-family: "Poppins", sans-serif;
                font-weight: 700;
                font-size: 18px;
                text-align: center;
                text-decoration: none;
                color: #fff;
                backface-visibility: hidden;
                border: 0.3rem solid transparent;
                border-radius: 3rem;
            }

            .bn36 {
                border-color: #fff;
                transition: transform 0.2s cubic-bezier(0.235, 0, 0.05, 0.95);
            }

            .bn36:hover {
                transform: perspective(1px) scale3d(1.044, 1.044, 1) translateZ(0) !important;
            }

            .popup-container {
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background-color: rgba(0, 0, 0, 0.5);
                display: flex;
                justify-content: center;
                align-items: center;
                z-index: 9999;
            }

            .popup-content {
                background-color: #fff;
                padding: 20px;
                max-width: 400px;
                text-align: center;
                position: relative;
            }

            .popup-content img {
                max-width: 100%;
                height: auto;
            }

            .popup-content p {
                margin-top: 20px;
                font-size: 1.2rem;
                font-weight: bold;
            }

            .close-btn {
                position: absolute;
                top: 10px;
                right: 10px;
                background-color: transparent;
                border: none;
                cursor: pointer;
            }
        </style>

</html>
