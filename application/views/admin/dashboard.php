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
                            <th scope="col">Username</th>
                            <th scope="col">Total Questions</th>
                            <th scope="col">Attempted Questions</th>
                            <th scope="col">Score</th>
                            <th scope="col">Time Taken in Sec</th>
                            <th scope="col">action</th>
                        </tr>
                    </thead>
                    <tbody id="info">
                        <tr >
                            
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


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script type="text/javascript" src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>

</body>
</html>


<script>


$(document).ready(function(){
  fetch();

      function fetch(){
        $.ajax({
          url: "<?php echo base_url() ?>admin/admin/getAll",
          type: "POST",
          dataType: "json",
          success: function (data) {
            console.log(data);

            var tbody ="";
            var id = 1;
            for(var key in data) {
              tbody += "<tr>";
              tbody += "<td>" + id++; + "</td>";
              tbody += "<td>" + data[key]['username'] + "</td>";
              tbody += "<td>" + data[key]['total_questions'] + "</td>";
              tbody += "<td>" + data[key]['attempted_questions'] + "</td>";
              tbody += "<td>" + data[key]['correct_questions'] + "</td>";
              tbody += "<td>" + 1  + "</td>";

              tbody += `<td>
                            <a href="#" id="delete" class="btn btn-danger btn-sm" value="${data[key]['id']}">Delete</a>
                        </td>`
              tbody += "</tr>";
            }
            $("#info").html(tbody);
          },
        });
      }

    });

</script>