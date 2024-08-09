<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css" crossorigin="anonymous">


    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js"></script>

</head>
<style>
    @media (max-width: 1400px) {
        .table-width {
            overflow-x: scroll;
        }
    }

</style>
<body>
    @php

    use App\Models\Community;
    $communities = Community::with('user')->get();
    @endphp
    <div class="row m-auto d-flex justify-content-center">

        <div class="col-md-10 mb-3">
			<div class = "d-flex justify-content-between align-items-center">
            <h1 class="mt-3">Community Details</h1>
			<a href = "{{route('logout')}}" class = "btn btn-success" >Logout </a>
			</div>
            <div class="card-body" style="overflow-x:auto">
                <table id="example" class="table table-striped table-bordered " style="width:100%">
                    <thead>
                        <tr>
                            <th>Discord ID</th>
                            <th>Discord Name</th>
                            <th>steam_ID64</th>
                            <th>discord_username</th>
                            <th>First Name</th>
                            <th>age</th>
                            <th>Play Game</th>
                            <th>Fun Facts</th>
                            <th>How to Find</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach($communities as $index => $data)
                        <tr>
                            <td>{{$data->discord_id}}</td>
						 <td> <img src="{{$data->getavatar($data->user->id,$data->user->avatar)}}" class="img-fluid  mb-2" alt="black sample"  style="width: 150px; height: 200px; border: 1px solid black;"/></td>
                            <td>{{$data->user->username}}</td>
 							<td>{{$data->steam_ID64}}</td>
                            <td>{{$data->discord_username}}</td>
                            <td>{{$data->first_name}}</td>
                            <td>{{$data->age}}</td>
                            <td>{{$data->play_game }}</td>
                            <td>{{$data->fun_facts}}</td>
                            <td>{{$data->how_to_find}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

</body>
<script>
    $(document).ready(function() {
        $('#example').DataTable({
            responsive: true
        });
    });

</script>
</html>
