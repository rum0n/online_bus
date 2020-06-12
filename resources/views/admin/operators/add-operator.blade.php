@extends('admin.master')

@section('title','Add Operator')

@push('css')
    

@endpush

@section('content')
   <section id="main-content">

        <section class="wrapper">
            <!-- row -->
            <div class="row mt">
                <div class="col-md-12">
                    <div class="content-panel">
                        <div class="content">
                            <button class="btn btn-theme add" type="submit" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus"> Add Operator</i></button>

                            <table class="table table-striped table-advance table-hover">
                                <thead class="bg-success">
                                    <tr>
                                        <th>S.I</th>
                                        <th>Operator Name</th>
                                        <th>Operator Email</th>
                                        <th>Operator Phone</th>
                                        <th>Operator Address</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                @forelse( $all_operator as $operator )
                                <tbody>
                                    <tr>
                                        <td>{{$loop->index + 1}}</td>
                                        <td>{{$operator->operator_name}}</td>
                                        <td>{{$operator->operator_email}}</td>
                                        <td>{{$operator->operator_phone}}</td>
                                        <td>{{$operator->operator_address}}</td>
                                        <td>{{$operator->status}}</td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <button onclick="deletePost({{ $operator->id }})" class="btn btn-danger">Delete</button>
                                                <a href="#"class="btn btn-info">Edit</a>
                                                <a href="#"class="btn btn-info">View</a>
                                            </div>

                                            <form id="delete-form-{{ $operator->id }}" class="form-horizontal" action="{{ route('admin.operator.destroy',$operator->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        </td>
                                    </tr>
                                </tbody>
                                @empty
                                   <tr>
                                       <td class="text-center" colspan="12"><h3 class="text-danger">No Operator Are available</h3></td>
                                   </tr>
                                @endforelse
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </section>
   </section>

   <!-- Modal -->
   <div class="modal fade" id="myModal" role="dialog">
       <div class="modal-dialog">

           <!-- Modal content-->
           <div class="modal-content">
               <div class="modal-header">
                   <button type="button" class="close" data-dismiss="modal">&times;</button>
                   <h4 class="modal-title centered">Add New Operator</h4>
               </div>
               <div class="modal-body">
                   <form method="post" action="{{ route('admin.operator.store') }}" enctype="multipart/form-data">
                       @csrf
                       <div class="row">
                           <div class="col-md-6">
                               <div class="form-group">
                                   <input name="operator_name"  class="form-control" aria-describedby="emailHelp"
                                          placeholder="Enter Operator Name" type="text">
                               </div>
                           </div>
                           <div class="col-md-6">
                               <div class="form-group">
                                   <input name="operator_email"  class="form-control" aria-describedby="emailHelp"
                                          placeholder="Enter Email" type="email">
                               </div>
                           </div>

                           <div class="col-md-6">
                               <div class="form-group">
                                   <!-- <label for="exampleInputEmail1">Bus Name</label> -->
                                   <input name="operator_phone"  class="form-control" aria-describedby="emailHelp"
                                          placeholder="Enter Mobile Number" type="text">
                               </div>
                           </div>
                       </div>

                       <div class="row">
                           <div class="col-md-12">
                               <div class="form-group">
                                            <textarea name="operator_address" rows="2" cols="20" class="form-control"
                                                      placeholder="Enter Operator Address" type="text"></textarea>
                               </div>
                           </div>
                           <div class="col-md-12 ">
                               <button type="submit" class="btn btn-theme btn-block">Add Operator</button>
                           </div>
                       </div>
                       <div class="modal-footer">
                           <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                       </div>
                   </form>
               </div>
           </div>
       </div>
   </div>

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
  
  
  