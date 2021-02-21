@extends('layout.app')


@section('content')
    <div id="serviceDataDiv" class="container d-none">
        <div class="row">
            <div class="col-md-12 p-5">
                <button class="btn btn-primary m-0 mb-3" id="addService">Add New Service</button>
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

<!-- SERVICE New ADD  -->

<div class="modal fade" id="serviceAddModal" class="" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body text-center mt-3">
        <!-- <span id="serviceEditDataId"></span> -->
        <h5>Add New Service</h5>
        <input class="form-control" placeholder="service name" type="text" id="serviceNameAdd"/><br/>
        <input class="form-control" placeholder="Service sort description" type="text" id="serviceDescriptionAdd"/><br/>
        <input class="form-control" placeholder="Image Url" type="text" id="serviceImageUrlAdd"/><br/>
      </div>
      <div class="modal-footer">
        <button id="serviceEditCancel" type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button id="serviceConfirmAdd" type="button" class="btn btn-danger">Save</button>
      </div>
    </div>
  </div>
</div>



@section('script')
    <script type="text/javascript">
        getServicesData();


function getServicesData() {
    /* prevent to duplicate Selector data */
    $(document).ready(function () {
        axios.get("/getServicesData")
            .then(response => {

                if (response.status == 200) {


                    $("#serviceDataDiv").removeClass("d-none");
                    $("#loaderDiv").addClass("d-none");

                    $("#serviceDataTable").DataTable().destroy();
                    $("#serviceTable").empty();
                    var jsonData = response.data;

                    $.each(jsonData, (idx, item) => {
                        $('<tr>').html(
                            '<td><img class="table-img" src="' + jsonData[idx].image + '"></td>' +
                            '<td>' + jsonData[idx].name + '</td>' +
                            '<td>' + jsonData[idx].description + '</td>' +
                            '<td><a class="serviceEditBtn" data-id=' + jsonData[idx].id + ' data-toggle="modal"><i class="fas fa-edit"></i></a></td>' +
                            '<td><a class="serviceDeleteBtn" data-id=' + jsonData[idx].id + ' data-toggle="modal" ><i class="fas fa-trash-alt"></i></a></td>'
                        ).appendTo('#serviceTable');
                    });
                    $(".serviceDeleteBtn").click(function (event) {
                        var deleteId;
                        event.preventDefault();
                        deleteId = $(this).attr('data-id');

                        $("#serviceDeleteDataId").attr('data-id', deleteId);
                        $("#serviceDeleteModal").modal('show');
                    });


                    $(".serviceEditBtn").click(function () {

                        var editId = $(this).data('id');

                        serviceUpdateDetails(editId);
                        $("#serviceEditModal").modal('show');

                    });

                }
                else {
                    $("loaderDiv").addClass("d-none");
                    $("wrongDiv").removeClass("d-none");
                }
            })
            .catch(error => {
                $("wrongDiv").removeClass("d-none");
            });
    });
}






/* Add New Service */


$(document).ready(function () {
    $("#addService").click(function (event) {
        event.preventDefault();
        $("#serviceAddModal").modal('show');
    })
});

$("#serviceConfirmAdd").click(function () {
    var name = $("#serviceNameAdd").val();
    var desc = $("#serviceDescriptionAdd").val();
    var image = $("#serviceImageUrlAdd").val();
    serviceAddNew(name,desc,image);
});

function serviceAddNew(name,desc,image)
{
    if (name.length == 0) {
        toastr.error("Service Name Empty");
    }
    else if (desc.length == 0) {
        toastr.error("Service Description Empty");
    }
    else if (image.length == 0) {
        toastr.error("Image Url Empty");
    }
    else {
        $("#serviceConfirmAdd").html('<div class="spinner-border" role="status"></div>');
        axios.post('/serviceAdd', {
            name: name,
            desc: desc,
            image: image
        }).then(function (response) {
            toastr.success("Data Successfuly added");
            $("#serviceAddModal").modal('hide');
            $("#serviceNameAdd").val("");
            $("#serviceDescriptionAdd").val("");
            $("#serviceImageUrlAdd").val("");
            $("#serviceConfirmAdd").html('save');
            getServicesData();
        }).catch(function (error) {
            $("#serviceAddModal").modal('hide');
            toastr.error("Something Went wrong!");
        });
    }
}










/* EDIT */

function serviceUpdateDetails(editId) {
    axios.post('/serviceDetails', { id: editId })
        .then(function (response) {
            var jsonData = response.data;
            $("#serviceName").val(jsonData.name);
            $("#serviceDescription").val(jsonData.description);
            $("#serviceImageUrl").val(jsonData.image);
            $("#serviceEditDataId").val(jsonData.id);
        })
        .catch(function (error) {
            toastr.error("something went wrong!");
        });
}

$("#serviceConfirmEdit").click(function (event) {
    event.preventDefault();
    serviceUpdated($("#serviceEditDataId").val(), $("#serviceName").val(), $("#serviceDescription").val(), $("#serviceImageUrl").val());
})

function serviceUpdated(editId, serviceName, serviceDesc, serviceImg) {
    if (serviceName.length < 5) {
        toastr.info("Service name more than 100 characters!");
    }
    else if (serviceDesc.length < 10) {

        toastr.info("Description more than 10 characters!");
    }
    else if (serviceImg.length < 5) {

    }
    else {
        $("#serviceConfirmEdit").html('<div class="spinner-border" role="status"></div>');
        axios.post('/serviceEdit', {
            id: editId,
            name: serviceName,
            desc: serviceDesc,
            image: serviceImg,
        })
            .then(function (response) {
                if (response.data.status == 200) {
                    toastr.success(response.data.message);
                    $("#serviceConfirmEdit").html('save');
                    $("#serviceEditModal").modal('hide');
                    getServicesData();
                }
                else {
                    toastr.error(response.data.message);
                }
            })
    }
}




function serviceEdit(serviceId, serviceName, serviceDesc, serviceImg) {
    $(document).ready(function () {

        axios.post('/serviceEdit', {
            name: serviceName,
            description: serviceDesc,
            image: serviceImg,
            id: serviceId
        })
            .then(function (response) {
                if (response.data.status == 200) {
                    $("#serviceEditModal").modal('hide');
                    toastr.info("Description more than 10 characters!");
                    getServicesData();
                }
                else {
                    toastr.error("something went wrong");
                }
            })
            .catch(function (error) {
                toastr.error("something went wrong");
            });
    });
}



/* DELETE */
$(document).ready(function () {
    $("#serviceConfirmDelete").click(function (event) {
        event.preventDefault();
        deleteId = $("#serviceDeleteDataId").attr('data-id');
        //  console.log(" from get  : "+id);
        serviceDataDelete(deleteId);
        $("#serviceDeleteDataId").removeAttr('data-id');
    });
});




function serviceDataDelete(serviceId) {
    $(document).ready(function () {
        $("#serviceConfirmDelete").html('<div class="spinner-border" role="status"></div>');
        axios.post('/serviceDelete', { idd: serviceId })
            .then(response => {
                if (response.data.status == 200) {

                    $("#serviceDeleteModal").modal('hide');
                    toastr.success(response.data.message);
                    $("#serviceConfirmDelete").html('yes');
                    getServicesData();
                }
                else {
                    $("#serviceDeleteModal").modal('hide');
                    toastr.error(response.data.message);
                }
            })
            .catch(error => {
                $("#serviceDeleteModal").modal('hide');
            });
    })

}
    </script>
@endsection()