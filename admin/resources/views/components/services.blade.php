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

                        <!-- <tr>
                            <th class="th-sm"><img class="table-img" src="images/Knowledge.svg"></th>
                            <th class="th-sm">আইটি কোর্স</th>
                            <th class="th-sm">মোবাইল এবং ওয়েব এপ্লিকেশন ডেভেলপমেন্ট</th>
                            <th class="th-sm"><a href=""><i class="fas fa-edit"></i></a></th>
                            <th class="th-sm"><a href=""><i class="fas fa-trash-alt"></i></a></th>
                        </tr> -->
                        
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



<div class="modal fade" id="serviceDeleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body text-center mt-3">
        <h5>Do you want to delete!</h5>
        <span id="serviceDataId"></span>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">NO</button>
        <button id="serviceConfirmDelete" type="button" class="btn btn-danger">YES</button>
      </div>
    </div>
  </div>
</div>


@section('script')
    <script type="text/javascript">
        getServicesData();
    </script>
@endsection()