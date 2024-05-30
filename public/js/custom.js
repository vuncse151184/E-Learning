var current_q = 0;
var time = 100;
var marks = 0;
var timer;
var last_q = 0;
let json = @json($questions);
let question_list = json
var answers = new Array(question_list.length)


$(document).ready(function() {
    console.log(last_q)
    $('#main').hide()
    $('#result').hide()
    $('#numberOfQuestion').hide()
    $('#timing').hide()
    $('#finish').hide()
    last_q = question_list.length
   
})


function show_question() {
    $('#number').text(current_q+1)
    $('[id*=question_wrapper_]').map((idx, el) => {
        $(el).hide()
    })
    $('#question_wrapper_' + current_q).show()
}

function add_quest() {
    console.log(question_list)
    $('.last_q').text(question_list.length)
    question_list.map((el, i) => {

        $('#main').append(`
                    <div id="question_wrapper_${i}" style="display:none">
                        <h2>${el.description}</h2>
                        ${add_option(el,i)} 
                    </div> 
            `)
    })
    // $('#questions').text(data[index].description)
    // $('#option1').text(data[index].options[0])
    // $('#option2').text(data[index].options[1])
    // $('#option3').text(data[index].options[2])
    // $('#option4').text(data[index].options[3])
    // $('#number').text(Number(index + 1))
    
}


function start() {
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
            create_Result(question_list)
            $('#finish').hide()
            $('#main').hide()
            $('#result').show()
        }
        time--;
    }


}



$('#finish').click(function() {
    console.log("finish button clicked")
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
            create_Result(question_list)
            Swal.fire(
                'Submitted!',
                'Your answer has been submitted.',
                'success'
            )
            $(this).hide()
        }
    })

})

function next() {
    current_q++
    //console.log("answer_array: " + answer)
    $('#main').show()
    show_question()
    if (current_q >= question_list.length - 1) {
        current_q = 0
    }
}


function previous() {
    current_q--
    if (current_q < 0) {
        current_q == question_list.length
    }
    $('#main').show()
    show_question()
}

function add_option(el, i) {
    let a = ""
    for (let index = 1; index <= 4; index++) {
        a += `
                    <div class="mr-3">
                        <input type="radio" name="option_${i}" value="${el.options[index-1]}" id="option_${index}_${i}" 
                            onclick="selectAns('option_${index}_${i}')">
                        <label for="option_${index}_${i}" >  ${el.options[index-1]}  </label>
                    </div>
                  `
    }
    return a
}


function create_Result(data) {
    for (var i = 0; i < answers.length; i++) {
        marks += 5;
    }
    // $('.last_q').text(last_q)
    // $('#main').hide()
    // $('#correct-answer').text(marks / 5)
    // $('#percentage').text((marks / 25) * 100 + "%")
    // $('#result').show()
    // $('#options').hide()

}

function selectAns(eds) {
    let a = document.getElementById(eds)
    if ($('[id*=question_wrapper_]:checked')) {
        answers[current_q] = $('#' + eds).val()
    }
    console.log(answers)
}

$(".options").click(function() {
    $(this).addClass("active");
    $(this).siblings().removeClass("active")

    answers.push($(this).html());
})