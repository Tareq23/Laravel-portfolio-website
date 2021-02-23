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



function getCoursesData() {
    // console.log("getCourseData");
    $(document).ready(function () {
        axios.get('/allCourse')
            .then(function (response) {
                if (response.status == 200) {
                    $("#courseDataTable").DataTable().destroy();
                    $("#courseTable").empty();
                    $("#courseDataDiv").removeClass("d-none");
                    $("#loaderDivCourse").addClass("d-none");
                    let jsonCourseData = response.data;
                    $.each(jsonCourseData, function (idx, item) {
                        $('<tr>').html(
                            '<td>' + jsonCourseData[idx].name + '</td>' +
                            '<td>' + jsonCourseData[idx].total_class + '</td>' +
                            '<td>' + jsonCourseData[idx].total_enroll + '</td>' +
                            '<td> <a class="courseDetailsBtn" data-id="' + jsonCourseData[idx].id + '"><i class="far fa-eye"></i></a> </td>' +
                            '<td> <a class="courseUpdateBtn" data-id="' + jsonCourseData[idx].id + '"><i class="fas fa-edit"></i></a> </td>' +
                            '<td> <a class="courseDeleteBtn" data-id="' + jsonCourseData[idx].id + '"><i class="fas fa-trash-alt"></i></a></td>'
                        ).appendTo("#courseTable");
                    });
                    /* Pagination Added */
                    $("#courseDataTable").DataTable();
                    $('.dataTables_length').addClass('bs-select');

                    $(".courseDetailsBtn").click(function () {
                        let courseId = $(this).data('id');
                        courseDetails(courseId);
                    });
                    
                    $(".courseDeleteBtn").click(function () {
                        let courseId = $(this).data('id');
                        $("#courseDeleteDataId").val(courseId);
                        $("#courseDeleteModal").modal('show');
                    })
                    $(".courseUpdateBtn").click(function () {
                        let courseId = $(this).data('id');
                        $("#courseUpdateDataId").val(courseId);
                        courseUpdateShow(courseId)
                    })
                }
                else {
                    $("wrongDivCourse").removeClass("d-none");
                    $("#loaderDivCourse").removeClass("d-none");
                }

            })
            .catch(function (error) {
                console.log("error fatch");
                console.log(error);
            });
    });
}

function courseDetails(courseId) {
    axios.post('/courseDtails', { id: courseId })
        .then(function (response) {
            if (response.status == 200) {
                $("#courseDetailsModal").modal('show');
                let courseName = response.data.name;
                let courseClass = response.data.total_class;
                let courseEnroll = response.data.total_enroll;
                let courseFee = response.data.total_fee;
                let courseLink = response.data.link;
                let courseImage = response.data.image;
                let courseDesc = response.data.description;
                $("#courseName").val(courseName);
                $("#courseClass").val(courseClass);
                $("#courseEnroll").val(courseEnroll);
                $("#courseFee").val(courseFee);
                $("#courseLink").val(courseLink);
                $("#courseImage").val(courseImage);
                $("#courseDesc").val(courseDesc);
            }
        })
        .catch(function (error) {
            toastr.error("Something Went Wrong");
        });
}

$(document).ready(function(){
    $("#addCourse").click(function () {
        $("#courseAddModal").modal('show');
    })
    
    $("#courseConfirmAdd").click(function () {
        let courseName = $("#courseNameAdd").val();
        let courseClass = $("#courseClassAdd").val();
        let courseEnroll = $("#courseEnrollAdd").val();
        let courseFee = $("#courseFeeAdd").val();
        let courseLink = $("#courseLinkAdd").val();
        let courseImage = $("#courseImageAdd").val();
        let courseDesc = $("#courseDescAdd").val();
        courseAdd(courseName, courseClass, courseEnroll, courseLink, courseImage, courseFee, courseDesc);
    });
    
})


