@extends('layout.app')


@section('content')
    <div id="serviceDataDiv" class="container d-none">
        <div class="row">
            <div class="col-md-12 p-5">
                <table id="serviceDataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th class="th-sm">Image</th>
                            <th class="th-sm">Name</th>
                            <th class="th-sm">Description</th>
                            <th class="th-sm">Edit</th>
                            <th class="th-sm">Delete</th>
                        </tr>
                    </thead>
                    <tbody id="serviceTable">

                        
                        
                    </tbody>
                </table>

            </div>
        </div>
    </div>
    <div id="loaderDiv" class="container">
        <div class="row">
            <div class="col-md-12 text-center p-5">
                
                <img  src="{{asset('images/loader.svg')}}">

            </div>
        </div>
    </div>
    <div id="wrongDiv" class="container d-none">
        <div class="row">
            <div class="col-md-12 text-center p-5">
                
               <h3>Something went wrong</h3>

            </div>
        </div>
    </div>
@endsection()


<!--  service delete modal  -->
<div class="modal fade" id="serviceDeleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body text-center mt-3">
        <h5>Do you want to delete!</h5>
        <span id="serviceDeleteDataId"></span>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">NO</button>
        <button id="serviceConfirmDelete" type="button" class="btn btn-danger">YES</button>
      </div>
    </div>
  </div>
</div>


<!-- service edit modal -->

<div class="modal fade" id="serviceEditModal" class="" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body text-center mt-3">
        <span id="serviceEditDataId"></span>
        <h5>Service Details</h5>
        <input class="form-control" type="text" id="serviceName"/><br/>
        <input class="form-control" type="text" id="serviceDescription"/><br/>
        <input class="form-control" type="text" id="serviceImageUrl"/><br/>
      </div>
      <div class="modal-footer">
        <button id="serviceEditCancel" type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button id="serviceConfirmEdit" type="button" class="btn btn-danger">Save</button>
      </div>
    </div>
  </div>
</div>


@section('script')
    <script type="text/javascript">
        getServicesData();
    </script>
@endsection()