$(document).ready(function () {
    $('#VisitorDt').DataTable();
    $('.dataTables_length').addClass('bs-select');
});


/*

*/


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

/* EDIT */


{/* <div class="spinner-border" role="status">
  
</div> */}



function serviceUpdateDetails(editId) {
    axios.post('/serviceDetails', { id: editId })
        .then(function (response) {
            var jsonData = response.data;
            $("#serviceName").val(jsonData.name);
            $("#serviceDescription").val(jsonData.description);
            $("#serviceImageUrl").val(jsonData.image);
            $("#serviceConfirmEdit").click(function (event) {
                event.preventDefault();
                if (editId != 0) {
                  
                    serviceUpdated(editId, $("#serviceName").val(), $("#serviceDescription").val(), $("#serviceImageUrl").val());
                    $("#serviceEditModal").modal('hide');
                    editId = 0;
                }
            })
        })
        .catch(function (error) {
            $("#serviceEditModal").modal('hide');
        });
}



function serviceUpdated(editId, serviceName, serviceDesc, serviceImg) {
    if (serviceName.length < 5) {
        toastr.info("Service name more than 100 characters!");
    }
    else if (serviceDesc.length < 10) {

        toastr.info("Description more than 100 characters!");
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
                    // console.log(response.data.result);
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


















// var editId;




// function serviceDetails(serviceId) {
//     $(document).ready(function () {

//         $("#serviceEditDataId").html(serviceId);
//         //serviceEdit/{id}
//         var serviceUrl = '/serviceEdit/' + serviceId;
//         axios.get(serviceUrl)
//             .then(function (response) {

//                 // $("#serviceName").attr("value",serviceName);
//                 // console.log(serviceUrl);
//                 if (response.status == 200) {
//                     $("#serviceName").val(response.data['name']);
//                     $("#serviceDescription").val(response.data['description']);
//                     $("#serviceImageUrl").val(response.data['image']);
//                     $("#serviceEditModal").modal('show');

//                     $("#serviceConfirmEdit").click(function (event) {
//                         event.preventDefault();
//                         var serviceName = $("#serviceName").val();
//                         var serviceDescription = $("#serviceDescription").val();
//                         var serviceImage = $("#serviceImageUrl").val();

//                         // console.log(response.data);
//                         console.log("serviceEditDetails: " + response.data);
//                         serviceEdit(serviceId, serviceName, serviceDescription, serviceImage);
//                     });
//                 }

//             })
//             .catch(function (error) {
//                 console.log("error");
//             });
//     });
// }

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
                    getServicesData();
                    console.log(response.data.service);
                    //alert("update success");
                }
                else {
                    alert(response.data.id);
                    // console.log(response.data.image+"dfgfdgdf \n"+response.data.name + "\n" + response.data.desc + "\n" + response.data.id);
                    console.log(response.data.service);
                }
            })
            .catch(function (error) {
                alert(error + " pppppp");
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





