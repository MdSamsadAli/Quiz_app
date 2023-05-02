<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="assets/css/style.css">

    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.min.css" integrity="sha512-17EgCFERpgZKcm0j0fEq1YCJuyAWdz9KUtv1EjVuaOz8pDnh/0nZxmU6BBXwaaxqoi9PQXnRWqlcDB027hgv9A==" crossorigin="anonymous" referrerpolicy="no-referrer" /> -->

	<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.css" integrity="sha512-yHknP1/AwR+yx26cB1y0cjvQUMvEa2PFzt1c9LlS4pRQ5NOTZFWbhBig+X9G9eYW/8m0/4OXNx8pxJ6z57x0dw==" crossorigin="anonymous" referrerpolicy="no-referrer" /> -->

</head>
<body>

    <div class="container mt-5" id="quiz_form">
        <div class="d-flex justify-content-between">
            <h4>Username: <?php echo $this->session->userdata('username'); ?></h4>
            <a href="" class="btn btn-primary">Restart Game</a>
        </div>
        <div class="d-flex justify-content-center row ">
           
            <div class="col-md-12 col-lg-12" id="preview_form">
                <div class="border">
                    <div class="question bg-white p-3 border-bottom">
                        <div class="d-flex flex-row justify-content-between align-items-center mcq">
                            <h4>Quiz Game</h4>
                            
                            <h1><span id="countdown"></span></h1>
                            
                        </div>
                    </div>
                    <div class="question bg-white p-3 border-bottom">
                        <div class="d-flex flex-row align-items-center question-title">
                            <h3 class="text-danger"  value="" >
                                <span id="increment"></span> / 10.
                            </h3>
                            <h5 class="mt-1 ml-2" id="question">
                            </h5>
                        </div>
                        <div class="ans ml-2">
                            <label class="radio">
                                <!-- <button id="selectedopt"> -->
                                <input type="radio" name="option" value="" id="option-1">
                                    <span id="option1">
                                    </span>
                                <!-- </button> -->
                                
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
                    <div class="d-flex flex-row justify-content-between align-items-center p-3 bg-white">
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
<!-- </div> -->

    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
	<script type="text/javascript" src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
	<!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js"></script>
    <script>
        $(document).ready(function(){
			$('.slider').slick({
				arrows : false,
				infinite: false,
			});
			$('.prev').click(function(e){ 
		      	e.preventDefault(); 
				$('.slider').slick('slickPrev');
			} );
			
			$('.next').click(function(e){
				e.preventDefault(); 
				$('.slider').slick('slickNext');
			} );  
		});
	</script> -->


<!-- Modal -->
<div class="modal fade" data-backdrop="static" data-keyboard="false" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <!-- <form action="<?php base_url() ?>user/save" method="post"> -->
    <div class="modal-content">
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
            <button type="button" class="btn btn-primary" id="submit">Save</button>
        </div>
    </div>
    <!-- </form> -->
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
            var attempted_questions = 0;
            var count = 0;
            var blank = 0;


            var is_preview = false;

            
            // $("#increment").html(id);
            
            if(quesAvailable == 0)
            {
                fetch();
            }
            else {
                JSON.parse(localStorage.getItem('item' + quiz_id));
            }
            
            $(document).ready(function(){
                fetch();
                // submit();
            });

            function fetch()
            {
                $.ajax({
                    url: "<?php base_url() ?>user/getAll",
                    type: "POST",
                    dataType: "json",
                    data: {id: quiz_id},
                    success: function(response){

                        localStorage.setItem('item' + quiz_id, JSON.stringify(response));
                        timer();
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
                console.log(answers_selected);

                save_clicked();
                // incr();
                timer_array[quiz_id-1] = time;
                clearInterval(intervalID);

                // $("#prev").hide();
                console.log(quiz_id);


                
                if(quiz_id > total_quiz-1){
                // alert("Quiz result");
                    quiz_result();
                    $("#next").hide();
                    $("#show").click();

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
                // if(!is_preview) 
                // {
                //     timer();
                // }
                load_previous();
            });


            $(document).on("click", "#prev", function(e) {
                e.preventDefault();
                // $("#next").show();
                // $("#show").hide();


                timer_array[quiz_id-1] = time;
                clearInterval(intervalID);
                console.log(answers_selected);
                save_clicked();
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
                var selectedValue;
                var selectedOption = $("input[name='option']:checked");
                if (selectedOption.length > 0) {
                selectedValue = selectedOption.siblings('span').text();
                } 
                // alert(selectedValue);
                console.log(selectedValue);
                answers_selected[quiz_id-1] = selectedValue;
                // console.log(answers_selected);
                selectedOption.prop("checked", false);
                console.log(answers_selected);
                return;
            }

            // $('#prev').css("display", "none !important");
            // $('#prev').addClass("d-none");


            function load_previous(){
                // $("#prev").hide();
                // $('#prev').addClass("d-none");


                // $('#quiz_form')[0].reset();

                // timer();
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


                $('input[name="option"]').each(function(index) {
                if ($(this).siblings('span').text() == answers_selected[quiz_id-1]) {
                    // console.log(answers_selected[quiz_id-1]);
                    $('#option-' + (index+1)).prop('checked', true);
                }
                });
            }


            function quiz_result() {
                
                
                for (let i = 0; i < total_quiz; i++){
                    const obj = JSON.parse(localStorage.getItem("item"+(i+1)));
                    console.log(obj);

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
                console.log (correct_questions, attempted_questions, total_quiz);
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
                        timer_array:<?php echo $timer_array; ?>,
                    },
                    success: function(response) {
                        console.log(response);

                        // window.location.href="<?php base_url()?>user/preview";
                        preveiw();
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            });


           
            function timer() {
                time = timer_array[quiz_id-1];

                console.log(timer_array);

                // let intervalID;
                if (time > 0) {
                    intervalID = setInterval(() => {
                        time--;
                        
                        $("#countdown").html(time);

                        if (time <= 0) {
                            timer_array[quiz_id-1] = time;
                            // console.log(timer_array);
                            clearInterval(intervalID);
                            // document.getElementById('next').click();
                            $("#next").click();
                            // $("#prev").hide();
                            // document.getElementById('next').dispatchEvent(new Event('click'));
                        }

                    }, 1000);
                }
                else if(time >= 0){ 
                    // console.log(time > 0);
                    clearInterval(intervalID);
                    // document.getElementById('next').click();
                    $("#next").click();
                }
                else{
                    $('#next').click(function() {
                    timer_array[quiz_id-1] = time;
                    // console.log(timer_array);
                    clearInterval(intervalID);
                    });

                    $('#prev').click(function() {
                        timer_array[quiz_id] = time;
                        console.log(timer_array);
                        clearInterval(intervalID);
                        return;
                    });
                }
            }


            function preveiw()
            {
                is_preview = true;

                alert();
                
                $("#exampleModal").modal('hide'); 
                // $("#quiz_form")[0].reset();
                // $("#quiz_form").show();

                // quiz_id = 1;
                $("#next").show();
                $("#quiz_form").show();
                // $('#quiz_form')[0].reset();

                load_previous();
            
                // highlightAnswers();
            }

            // function highlightAnswers() {
            //     var selected = answers_selected[quiz_id-1];
            //     var correct = actual_answers[quiz_id-1];

            //     if (selected == correct) {
            //         $('input[type=radio]:checked').next('span').addClass('correct');
            //     } else if (selected != correct) {
            //         $('input[type=radio]:checked').next('span').addClass('incorrect');
            //         $('input[id=option-' + correct + ']').next('span').addClass('correct');
            //     }
            // }
    </script>
	

</body>
</html>


