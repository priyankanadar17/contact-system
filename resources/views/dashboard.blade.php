@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Contact List</h1>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <br>
    <a href="logout" class = "btn btn-primary">Logout</a>
    <br><br>
    
    {{-- Search --}}

    <form action="{{ route('dashboard') }}" method="get">
        {{-- <label for="search">Search</label> --}}
        <input type="search" id="id" class="form-control" name="search" placeholder="Search on the basis of firstname, lastname, email or phone"><br>
        <button class="btn btn-primary" style="background-color:#0d6efd"> Reset Search </button>
        </form>
      <br><br>    
      <table border="1" class="table table-bordered" id = "export_data">
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
                <th>Update</th>
                <th>Send</th>
                </td>
                
            </tr>
        </thead>
        <tbody>
        @php
        $count=0;
        @endphp
        @foreach($contacts as $contact)
        @php
        $count++;
        @endphp
        <tr>
            <td>{{$count}}</td>
            <td>{{$contact['firstname']}}</td>
            <td>{{$contact['lastname']}}</td>
            <td>{{$contact['email']}}</td>
            <td>{{$contact['phone']}}</td>
            <td>{{$contact['address']}}</td>
            <td>{{$contact['nickname']}}</td>
            <td>{{$contact['company']}}</td>
            @if($contact['status']==1)
            <td>Active</td>
            @else 
            <td>Inactive</td>
            @endif
            <td><a href="{{url('update/'. $contact['id'])}}">Edit</a>
                {{-- data-bs-target="#exampleModal1" class="edit" data-bs-toggle="modal" data-id="{{$contact['id']}}"--}}
            </td>        
            
            <td>
                {{-- <a  class="share {{$contact['status']}}" href="{{$contact['status'] ? '#' : {{ url('share/'. $contact['key'])}} }}">Share</a> --}}
                @if(!$contact['status'])
                <a class="share " href="#" style="visibility: hidden" >Share</a>
            @else
                <a class="share" href="{{ url('share/'. $contact['key'])}}">Share</a>
            @endif
            </td>        
        </tr> 
        @endforeach
    </tbody>
    </table>
        {{-- <script>
            $(document).ready(function(){
              $(".edit").click(function(){
                let id  = $(this).data('id');
                $.ajax({
                    url: `{{ url('dashboard/${id}') }}`,
                    type:  'get',
                    success: function(response) {

                        // console.log(response);
                        $("#contact_id").val(response.id);
                        $("#firstname1").val(response.firstname)
                        $("#lastname1").val(response.lastname)
                        $("#email1").val(response.email)
                        $("#phone1").val(response.phone)
                        $("#address1").val(response.address)
                        $("#nickname1").val(response.nickname)
                        $("#company1").val(response.company)
                        if (response.status === "Active") {
                        $("#statusactive1").prop("checked", true)
                            
                        } else {
                        $("#statusinactive1").prop("checked", true)
                        }
                        $("#contact_key").val(response.key)

                    },
                });
              });
            });

    function html_table_to_excel(type){
        var data = document.getElementById('export_data');

        var file = XLSX.utils.table_to_book(data, {sheet: "sheet1"});

        // console.log(data,file)
        XLSX.write(file, { bookType: type, bookSST: true, type: 'base64' });

        XLSX.writeFile(file, 'file.' + type);
    }

    const export_button = document.getElementById('export_button');
    export_button.addEventListener('click', () =>  {
        html_table_to_excel('xlsx');
    });
    </script> --}}

{{-- <script type="text/javascript" src="https://unpkg.com/xlsx@0.15.1/dist/xlsx.full.min.js"></script> --}}

    {{ $contacts->links() }} <!-- Pagination -->

    <br><br><br>
    <!-- Button trigger modal -->
    <a href="{{url('add')}}" class="btn btn-primary">
        Add Contact
    </a><br><br>
    <a type="button" class="btn btn-primary" href="{{ route('export') }}">Export</a>
      
      <!-- Modal -->
      {{-- Update contact --}}
       <!-- Modal -->
       {{-- <div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Update Contact</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @csrf
                <form method="POST" action="dashboard/update">
                    @csrf

                    <input type="hidden" name="id" id="contact_id">

                    <div class="row mb-3">
                        <label for="firstname" class="col-md-4 col-form-label text-md-end">{{ __('First Name') }}</label>

                        <div class="col-md-6">
                            <input id="firstname1" type="text" class="form-control @error('firstname') is-invalid @enderror" name="firstname"  autocomplete="firstname" autofocus>

                            @error('firstname')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="lastname" class="col-md-4 col-form-label text-md-end">{{ __('Last Name') }}</label>

                        <div class="col-md-6">
                            <input id="lastname1" type="text" class="form-control @error('lastname') is-invalid @enderror" name="lastname"  autocomplete="lastname" autofocus>

                            @error('lastname')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span> 
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                        <div class="col-md-6">
                            <input id="email1" type="text" class="form-control @error('email') is-invalid @enderror" name="email" autocomplete="email">

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="phone" class="col-md-4 col-form-label text-md-end">{{ __('Phone') }}</label>

                        <div class="col-md-6">
                            <input id="phone1" type="phone" class="form-control @error('phone') is-invalid @enderror" name="phone" autocomplete="phone">

                            @error('phone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="address" class="col-md-4 col-form-label text-md-end">{{ __('Address') }}</label>

                        <div class="col-md-6">
                            <textarea  name="address" autocomplete="new-address" id="address1" cols="30" rows="4"type="text" class="form-control @error('address') is-invalid @enderror"></textarea>

                            @error('address')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="row mb-3">
                        <label for="nickname" class="col-md-4 col-form-label text-md-end">{{ __('Nickname') }}</label>

                        <div class="col-md-6">
                            <input id="nickname1" type="nickname"class="form-control @error('nickname') is-invalid @enderror" name="nickname"  autocomplete="new-nickname">

                            @error('nickname')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="row mb-3">
                        <label for="company1" class="col-md-4 col-form-label text-md-end">{{ __('Company') }}</label>

                        <div class="col-md-6">
                            <input id="company1" type="company" class="form-control @error('company') is-invalid @enderror" name="company"  autocomplete="new-company">

                            @error('company')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <input type="hidden" name="key" id="contact_key">
                    <div class="row mb-3">
                        <label for="status" class="col-md-4 col-form-label text-md-end">{{ __('Status') }}</label>
                        <div class="col-md-6">
                            <input id="statusactive1" type="radio" @error('status') is-invalid @enderror name="status" autocomplete="new-status" value="Active"> <!-- class="form-control"-->
                            <label for="statusactive1">Active</label>
                            <input id="statusinactive1" type="radio" @error('status') is-invalid @enderror name="status"  autocomplete="new-status" value="Inactive">
                            <label for="statusinactive1">Inactive</label>
                            @error('status')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
            </div>
          </div>
        </div>
      </div>   --}}

           </div>
           
{{-- <script src="https://code.jquery.com/jquery-3.5.1.js"></script>  --}}
{{-- <script src=" https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>  
<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script> 
<script>
           $(document).ready(function () {
            $('#export_data').DataTable({
                pageLength:1,  //customized pagination
            }); 
        });
</script> --}}
<script>
    @if(session()->has('alert'))
        alert(`{{ session()->get('alert') }}`);
    @endif
</script>
@endsection

