
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












