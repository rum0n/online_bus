@extends('admin.master')

@section('title','Add Time Schedule')

@push('css')
{{--<link rel="stylesheet" href="http://www.codermen.com/css/bootstrap.min.css">--}}
@endpush

@section('content')
   <section id="main-content">

        <section class="wrapper">
            <!-- row -->
            <div class="row mt">
                <div class="col-md-12">
                    <div class="content-panel">
                        <div class="content">
                            <button class="btn btn-theme add" type="submit" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus"> Add Time Schedule</i></button>

                            <table class="table table-striped table-advance table-hover">
                                <thead class="bg-success">
                                <tr>
                                    <th>S.I</th>
                                    <th>Operator Name</th>
                                    <th>Bus Name</th>
                                    <th>Start Time</th>
                                    <th>From</th>
                                    <th>Destination</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                @forelse( $bus_schedules as $bus_schedule )
                                    <tbody>
                                        <tr>
                                            <td>{{$loop->index + 1}}</td>
                                            <td>Operator Name</td>
                                            <td>Bus Name</td>
                                            <td>{{$bus_schedule->time_schedule}}</td>
                                            <td>{{$bus_schedule->from}}</td>
                                            <td>{{$bus_schedule->destination}}</td>
                                            <td>

                                                <button onclick="activeInactive({{ $bus_schedule->id }})" class="btn btn-{{($bus_schedule->status==1)?'success':'danger'}} btn-sm">{{ ($bus_schedule->status==1)?'Active':'Inactive' }}</button>
                                                <form id="status-form-{{ $bus_schedule->id }}" class="form-horizontal" action="{{ route('admin.bus_status',$bus_schedule->id)  }}" method="get">
                                                    @csrf
                                                </form>

                                                {{--{{$bus_schedule->status}}--}}

                                            </td>
                                            <td>
                                                <div class="btn-group" role="group">
                                                    <button onclick="deletePost({{ $bus_schedule->id }})" class="btn btn-danger">Delete</button>
                                                    <a href="#"class="btn btn-info">Edit</a>
                                                    <a href="#"class="btn btn-info">View</a>
                                                </div>

                                                <form id="delete-form-{{ $bus_schedule->id }}" class="form-horizontal" action="{{ route('admin.operator.destroy',$bus_schedule->id) }}" method="POST">
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
                   <h4 class="modal-title centered">Add Time Schedule</h4>
               </div>

               <div class="modal-body">
                   <form method="post" action="{{ route('admin.schedule.store') }}" enctype="multipart/form-data">
                       @csrf
                       <div class="row">
                           <div class="col-md-8 col-md-offset-2">

                               <div class="form-group">
                                   <select id="country" name="operator_id" class="form-control">
                                       <option value="" selected disabled>Select Operator</option>
                                       @foreach($all_operators as $key => $operator)
                                           <option value="{{$key}}"> {{$operator}}</option>
                                       @endforeach
                                   </select>
                               </div>

                               <div class="form-group">
                                   {{--<label for="title">Select Bus:</label>--}}
                                   <select name="bus_id" id="state" class="form-control">
                                   </select>
                               </div>

                               <div class="form-group">
                                   <input type="time" name="time_schedule" class="form-control" aria-describedby="emailHelp" value="00:00">
                               </div>

                               <div class="form-group">
                                   <input type="text" name="from" class="form-control" aria-describedby="emailHelp" placeholder="Enter Depart Bus Stand">
                               </div>

                               <div class="form-group">
                                   <input type="text" name="destination" class="form-control" aria-describedby="emailHelp" placeholder="Enter Destination">
                               </div>

                               <div class="form-group">
                                   <button type="submit" class="btn btn-theme btn-block">Add Operator</button>
                               </div>
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
   <!-- Modal Ends -->

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

<script src="http://www.codermen.com/js/jquery.js"></script>

<script type="text/javascript">
    $('#country').change(function(){
        var busID = $(this).val();
        if(busID){
            $.ajax({
                type:"GET",
                url:"{{url('admin/getBus')}}?operator_id="+busID,
                success:function(res){
                    if(res){
                        $("#state").empty();
                        $("#state").append('<option>Select</option>');
                        $.each(res,function(key,value){
                            $("#state").append('<option value="'+key+'">'+value+'</option>');
                        });

                    }else{
                        $("#state").empty();
                    }
                }
            });
        }else{
            $("#state").empty();
        }
    });

</script>


<script type="text/javascript">
    function activeInactive(id) {
        swal({
            title: 'Are you sure?',
            //                text: "You won't be able to revert this!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, do it!',
            cancelButtonText: 'No, cancel!',
            confirmButtonClass: 'btn btn-success',
            cancelButtonClass: 'btn btn-danger mr-2',
            buttonsStyling: true,
            reverseButtons: true
        }).then((result) => {
            if (result.value) {
            event.preventDefault();
            document.getElementById('status-form-'+id).submit();
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
  
  
  						

















							