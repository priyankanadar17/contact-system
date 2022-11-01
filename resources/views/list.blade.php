@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Contact List</h1>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <br><br><br>

    {{-- Search --}}

    {{-- <form action="{{ route('search') }}" method="GET">
        <h3>Search</h3><br>
        <input type="text" name="firstname" class="form-control" placeholder="First Name"><br>
        <input type="text" name="lastname" class="form-control" placeholder="Last Name"><br>
        <input type="text" name="email" class="form-control" placeholder="Email"><br>
        <input type="tel" name="phone" class="form-control" placeholder="Phone"><br>

        <input type="submit" value="Search" class="btn btn-secondary">
        </form>
        </div>
        <div class="col-md-8">
        <h3>List of Contacts</h3> --}}
        {{-- <table class="table table-striped">
        <tr>
        <th>ID</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Email</th>
        <th>Phone</th>
        <th>Address</th>
        <th>Nickname</th>
        <th>Company</th>
        <th>Status</th>
        </tr>
        @foreach($data as $pep)
        <tr>
        <td>{{ $pep->id }}</td>
        <td>{{ $pep->firstname }}</td>
        <td>{{ $pep->lastname }}</td>
        <td>{{ $pep->email }}</td>
        <td>{{ $pep->phone }}</td>
        <td>{{ $pep->address }}</td>
        <td>{{ $pep->nickname }}</td>
        <td>{{ $pep->company }}</td>
        <td>{{ $pep->status }}</td>
        </tr>
        @endforeach
        </table> --}}
        {{-- {{ $data->appends(request()->except('page'))->links() }} --}}
        {{-- </div>
        </div>
        </div> --}}


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
        @foreach($contacts as $contact)
        <tr>
            <td>{{$contact['id']}}</td>
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

            <td><a href="" data-bs-target="#exampleModal1" class="edit" data-bs-toggle="modal" data-id="{{$contact['id']}}" >Edit</a>
            </td>        
            
            <td><a href="{{ url('share/'. $contact['id'])}}" class="share" >Share</a>
            </td>        
        </tr> 
        @endforeach
    </tbody>
    </table>
        <script>
            $(document).ready(function(){
              $(".edit").click(function(){
                let id  = $(this).data('id');
                $.ajax({
                    url: `{{ url('list/${id}') }}`,
                    method: 'get',
                    success: function(response) {

                        console.log(response);
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
                        // $("#status1").val(response.company)
                    },
                    error : function (msg ) {
                        console.log(msg)
                var json=JSON.parse(msg.responseText);
                $.each(json.errors, function(idx, obj) {
                    alert(obj[0]);
                    return false;
                });
            },
                });
              });
            });

    // function html_table_to_excel(type){
    //     var data = document.getElementById('export_data');

    //     var file = XLSX.utils.table_to_book(data, {sheet: "sheet1"});

    //     // console.log(data,file)
    //     XLSX.write(file, { bookType: type, bookSST: true, type: 'base64' });

    //     XLSX.writeFile(file, 'file.' + type);
    // }

    // const export_button = document.getElementById('export_button');
    // export_button.addEventListener('click', () =>  {
    //     html_table_to_excel('xlsx');
    // });


    </script>

<script type="text/javascript" src="https://unpkg.com/xlsx@0.15.1/dist/xlsx.full.min.js"></script>

    {{-- {{ $contacts->links() }} <!-- Pagination --> --}}
    <br><br><br>
    <!-- Button trigger modal -->
    <a href="{{url('add')}}" class="btn btn-primary">
        Add Contact
    </a><br><br>
    <a type="button" class="btn btn-primary" href="{{ route('export') }}">Export</a>
      
      <!-- Modal -->
      {{-- Update contact --}}
       <!-- Modal -->
       <div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Update Contact</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @csrf
                <form method="POST" action="list/update">
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
      </div>  

           </div>
           
{{-- <script src="https://code.jquery.com/jquery-3.5.1.js"></script>  --}}
<script src=" https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>  
<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script> 
<script>
           $(document).ready(function () {
            $('#export_data').DataTable({
                pageLength:5,  //customized pagination
            });
            
            $("#add").submit(function(e){
                e.preventDefault();
                let form = document.getElementById('add');
            let formData = new FormData(form);

                $.ajax({
                    url:"{{url('list')}}",
                    type:"POST",
                    data: formData,
                    headers: { 'X-CSRF-TOKEN': "{{ csrf_token() }}" },
                    // dataType: "json",
                    processData:false,
                    success:function(response){
                        console.log('success')
                        console.log(response)
                    },
                    error:function(error){
                        console.log(error.responseJSON.errors.firstname[0])
                        $("#firstname_error").html(error.responseJSON.errors.firstname[0])
                    },
                })
            })
        });
</script>
@endsection

