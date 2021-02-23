@extends('layout.app')

@section('title','Admin | Project Page')

@section('content')

<div id="projectDataDiv" class="container d-none">
        <div class="row">
            <div class="col-md-12 p-5">
                <button class="btn btn-primary m-0 mb-3" id="addProject">Add New Project</button>
                <table id="projectDataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th class="th-sm">Image</th>
                            <th class="th-sm">Name</th>
                            <th class="th-sm">Description</th>
                            <th class="th-sm">Edit</th>
                            <th class="th-sm">Delete</th>
                        </tr>
                    </thead>
                    <tbody id="projectTable">

                        
                        
                    </tbody>
                </table>

            </div>
        </div>
    </div>
    <div id="projectLoaderDiv" class="container">
        <div class="row">
            <div class="col-md-12 text-center p-5">
                
                <img  src="{{asset('images/loader.svg')}}">

            </div>
        </div>
    </div>
    <div id="projectWrongDiv" class="container d-none">
        <div class="row">
            <div class="col-md-12 text-center p-5">
                
               <h3>Something went wrong</h3>

            </div>
        </div>
    </div>

@endsection()



<div class="modal fade" id="projectUpdateModal" class="" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body text-center mt-3">
        <span id="projectEditDataId"></span>
        <h5>Project Update</h5>
        <input class="form-control" placeholder="project name" type="text" id="projectNameUpdate"/><br/>
        <input class="form-control" placeholder="project sort description" type="text" id="projectDescriptionUpdate"/><br/>
        <input class="form-control" placeholder="Image Url" type="text" id="projectImageUrlUpdate"/><br/>
      </div>
      <div class="modal-footer">
        <button id="projectEditCancel" type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button id="projectConfirmUpdate" type="button" class="btn btn-danger">Save</button>
      </div>
    </div>
  </div>
</div>



<div class="modal fade" id="projectAddModal" class="" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body text-center mt-3">
        <h5>Add New Project</h5>
        <input class="form-control" placeholder="project name" type="text" id="projectNameAdd"/><br/>
        <input class="form-control" placeholder="project sort description" type="text" id="projectDescriptionAdd"/><br/>
        <input class="form-control" placeholder="Image Url" type="text" id="projectImageUrlAdd"/><br/>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button id="projectConfirmAdd" type="button" class="btn btn-danger">Save</button>
      </div>
    </div>
  </div>
</div>




<div class="modal fade" id="projectDeleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body text-center mt-3">
        <h5>Do you want to delete!</h5>
        <span id="projectDeleteDataId"></span>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">NO</button>
        <button id="projectConfirmDelete" type="button" class="btn btn-danger">YES</button>
      </div>
    </div>
  </div>
</div>



@section('script')

    <script type="text/javascript">

        getProjectData();

    </script>

@endsection()

