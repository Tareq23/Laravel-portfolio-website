



function getContactData()
{
    axios.get('/getAllContact').then(function(response){
        if(response.status==200)
        {
            $("#contactDataDiv").removeClass("d-none");
            $("#contactLoaderDiv").addClass('d-none')

            $("#contactDataTable").DataTable().destroy();
            // $("#projectDataTable").DataTable().destroy();
            $("#contactTable").empty();

            let jsonContactData = response.data;
            
            $.each(jsonContactData,function(idx,item){
                $('<tr>').html(
                    '<td>'+ jsonContactData[idx].name +'</td>'+
                    '<td>'+ jsonContactData[idx].message +'</td>'+
                    '<td><a class="contactDetailsBtn" data-id='+ jsonContactData[idx].id +'><i class="far fa-eye"></i></a></td>'+
                    '<td><a class="contactDeleteBtn" data-id='+ jsonContactData[idx].id +'><i class="fas fa-trash-alt"></i></a></td>'
                ).appendTo("#contactTable");
            });

                $(".contactDetailsBtn").click(function(){
                    let contactId = $(this).data('id');
                    contactDetailsShow(contactId);
              
                    
                });

                $(".contactDeleteBtn").click(function(){
                    let contactId = $(this).data('id');
                    // console.log("Delete Id : "+contactId);
                    $("#contactDeleteDataId").val(contactId);
                    $("#contactDeleteModal").modal('show');
                })


        }
    }).catch(function(error){
        $("#contactWrongDiv").removeClass('d-none');
        //$("#contactDataDiv").removeClass("d-none");
        $("#contactLoaderDiv").addClass('d-none')
    })
}


function contactDetailsShow(contactId)
{
    axios.post('/contactDetails',{id:contactId})
        .then(function(response){
           if(response.status==200)
           {
            $("#contactNameDetails").val(response.data.name);
            $("#contactPhoneDetials").val(response.data.phone);
            $("#contactEmailDetials").val(response.data.email);
            $("#contactMessageDetials").val(response.data.message);
            $("#contactDetailsModal").modal('show');
           }
           else{

               toastr.error("Data Not Found");
           }
        })
        .catch(function(error){
            toastr.error("somting went wrong");
        })
}

$("#contactConfirmDelete").click(function(){
    let contactId = $("#contactDeleteDataId").val();
    contactDelete(contactId);
})

function contactDelete(contactId)
{
    axios.post('/deleteContact',{id:contactId})
        .then(function(response){
            if(response.data.status==200)
            {
                toastr.success("Delete Success");
                $("#contactDeleteModal").modal('hide');
                getContactData();
            }
            else{
                toastr.error("Data Not Found");
                $("#contactDeleteModal").modal('hide');
            }
        }).catch(function(error){
            toastr.error("Something Went Wrong");
            $("#contactDeleteModal").modal('hide');
        });
}


