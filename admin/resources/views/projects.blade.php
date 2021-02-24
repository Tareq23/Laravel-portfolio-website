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



function getProjectData() {
    axios.get('/allProject')
        .then(function (response) {
            // console.log(response);
            if (response.status == 200) {
                $("#projectDataDiv").removeClass("d-none");
                $("#projectLoaderDiv").addClass("d-none");

                $("#projectDataTable").DataTable().destroy();
                $("#projectTable").empty();
                let projectJsonData = response.data;

                $.each(projectJsonData, function (idx, item) {
                    $('<tr>').html(
                        '<td><img class="table-img" src="' + projectJsonData[idx].image + '"/></td>' +
                        '<td>' + projectJsonData[idx].name + '</td>' +
                        '<td>' + projectJsonData[idx].description + '</td>' +
                        '<td><a class="projectEditBtn" data-id=' + projectJsonData[idx].id + ' data-toggle="modal"><i class="fas fa-edit"></i></a></td>' +
                        '<td><a class="projectDeleteBtn" data-id=' + projectJsonData[idx].id + ' data-toggle="modal"><i class="fas fa-trash-alt"></i></a></td>'
                    ).appendTo("#projectTable");
                });

                $(".projectEditBtn").click(function () {
                    let projectId = $(this).data('id');
                    $("#projectEditDataId").val(projectId);
                    projectUpdateShow()
                })
                $(".projectDeleteBtn").click(function(){
                    let projectId = $(this).data('id');
                    $("#projectDeleteDataId").val(projectId);
                    $("#projectDeleteModal").modal('show');
                });
            }
            else {
                $("#projectLoaderDiv").addClass("d-none");
                $("#projectWrongDiv").removeClass("d-none");
            }
        }).catch(function (response) {
            $("#projectLoaderDiv").removeClass("d-none");
        });
}



function projectUpdateShow() {
    let projectId = $("#projectEditDataId").val();
    axios.post('/getSingleProject', { id: projectId })
        .then(function (response) {
            if (response.status == 200) {
                // console.log(response.data);
                $("#projectNameUpdate").val(response.data.name);
                $("#projectDescriptionUpdate").val(response.data.description);
                $("#projectImageUrlUpdate").val(response.data.image);
                $("#projectUpdateModal").modal('show');
            }
            else {
                toastr.error("Something Went Wrong")
            }
        })
        .catch(function (error) {
            console.log(error);
            toastr.error("Something Went Wrong")
        });
}

$("#projectConfirmUpdate").click(function () {
    projectUpdate();
});

function projectUpdate() {
    let projectId = $("#projectEditDataId").val();
    let projectName = $("#projectNameUpdate").val();
    let projectDesc = $("#projectDescriptionUpdate").val();
    let projectImg = $("#projectImageUrlUpdate").val();
    if (projectName.length == 0) {
        toastr.error("Project Name Required");
    }
    else if (projectImg.length == 0) {
        toastr.error("Project Image Required");
    }
    else if (projectDesc.length == 0) {
        toastr.error("Project Description Required");
    }
    else {
        axios.post('/updateProject', {
            id: projectId,
            name: projectName,
            description: projectDesc,
            image: projectImg,
            })
            .then(function (response) {
                if (response.status == 200) {
                    $("#projectUpdateModal").modal('hide');
                    toastr.success("Project Data Update Success");
                    getProjectData();
                }
                else {
                    toastr.error("Something Missing");
                }
            })
            .catch(function (error) {
                toastr.error("Something Went Wrong")
            })
    }
}


$("#projectConfirmDelete").click(function () {
    let projectId =  $("#projectDeleteDataId").val();
    axios.post('/deleteProject',{id:projectId})
        .then(function(response){
            if(response.data.status==200)
            {
                toastr.success("Delete Success");
                $("#projectDeleteModal").modal('hide');
                getProjectData();
            }
            else{
                toastr.error("Data Not Found");
                $("#projectDeleteModal").modal('hide');
            }
        })
        .catch(function(error){
            toastr.error("Something went wrong");
        })
});
$("#addProject").click(function(){
    console.log("Modal showw");
    $("#projectAddModal").modal('show');
})

$("#projectConfirmAdd").click(function(){
    let projectName = $("#projectNameAdd").val();
    let projectDesc = $("#projectDescriptionAdd").val();
    let projectImg = $("#projectImageUrlAdd").val();
    if (projectName.length == 0) {
        toastr.error("Project Name Required");
    }
    else if (projectImg.length == 0) {
        toastr.error("Project Image Required");
    }
    else if (projectDesc.length == 0) {
        toastr.error("Project Description Required");
    }
    else {
        console.log(projectDesc+"\n"+projectImg+"\n"+projectName);
        axios.post('/addProject', {
            name: projectName,
            description: projectDesc,
            image: projectImg,
            })
            .then(function (response) {
                if (response.status == 200) {
                    $("#projectAddModal").modal('hide');
                    toastr.success("New Added");
                    $("#projectNameAdd").val("");
                    $("#projectDescriptionAdd").val("");
                    $("#projectImageUrlAdd").val("");
                    getProjectData();
                }
                else {
                    toastr.error("Something Missing");
                }
            })
            .catch(function (error) {
                toastr.error("Something Went Wrong")
            })
    }
})

    </script>

@endsection()

