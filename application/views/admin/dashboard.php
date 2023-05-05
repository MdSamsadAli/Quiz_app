<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">

</head>
<body>


<!-- Section: Design Block -->
<section class="vh-100">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center h-100">
      <div class="col-12">
          <h3 class="mb-5 text-center text-danger">Welcome to Dashboard</h3>
        <div class="shadow-2-strong" style="border-radius: 1rem;">
          <div class="">
              <div class="">
                  <!-- <button class="btn btn-primary btn-lg btn-block form-control" type="submit">Start Quiz</button> -->
                  <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">SNo.</th>
                            <th scope="col">quiz_played_id</th>
                            <th scope="col">Username</th>
                            <th scope="col">Total Questions</th>
                            <th scope="col">Attempted Questions</th>
                            <th scope="col">Score</th>
                            <th scope="col">Time Taken in Sec</th>
                            <th scope="col">action</th>
                        </tr>
                    </thead>
                    <tbody id="info">
                        <tr>
                            
                        </tr>
                    </tbody>
                </table>
              </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- Section: Design Block -->

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <div id="username">

        </div>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table class="table table-striped">
          <thead>
            <tr>
              <th scope="col">Sno.</th>
              <th scope="col">Quiz_played_id</th>
              <th scope="col">Questions</th>
              <th scope="col">Correct Answer</th>
              <th scope="col">Selected Answer</th>
              <th scope="col">Time Taken</th>
            </tr>
          </thead>
          <tbody id="preview">
            <tr>
             
            </tr>
          </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>




<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script type="text/javascript" src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>

</body>
</html>


<script>


$(document).ready(function(){

  
  fetch();
  get_preview();

      function fetch(){
        $.ajax({
          url: "<?php echo base_url() ?>admin/admin/getAll",
          type: "POST",
          dataType: "json",
          success: function (data) {
            // console.log(data);

            var tbody ="";
            var id = 1;
            for(var key in data) {
              tbody += "<tr>";
              tbody += "<td>" + id++; + "</td>";
              tbody += "<td>" + data[key]['id'] + "</td>";
              tbody += "<td>" + data[key]['username'] + "</td>";
              tbody += "<td>" + data[key]['total_questions'] + "</td>";
              tbody += "<td>" + data[key]['attempted_questions'] + "</td>";
              tbody += "<td>" + data[key]['correct_questions'] + "</td>";
              tbody += "<td>" + data[key]['time_taken']  + "</td>";

              tbody += `<td>
                            <a href="#" data-toggle="modal" data-target="#exampleModal" class="btn btn-danger btn-sm" value="${data[key]['username']}" >View</a>
                        </td>`
            }
            $("#info").html(tbody);
          },
        });
      }
      

      // function prev_id(id){
      //   $("#exampleModal").modal("show");
      //   get_preview(id);
      // }


      // function get_preview()
      // {
      //   $.ajax({
      //     url: "<?php echo base_url(); ?>admin/admin/getPreview",
      //     dataType: "json",
      //     type: "POST",
      //     success: function (data)
      //     {
      //       console.log(data);
      //       var tbody ="";
      //       var id = 1;
      //       for(var key in data) {
      //         tbody += "<tr>";
      //         tbody += "<td>" + id++; + "</td>";
      //         // tbody += "<td>" + data[key]['quiz_played_id'] + "</td>";
      //         tbody += "<td>" + data[key]['question_id'] + "</td>";
      //         tbody += "<td>" + data[key]['correct_answer'] + "</td>";
      //         tbody += "<td>" + data[key]['selected_answer'] + "</td>";
      //         tbody += "<td>" + data[key]['timer']  + "</td>";
      //         tbody += "</tr>";


      //       }
      //       $("#info").html(tbody);
      //     } 
      //   });
      // }

      function get_preview(){
        $.ajax({
          url: "<?php echo base_url() ?>admin/admin/getPreview",
          type: "GET",
          dataType: "json",
          // data: {id},
          success: function (data) {
            console.log(data);

            var tbody ="";
            var div ="";
            var id = 1;
            
            div += "<h1>" +data[0]['username'] + "</h1>";
            $("#username").html(div);

            for(var key=0;key<10;key++) {
              tbody += "<tr>";
              tbody += "<td>" + id++; + "</td>";
              tbody += "<td>" + data[key]['quiz_played_id'] + "</td>";
              tbody += "<td>" + data[key]['questions'] + "</td>";
              tbody += "<td>" + data[key]['correct_answer'] + "</td>";
              tbody += "<td>" + data[key]['selected_answer'] + "</td>";
              tbody += "<td>" + data[key]['timer']  + "</td>";
            }
            $("#preview").html(tbody);
          },
        });
      }

    });

</script>