
{{-- @section('content') --}}
<header>
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
</header>
    <div class="container">
        <h2 style="text-align: center">Shared Contact</h2>
        <br>
        @if(!Session::has('alert') && $contacts) 
    <table border="1" class="table table-bordered" id="export_data">
        <thead>
            <tr>
                <th>Id</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Address</th>
                <th>Nickname</th>
                <th>Company</th>
                <th>Status</th>
            </tr>
    
        </thead>
        <tbody>
        <tr>
            <td>{{$contacts['id']}}</td>
            <td>{{$contacts['firstname']}}</td>
            <td>{{$contacts['lastname']}}</td>
            <td>{{$contacts['email']}}</td>
            <td>{{$contacts['phone']}}</td>
            <td>{{$contacts['address']}}</td>
            <td>{{$contacts['nickname']}}</td>
            <td>{{$contacts['company']}}</td>
            @if($contacts['status']==1)
            <td>Active</td>
            @else 
            <td>Inactive</td>
            @endif       
        </tr> 
    </tbody>
    </table>
    @endif
    <script>
        @if(Session::has('alert'))
            alert({{ session()->get('alert') }});
        @endif
    </script>
</div>

{{-- @endsection --}}