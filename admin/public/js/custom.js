$(document).ready(function () {
    $('#VisitorDt').DataTable();
    $('.dataTables_length').addClass('bs-select');
});





function getServicesData(){
    /* prevent to duplicate Selector data */
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
                        '<td><a href=""><i class="fas fa-edit"></i></a></td>' +
                        '<td><a class="serviceDeleteBtn" data-id=' + jsonData[idx].id + ' data-toggle="modal" ><i class="fas fa-trash-alt"></i></a></td>'
                    ).appendTo('#serviceTable');
                });
                var id;
                $(".serviceDeleteBtn").click(function(event){
                    event.preventDefault();
                    id=$(this).attr('data-id');
                    // console.log(id);
                    $("#serviceDataId").attr('data-id',id);
                    // console.log(""id)
                    $("#serviceDeleteModal").modal('show');
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
}
$("#serviceConfirmDelete").click(function(event){
    event.preventDefault();
    id = $("#serviceDataId").attr('data-id');
    // console.log(" from get  : "+id);
    serviceDataDelete(id);
    $("#serviceDataId").removeAttr('data-id');
});
function serviceDataDelete(serviceId){
    // console.log("from post : "+serviceId);
    
    axios.post('/serviceDelete', { idd: serviceId })
        .then(response => {
            if (response.data.status == 200) {
                
                $("#serviceDeleteModal").modal('hide');
             
                getServicesData();
            }
            else {
                $("#serviceDeleteModal").modal('hide');
                alert(response.data.message);
            }
        })
        .catch(error => {
            $("#serviceDeleteModal").modal('hide');
        });
}




