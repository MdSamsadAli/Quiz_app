<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="../assets/css/style.css">

</head>
<body>

    <div class="container mt-5">
        <a href="<?php base_url() ?>/midas/quiz_app">Restart Game</a>

        <div class="d-flex justify-content-center row ">
            <!-- <div class="slider"> -->
            <?php 
            // foreach($data as $row) {
                ?>
                <div class="col-md-12 col-lg-12">
                    <div class="border">
                        <div class="question bg-white p-3 border-bottom">
                            <div class="d-flex flex-row justify-content-between align-items-center mcq">
                                <h4>Quiz Game</h4>
                                
                                <h1>Time : <span id="countdown"></span></h1>
                                
                            </div>
                        </div>
                        <div class="question bg-white p-3 border-bottom">
                            <div class="d-flex flex-row align-items-center question-title">
                                <h3 class="text-danger"  value="" >
                                    <span id="increment"></span> / 3.
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
                            <button class="btn btn-primary d-flex align-items-center btn-danger prev" type="button" id="prev"><i class="fa fa-angle-left mt-1 mr-1"></i>&nbsp;previous</button>
                            <button class="btn btn-primary border-success align-items-center btn-success next" type="button" id="next">Next<i class="fa fa-angle-right ml-2"></i></button>
                        </div>
                    </div>
                </div>
            <?php 
            // } 
            ?>
            </div>
        <!-- </div> -->
    </div>
<!-- </div> -->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
	<script type="text/javascript" src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>



</body>
</html>


