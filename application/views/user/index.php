<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="assets/css/style.css">
</head>
<body>
    <div class="container mt-5" id="quiz_form">
        <div class="d-flex justify-content-between">
            <h4 class="text-uppercase text-white">Username: <?php echo $this->session->userdata('username'); ?></h4>
            <a href="" class="btn btn-outline-light img mb-2" id="end_game">Restart Game</a>
        </div>
        <div class="d-flex justify-content-center row ">
            <div class="col-md-12 col-lg-12" id="preview_form">
                <div class="border border-radius img">
                    <div class="question  p-3 border-bottom">
                        <div class="d-flex flex-row justify-content-between align-items-center mcq">
                            <h4 id="rename" class="text-white">Quiz Game</h4>
                            
                            <h1 class="text-white"><span id="countdown"></span></h1>
                            
                        </div>
                    </div>
                    <div class="question  p-3 border-bottom">
                        <div class="d-flex flex-row align-items-center question-title">
                            <h3 class="text-white">
                                <span id="increment"></span> / 10.
                            </h3>
                            <h5 class="mt-1 ml-2 text-white" id="question">
                            </h5>
                        </div>
                        <div class="ans ml-2">
                            <label class="radio">
                                <input type="radio" name="option" value="" id="option-1">
                                <span id="option1">
                                </span>
                            </label>    
                        </div>
                        <div class="ans ml-2">
                            <label class="radio">
                                <!-- <button id="selectedopt"> -->
                                <input type="radio" name="option" value="" id="option-2">

                                <span id="option2">

                                </span>
                                <!-- </button> -->
                            </label>    
                        </div>
                        <div class="ans ml-2">
                            <label class="radio">
                                <!-- <button id="selectedopt"> -->
                                <input type="radio" name="option" value="" id="option-3">

                                <span id="option3">

                                </span>
                                <!-- </button> -->
                            </label>    
                        </div>
                        <div class="ans ml-2">
                            <label class="radio">
                                <!-- <button id="selectedopt"> -->
                                <input type="radio" name="option" value="" id="option-4">

                                <span id="option4">
                                </span>
                                <!-- </button> -->
                            </label>    
                        </div>
                    </div>
                    <div class="d-flex flex-row justify-content-between align-items-center p-3 ">
                        <button class="btn btn-primary align-items-center btn-danger prev" type="button" id="prev"><i class="fa fa-angle-left mt-1 mr-1"></i>&nbsp;previous</button>
                        <button class="btn btn-primary border-success align-items-center btn-success next" type="button" id="next">Next<i class="fa fa-angle-right ml-2"></i></button>
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" id="show">
                            Show
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
	<script type="text/javascript" src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <!-- Modal -->
    <div class="modal fade" data-backdrop="static" data-keyboard="false" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content img-modal">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Quiz Result</h5>
            </div>
            <div class="modal-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">SNo.</th>
                            <th scope="col">Username</th>
                            <th scope="col">Total Questions</th>
                            <th scope="col">Attempted Questions</th>
                            <th scope="col">Score</th>
                            <th scope="col">Time Taken in Sec</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr id="info">
                            
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="submit">Preview</button>
            </div>
        </div>
    </div>
    </div>
    <script>
        var quiz_id = 1;
        var total_quiz = 10;
        var total_questions = 10;
        var quesAvailable = new Array(total_questions).fill(0);
        var answers_selected = Array(10);
        var attempted_questions = new Array();
        var timer_array = new Array(total_questions).fill(15);
        var time;
        var intervalID;
        var index = 0;
        var correct_questions = 0;
        var correct_answer = new Array(total_questions).fill(0);
        var attempted_questions = 0;
        var count = 0;
        var blank = 0;
        var time_taken;

        var questions = new Array(total_questions).fill(0);
        for (var i = 0; i < total_questions; i++)
        {
            questions[i] = i+1;
        }
        // console.log(questions);
        var is_preview = false;
        if(quesAvailable == 0)
        {
            fetch();
        }
        else {
            JSON.parse(localStorage.getItem('item' + quiz_id));
        }
        $(document).ready(function(){
            fetch();
        });
        function fetch()
        {
            $.ajax({
                url: "<?php base_url() ?>user/getAll",
                type: "POST",
                dataType: "json",
                data: {id: quiz_id},
                success: function(response){
                    // console.log(response);
                    correct_answer[quiz_id-1] = response.answer;
                    localStorage.setItem('item' + quiz_id, JSON.stringify(response));
                    if(!is_preview) 
                    {
                        timer();
                    }
                    const obj = JSON.parse(localStorage.getItem('item' + quiz_id));
                    if(quiz_id == 1){
                        // console.log(quiz_id);
                        $("#prev").hide();
                        $("#show").hide();
                    }
                    else if(quiz_id > 1)
                    {
                        $("#prev").show();
                    }

                    $("#increment").html(index+1);

                    $("#question").html(obj.question);

                    $("#option1").html(obj.option[0]);
                    $("#option2").html(obj.option[1]);
                    $("#option3").html(obj.option[2]);
                    $("#option4").html(obj.option[3]);
                }
            });
        }
        $(document).on("click", "#show", function(e) {
            e.preventDefault();
            show();
        });
        $(document).on("click", "#next", function(e) {
            e.preventDefault();
            // console.log(answers_selected);

            save_clicked();
            // incr();
            timer_array[quiz_id-1] = time;
            clearInterval(intervalID);

            // $("#prev").hide();
            // console.log(quiz_id);


            
            if(quiz_id > total_quiz-1){
            // alert("Quiz result");
                if(!is_preview) 
                {
                    quiz_result();
                    $("#next").hide();
                    $("#show").click();
                }
                
                return;
            }
            quiz_id++;
            // console.log(id);
            // timer();
            if (quesAvailable[quiz_id-1] == 0){
                // alert();
                index++;
                fetch();
            }
            load_previous();
        });
        $(document).on("click", "#prev", function(e) {
            e.preventDefault();
            console.log(calculate_time());
            // $("#next").show();
            // $("#show").hide();


            timer_array[quiz_id-1] = time;
            clearInterval(intervalID);
            // console.log(answers_selected);
            if(!is_preview){

                save_clicked();
            }
            // timer();

            if(quiz_id == 1){
                // $('#prev').hide();
                return;
            }
            
            quiz_id--;
            // save_clicked();
            index--;
            if(!is_preview) 
            {
                timer();
            }
            load_previous();
        });

        function save_clicked(){
            if(!is_preview){
                var selectedValue;
                var selectedOption = $("input[name='option']:checked");
                if (selectedOption.length > 0) {
                    selectedValue = selectedOption.siblings('span').text();
                } 
                // alert(selectedValue);
                // console.log(selectedValue);
                answers_selected[quiz_id-1] = selectedValue;
                // console.log(answers_selected);
                selectedOption.prop("checked", false);
                // console.log(answers_selected);
                return;
            }
        }

        function load_previous(){
                        
            if(quiz_id == 1){
                // console.log(quiz_id);
                $("#prev").hide();
                $("#show").hide();
            }    
            if(is_preview)
            {
                time = timer_array[quiz_id-1];
                $("#countdown").html(time);
            }
            const obj = JSON.parse(localStorage.getItem("item" +quiz_id));
            
            $("#increment").html(index+1);

            $("#question").html(obj.question);

            $("#option1").html(obj.option[0]);
            $("#option2").html(obj.option[1]);
            $("#option3").html(obj.option[2]);
            $("#option4").html(obj.option[3]);

            if(!is_preview){
                $('input[name="option"]').each(function(index) {
                    if ($(this).siblings('span').text() == answers_selected[quiz_id-1]) {
                        // console.log(answers_selected[quiz_id-1]);
                        $('#option-' + (index+1)).prop('checked', true);
                    }
                });
            }
            else{
                highlightAnswers();
            }
        }
        function quiz_result() {
            for (let i = 0; i < total_quiz; i++){
                const obj = JSON.parse(localStorage.getItem("item"+(i+1)));
                // console.log(obj);
                if(obj.answer == answers_selected[i]){
                    correct_questions++;
                    // console.log(obj.answer);
                    count++;
                }
                else if(typeof answers_selected[i] == "undefined"){
                    blank++;
                }
            }
            attempted_questions = total_quiz - blank;
            time_taken = calculate_time();
            // console.log (correct_questions, attempted_questions, total_quiz);
        }
        function show()
        {
            var localData = 
            "<td>" +<?php echo $id=1; ?>+ "</td>"+
            "<td>" +"<?php echo $username; ?>"+ "</td>"+
            "<td>" +total_quiz+ "</td>"+
            "<td>" +attempted_questions+ "</td>"+
            "<td>" +correct_questions+ "</td>"+
            "<td>" +"<?php echo $timer_array; ?>"+ "</td>"
            $("#info").append(localData);
        }
        $(document).on("click", "#submit", function(e) {
            e.preventDefault();
            $.ajax({
                url: "<?php echo site_url('user/save'); ?>",
                type: "POST",
                data: {
                    username:'<?php echo $username ?>',
                    total_quiz:total_quiz,
                    attempted_questions:attempted_questions,
                    correct_questions:correct_questions,
                    timer_array:time_taken,
                    
                    questions,
                    answers_selected,
                    correct_answer,
                    timer_array,
                },
                success: function(response) {
                    // console.log(response);
                    preveiw();
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        });
        function timer() {
            time = timer_array[quiz_id-1];
            // console.log(timer_array);
            if (time > 0) {
                $('input[name="option"]').each(function() {
                    $(this).prop('disabled', false);
                });
                intervalID = setInterval(() => {
                    time--;
                    
                    $("#countdown").html(time);

                    if (time <= 0) {
                        timer_array[quiz_id-1] = time;
                        // console.log(timer_array);
                        clearInterval(intervalID);
                        $("#next").click();
                    }
                }, 1000);
            }
            else if(time == 0){ 
                var selected = answers_selected[quiz_id-1];
                // console.log(time > 0);
                $("#countdown").html(time);
                clearInterval(intervalID);
                $('input[name="option"]').each(function() {
                    if($(this).siblings('span').text() != selected) {
                        $(this).prop('disabled', true);
                    }
                });
                console.log(time);
            }
            else{
                $('#next').click(function() {
                timer_array[quiz_id-1] = time;
                // console.log(timer_array);
                clearInterval(intervalID);
                });
                $('#prev').click(function() {
                    timer_array[quiz_id] = time;
                    // console.log(timer_array);
                    clearInterval(intervalID);
                    return;
                });
            }
        }

        function calculate_time() {
            // Get the start time as a Unix timestamp in milliseconds
            var start_time_str = "<?php echo $this->session->userdata('timer_array'); ?>";

            var start_time = new Date(start_time_str).getTime() / 1000;
            // alert(start_time);
            
            // Get the current time as a Unix timestamp in milliseconds
            var current_time = new Date().getTime() / 1000;
            // alert(current_time);
            
            // Calculate the difference between the current time and the start time in seconds
            var elapsed_time = Math.floor((current_time - start_time));


            // alert(elapsed_time);

            var hours = Math.floor(elapsed_time / 3600);
            var minutes = Math.floor((elapsed_time - hours * 3600) / 60);
            var seconds = Math.floor(elapsed_time - hours * 3600 - minutes * 60);

            // Format the countdown timer as hh:mm:ss
            var countdown = seconds.toString().padStart(0, "0");
                            // alert(countdown);
            return countdown;
        }
        function preveiw()
        {
            is_preview = true;
            $("#exampleModal").modal('hide');
            $("#next").show();
            $("#quiz_form").show();
            $("#rename").html("Preview");
            $("#end_game").html("End Game");
            load_previous();
        }
        function highlightAnswers() {
            $("input[type=radio]").next('span').removeClass('correct incorrect');
            // console.log("correct: "+ correct_answer);
            var selected = answers_selected[quiz_id-1];
            var correct = correct_answer[quiz_id-1];
            // console.log(correct);
            console.log("correct: "+ correct + " selected: "+ selected);
            if (selected == correct) {
                $('span:contains("' + selected + '")').addClass('correct');

                $('input[name="option"]').each(function() {
                    if($(this).siblings('span').text() != selected) {
                        $(this).prop('disabled', true);
                    }
                });
            }
            else {
                $('span:contains("' + correct + '")').addClass('correct');
                $('span:contains("' + selected + '")').addClass('incorrect');

                $('input[name="option"]').each(function() {
                    if($(this).siblings('span').text() != selected) {
                        $(this).prop('disabled', true);
                    }
                });
            }
        }
    </script>
</body>
</html>