function courseAdd(courseName, courseClass, courseEnroll, courseLink, courseImage, courseFee, courseDesc) {
    if (courseName.length == 0) {
        toastr.error("Course Name Required");
    }
    else if (courseClass.length == 0) {
        toastr.error("Total Class Required");
    }
    else if (courseEnroll.length == 0) {
        toastr.error("Total Enroll Student Required");
    }
    else if (courseFee.length == 0) {
        toastr.error("Course Fee Required");
    }
    else if (courseLink.length == 0) {
        toastr.error("Course Link Required");
    }
    else if (courseImage.length == 0) {
        toastr.error("Course Image Link Required");
    }
    else if (courseDesc.length == 0) {
        toastr.error("Course Description Required");
    }
    else {
        axios.post('/courseAdd', {
            name: courseName,
            image: courseImage,
            enroll: courseEnroll,
            class: courseClass,
            fee: courseFee,
            desc: courseDesc,
            link: courseLink
        }).then(function (response) {
            if (response.status == 200) {
                $("#courseAddModal").modal('hide');
                $("#courseNameAdd").val("");
                $("#courseClassAdd").val("");
                $("#courseEnrollAdd").val("");
                $("#courseFeeAdd").val("");
                $("#courseLinkAdd").val("");
                $("#courseImageAdd").val("");
                $("#courseDescAdd").val("");
                toastr.success("Add Success");
                
                getCoursesData();
            }
            else {

            }
        }).catch(function (error) {

        })
    }
}


/* Course Update Section  Start*/


function courseUpdateShow(courseId) {
    axios.post('/courseDtails', { id: courseId })
        .then(function (response) {
            if (response.status == 200) {
                let courseName = response.data.name;
                let courseClass = response.data.total_class;
                let courseEnroll = response.data.total_enroll;
                let courseFee = response.data.total_fee;
                let courseLink = response.data.link;
                let courseImage = response.data.image;
                let courseDesc = response.data.description;
                $("#courseNameUpdate").val(courseName);
                $("#courseClassUpdate").val(courseClass);
                $("#courseEnrollUpdate").val(courseEnroll);
                $("#courseFeeUpdate").val(courseFee);
                $("#courseLinkUpdate").val(courseLink);
                $("#courseImageUpdate").val(courseImage);
                $("#courseDescUpdate").val(courseDesc);
                $("#courseUpdateModal").modal('show');
            }
        })
        .catch(function (error) {
            toastr.error("Something Went Wrong");
        });
}


$("#courseUpdateConfirm").click(function(){
    let courseId = $("#courseUpdateDataId").val();
    courseUpdateConfirm(courseId);
});
function courseUpdateConfirm(courseId) {
    let courseName = $("#courseNameUpdate").val();
    let courseClass =  $("#courseClassUpdate").val();
    let courseEnroll = $("#courseEnrollUpdate").val();
    let courseFee = $("#courseFeeUpdate").val();
    let courseLink = $("#courseLinkUpdate").val();
    let courseImage = $("#courseImageUpdate").val();
    let courseDesc = $("#courseDescUpdate").val();
    if (courseName.length == 0) {
        toastr.error("Course Name Required");
    }
    else if (courseClass.length == 0) {
        toastr.error("Total Class Required");
    }
    else if (courseEnroll.length == 0) {
        toastr.error("Total Enroll Student Required");
    }
    else if (courseFee.length == 0) {
        toastr.error("Course Fee Required");
    }
    else if (courseLink.length == 0) {
        toastr.error("Course Link Required");
    }
    else if (courseImage.length == 0) {
        toastr.error("Course Image Link Required");
    }
    else if (courseDesc.length == 0) {
        toastr.error("Course Description Required");
    }
    else{
        axios.post('/courseUpdate',{
            id:courseId,
            name: courseName,
            image: courseImage,
            enroll: courseEnroll,
            class: courseClass,
            fee: courseFee,
            desc: courseDesc,
            link: courseLink
        }).then(function(response){
            if(response.data.status==200)
            {
                toastr.success("Data Update success");
                $("#courseUpdateModal").modal('hide');
                getCoursesData();
            }
            else{
                toastr.error("Data not found!");
            }
        }).catch(function(response){
            toastr.error("something went wrong");
        });
    }
}

/* Course Delete Section  Start*/


$(document).ready(function(){
    
    $("#courseConfirmDelete").click(function(e){
        e.preventDefault();
        let courseId = $("#courseDeleteDataId").val();
        courseDelete(courseId);
    });
})

function courseDelete(courseId) {
    axios.post('/courseDelete', { id: courseId })
        .then(function (response) {
            console.log("Deleted course Id "+courseId);
            if (response.data.result) {
                toastr.success("Delete Success");
                $("#courseDeleteModal").modal('hide');
                getCoursesData();
            }
            else{
                toastr.error("Data not found!");
                $("#courseDeleteModal").modal('hide');
            }
        })
        .catch(function (error) {
            toastr.error("Something Went Wrong");
        })
}

/* Course Delete Section End*/




    </script>
@endsection