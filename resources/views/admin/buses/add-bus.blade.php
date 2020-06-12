@extends('admin.master')

@section('title','Add Bus')

@push('css')
    

@endpush

@section('content')
   <section id="main-content">

        <section class="wrapper">
            <!-- row -->
            <div class="row mt">
                <div class="col-md-12">
                    <div class="content-panel">
                        <section class="content">
                        <button class="btn btn-theme add" type="submit" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus"> Add Bus</i></button>
                            
                        <table class="table table-striped table-advance table-hover">
                        <thead class="bg-success">
                          <tr>
                            <th>S.I</th>
                       
                            <th>Operator Name</th>
                        
                            <th>Bus Code</th>
                       
                            <th>Bus type</th>
                        
                            <th>Total Seats</th>
                           

                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                          @forelse( $all_bus as $bus )
                        <tbody>
                          <tr>
                          <td>{{$loop->index + 1}}</td>
                          <td>{{$bus->operator->operator_name}}</td>
                          <td>{{$bus->bus_code}}</td>
                          <td>{{$bus->bus_type}}</td>
                          
                          <td>{{$bus->total_seats}}</td>
                          <td>{{$bus->status}}</td>
                          <td>
                            
                          <div class="btn-group" role="group">
                            <button onclick="deletePost({{ $bus->id }})" class="btn btn-danger">Delete</button>
                            <button data-toggle="modal" data-target="#edit"class="btn btn-info">Edit</button>

                           {{--  <a data-toggle="modal" data-target="#myModal2"class="btn btn-info">Edit</a> --}}
                            <a href="#"class="btn btn-info">View</a>
                          </div>
                             <form id="delete-form-{{ $bus->id }}" class="form-horizontal" action="{{ route('admin.bus.destroy',$bus->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                            </form>


                          </td>
                          
                        </tr>
                        </tbody>
                      @empty
                       <tr>
                           <td class="text-center" colspan="12"><h3 class="text-danger">No Bus Are available</h3></td>
                              </tr>
                      @endforelse
                        </tbody>

                    </table>
                        

                       </section>

                       <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title centered">Add New Bus</h4>
        </div>
        <div class="modal-body">
          <form method="post" action="{{ route('admin.bus.store') }}" enctype="multipart/form-data">
                      {{ csrf_field() }}
                      <fieldset>
                      <div class="row">
                       
                        <div class="col-md-6">
                        <div class="form-group">
                                <!-- <label for="exampleInputPassword1">Seat No</label> -->
                                <select name="operator_id" class="form-control">
                                    <option value="">Select Operator</option>
                                    @foreach ($all_operator as $select_operator)
                                    <option value="{{$select_operator->id}}">{{$select_operator->operator_name}}</option>
                                    @endforeach
                                </select>
                          </div>
                         
                        </div>
                      
                          <div class="col-md-6">
                          <div class="form-group">
                                <!-- <label for="exampleInputEmail1">Bus Name</label> -->
                                <input name="bus_code"  class="form-control" aria-describedby="emailHelp" 
                                placeholder="Enter Bus Code" type="text">
                          </div>
                          </div>

                          <div class="col-md-6">
                          <div class="form-group">
                                <!-- <label for="exampleInputEmail1">Bus Name</label> -->
                                <input name="total_seats"  class="form-control" aria-describedby="emailHelp" 
                                placeholder="Enter Total Seat Number" type="number" min="20" max="50">
                          </div>
                          </div>
                          
                          
                        <div class="col-md-6">
                          <div class="form-group">
                                <!-- <label for="exampleInputEmail1">Bus Name</label> -->
                                <select  name="bus_type"  class="form-control">
                                  <option value=" ">Bus type</option>
                                  <option value="AC">AC</option>
                                  <option value="Non-AC">Non-AC</option>
                                </select>
                          </div>
                          </div>

                        <div class="col-md-12 ">
                          <button type="submit" class="btn btn-theme btn-block">Add Bus</button>
                        </div>


                          </div>
                       
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
  </div>


  {{-- <div class="modal fade" id="edit" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title centered">Bus Edit</h4>
        </div>
        <div class="modal-body">
          <form method="post" action="{{ route('admin.bus.update',$bus->id) }}" enctype="multipart/form-data" name="edit-form">
                      {{ csrf_field() }}
                      <fieldset>
                      <div class="row">
                       
                      <div class="col-md-6">
                          <div class="form-group">
                                
                                <input name="bus_name"  class="form-control" aria-describedby="emailHelp"
                                 value="{{$bus->bus_name}}" type="text">
                          </div>
                          </div>
                          <div class="col-md-6">
                          <div class="form-group">
                               
                                <input name="bus_code"  class="form-control" aria-describedby="emailHelp" 
                                value="{{$bus->bus_code}}" type="text">
                          </div>
                          </div>

                          <div class="col-md-6">
                          <div class="form-group">
                               
                                <input name="total_seats"  class="form-control" aria-describedby="emailHelp" 
                                value="{{$bus->total_seats}}" type="number" min="20" max="50">
                          </div>
                          </div>
                          
                           <div class="col-md-6">
                        <div class="form-group">
                                
                                <select name="operator_id" class="form-control">
                                    <option value="">Select Operator</option>
                                    @foreach ($all_operator as $select_operator)
                                    <option value="{{$select_operator->id}}">{{$select_operator->operator_name}}</option>
                                    @endforeach
                                </select>
                          </div>
                         
                        </div>

                        <div class="col-md-12 ">
                          <button type="submit" class="btn btn-theme btn-block">Update Bus</button>
                        </div>


                          </div>
                       
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
  </div> --}}
  


    </section>   

@endsection

@push('js')
{{-- Modal Script --}}
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>


<script type="text/javascript">
  function deletePost(id) {
    swal({
      title: 'Are you sure?',
      text: "You won't be able to revert this!",
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, delete it!',
      cancelButtonText: 'No, cancel!',
      confirmButtonClass: 'btn btn-success',
      cancelButtonClass: 'btn btn-danger mr-2',
      buttonsStyling: true,
      reverseButtons: true
    }).then((result) => {
      if (result.value) {
      event.preventDefault();
      document.getElementById('delete-form-'+id).submit();
    } else if (
            // Read more about handling dismissals
    result.dismiss === swal.DismissReason.cancel
    ) {
      swal(
              'Cancelled',
              'Your data is safe :)',
              'error'
      )
    }
  })
  }
</script>

@endpush
  
  
  