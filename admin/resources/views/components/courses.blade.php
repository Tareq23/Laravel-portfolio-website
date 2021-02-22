@extends('layout.app')

@section('title','Admin | Course Page')

@section('content')

    <div id="courseDataDiv" class="container d-none">
        <div class="row">
            <div class="col-md-12 p-5">
                <button class="btn btn-primary m-0 mb-3" id="addCourse">Add New Course</button>
                <table id="courseDataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th class="th-sm">Name</th>
                            <th class="th-sm">Total Class</th>
                            <th class="th-sm">Enrolls</th>
                            <th class="th-sm">Details</th>
                            <th class="th-sm">Edit</th>
                            <th class="th-sm">Delete</th>
                        </tr>
                    </thead>
                    <tbody id="courseTable">

                        
                        
                    </tbody>
                </table>

            </div>
        </div>
    </div>
    <div id="loaderDivCourse" class="container">
        <div class="row">
            <div class="col-md-12 text-center p-5">
                
                <img  src="{{asset('images/loader.svg')}}">

            </div>
        </div>
    </div>
    <div id="wrongDivCourse" class="container d-none">
        <div class="row">
            <div class="col-md-12 text-center p-5">
                
               <h3>Something went wrong</h3>

            </div>
        </div>
    </div>

@endsection()




<!-- Course Details Modal -->


<div class="modal fade" id="courseDetailsModal" class="" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body text-center mt-3">
        <span id="courseEditDataId"></span>
        <h5>course Details</h5>
        <input class="form-control" type="text" id="courseName"/><br/>
        <input class="form-control" type="text" id="courseClass"/><br/>
        <input class="form-control" type="text" id="courseEnroll"/><br/>
        <input class="form-control" type="text" id="courseFee"/><br/>
        <input class="form-control" type="text" id="courseLink"/><br/>
        <input class="form-control" type="text" id="courseImage"/><br/>
        <input class="form-control" type="text" id="courseDesc"/><br/>
      </div>
      <div class="modal-footer">
        <button id="courseEditCancel" type="button" class="btn btn-secondary" data-dismiss="modal">OK</button>
      </div>
    </div>
  </div>
</div>


<!-- course Update -->
<div class="modal fade" id="courseUpdateModal" class="" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body text-center mt-3">
        <span id="courseUpdateDataId"></span>
        <h5>Course Update</h5>
        <input class="form-control" type="text" id="courseNameUpdate"/><br/>
        <input class="form-control" type="text" id="courseClassUpdate"/><br/>
        <input class="form-control" type="text" id="courseEnrollUpdate"/><br/>
        <input class="form-control" type="text" id="courseFeeUpdate"/><br/>
        <input class="form-control" type="text" id="courseLinkUpdate"/><br/>
        <input class="form-control" type="text" id="courseImageUpdate"/><br/>
        <input class="form-control" type="text" id="courseDescUpdate"/><br/>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button id="courseUpdateConfirm" type="button" class="btn btn-secondary">Save</button>
      </div>
    </div>
  </div>
</div>



<!-- New course Add -->

<div class="modal fade" id="courseAddModal" class="lg" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body text-center mt-3">
        <h5>New Course</h5>
        <input class="form-control" placeholder="Course Name" type="text" id="courseNameAdd"/><br/>
        <input class="form-control" placeholder="Total class" type="text" id="courseClassAdd"/><br/>
        <input class="form-control" placeholder="Total Enroll" type="text" id="courseEnrollAdd"/><br/>
        <input class="form-control" placeholder="Course Fee" type="text" id="courseFeeAdd"/><br/>
        <input class="form-control" placeholder="Course Link" type="text" id="courseLinkAdd"/><br/>
        <input class="form-control" placeholder="Image Link" type="text" id="courseImageAdd"/><br/>
        <input class="form-control" placeholder="short Description" type="text" id="courseDescAdd"/><br/>
      </div>
      <div class="modal-footer">
        <button id="courseConfirmAddCancel" type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button id="courseConfirmAdd" type="button" class="btn btn-secondary">Save</button>
      </div>
    </div>
  </div>
</div>



<div class="modal fade" id="courseDeleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body text-center mt-3">
        <h5>Do you want to delete!</h5>
        <span id="courseDeleteDataId"></span>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">NO</button>
        <button id="courseConfirmDelete" type="button" class="btn btn-danger">YES</button>
      </div>
    </div>
  </div>
</div>



@section('script')
    <script type="text/javascript">
        getCoursesData();
    </script>
@endsection