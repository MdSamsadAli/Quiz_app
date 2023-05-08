<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    
    <!-- DataTables CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.css">

    <!-- Additional CSS files for DataTables plugins or extensions (if applicable) -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.7.0/css/buttons.dataTables.min.css">



</head>
<body>


<!-- Section: Design Block -->
<section>
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center h-100">
      <div class="col-12">
          <h3 class="text-center text-uppercase">USer Details</h3>
        <div class="shadow-2-strong" style="border-radius: 1rem;">
          <div class="">
              <div class="">
                <a href="<?php base_url() ?>admin/admin/logout" class="btn btn-primary btn-block" type="submit">Logout</a>
                <table id="user_data" class="table table-bordered table-striped">
                    <thead>
                        <tr class="bg-white">
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
<div class="modal fade" data-backdrop="static" data-keyboard="false" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl " role="document">
    <div class="modal-content img-modal">
      <div class="modal-header">
        <div id="username">
        </div>
        <button type="button" class="btn btn-close" data-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <table class="table table-striped">
          <thead>
            <tr>
              <th scope="col">Sno.</th>
              <th scope="col">Questions</th>
              <th scope="col">Correct Answer</th>
              <th scope="col">Selected Answer</th>
              <th scope="col">Time Left</th>
            </tr>
          </thead>
          <tbody id="preview">
            <tr>
             
            </tr>
          </tbody>
        </table>
      </div>
      
    </div>
  </div>
</div>




<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script type="text/javascript" src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>

<!-- datatable for pagination  -->
<script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>  
<script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>            

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
              tbody += "<td>" + id++ + "</td>";
              tbody += "<td>" + data[key]['id'] + "</td>";
              tbody += "<td>" + data[key]['username'] + "</td>";
              tbody += "<td>" + data[key]['total_questions'] + "</td>";
              tbody += "<td>" + data[key]['attempted_questions'] + "</td>";
              tbody += "<td>" + data[key]['correct_questions'] + "</td>";
              tbody += "<td>" + data[key]['time_taken']  + "</td>";

              tbody += `<td>
                            <a href="#" class="btn btn-danger btn-sm btn-view" data-id="${data[key]['id']}" data-toggle="modal" data-target="#exampleModal">View</a>
                        </td>`
            }
            $("#info").html(tbody);

            $('#user_data').DataTable({
              "paging": true,
              "pageLength": 10 // set the number of rows per page
            });
          },
        });
      }
      
      $(document).on('click', '.btn-view', function() {
          var id = $(this).data('id');
          get_preview(id);
      });
      
      function get_preview(id){

        $.ajax({
          url: "<?php echo base_url() ?>admin/admin/getPreview",
          type: "POST",
          dataType: "json",
          data: {id},
          success: function (response) {
            console.log(response);

            // $("#username").val(response.username);

            var tbody ="";
            var div ="";
            var id = 1;

            div += "<h1>" + response['username'] + "</h1>";
            $("#username").html(div);

            for (var i = 0; i < 10; i++) {
              tbody += "<tr>";
              tbody += "<td>" + (i+1) + "</td>";
              // tbody += "<td>" + response['quiz_played_id'][i] + "</td>";
              tbody += "<td>" + response['questions'][i] + "</td>";
              tbody += "<td>" + response['correct_answer'][i]  + "</td>";
              tbody += "<td>" + response['selected_answer'][i]  + "</td>";
              tbody += "<td>" + response['timer'][i]  + "</td>";
              tbody += "</tr>";

              console.log(response['correct_answer'][i]);
            }

            $("#preview").html(tbody);
          },
        });
      }

    });

</script>