@extends('layout.app')

@section('title','Admin | Contact Page')


@section('content')

<div id="contactDataDiv" class="container d-none">
        <div class="row">
            <div class="col-md-12 p-5">
                <table id="contactDataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th class="th-sm">Name</th>
                            <th class="th-sm">Message</th>
                            <th class="th-sm">Details</th>
                            <th class="th-sm">Delete</th>
                        </tr>
                    </thead>
                    <tbody id="contactTable">

                        
                        
                    </tbody>
                </table>

            </div>
        </div>
    </div>
    <div id="contactLoaderDiv" class="container">
        <div class="row">
            <div class="col-md-12 text-center p-5">
                
                <img  src="{{asset('images/loader.svg')}}">

            </div>
        </div>
    </div>
    <div id="contactWrongDiv" class="container d-none">
        <div class="row">
            <div class="col-md-12 text-center p-5">
                
               <h3>Something went wrong</h3>

            </div>
        </div>
    </div>



@endsection()





<div class="modal fade" id="contactDetailsModal" class="" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body text-center mt-3">
        <h5>Contact Details</h5>
        <input class="form-control" placeholder="Name" type="text" id="contactNameDetails"/><br/>
        <input class="form-control" placeholder="Phone" type="text" id="contactPhoneDetials"/><br/>
        <input class="form-control" placeholder="Email" type="text" id="contactEmailDetials"/><br/>
        <input class="form-control" placeholder="Email" type="text" id="contactMessageDetials"/><br/>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Okk</button>
        <!-- <button id="projectConfirmAdd" type="button" class="btn btn-danger">Save</button> -->
      </div>
    </div>
  </div>
</div>




<div class="modal fade" id="contactDeleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body text-center mt-3">
        <h5>Do you want to delete!</h5>
        <span id="contactDeleteDataId"></span>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">NO</button>
        <button id="contactConfirmDelete" type="button" class="btn btn-danger">YES</button>
      </div>
    </div>
  </div>
</div>




@section('script')

<script type="text/javascript">
    getContactData();







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





</script>


@endsection()