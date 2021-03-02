@extends('layout.app')

@section('title','Admin | Review Page')

@section('content')

<div id="reviewDataDiv" class="container d-none">
        <div class="row">
            <div class="col-md-12 p-5">
                <button class="btn btn-primary m-0 mb-3" id="addReview">Add New review</button>
                <table id="reviewDataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th class="th-sm">Image</th>
                            <th class="th-sm">Name</th>
                            <th class="th-sm">Review Text</th>
                            <th class="th-sm">Edit</th>
                            <th class="th-sm">Delete</th>
                        </tr>
                    </thead>
                    <tbody id="reviewTable">

                        
                        
                    </tbody>
                </table>

            </div>
        </div>
    </div>
    <div id="reviewLoaderDiv" class="container">
        <div class="row">
            <div class="col-md-12 text-center p-5">
                
                <img  src="{{asset('images/loader.svg')}}">

            </div>
        </div>
    </div>
    <div id="reviewWrongDiv" class="container d-none">
        <div class="row">
            <div class="col-md-12 text-center p-5">
                
               <h3>Something went wrong</h3>

            </div>
        </div>
    </div>

@endsection()


<div class="modal fade" id="reviewUpdateModal" class="" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body text-center mt-3">
        <span id="reviewEditDataId"></span>
        <h5>review Update</h5>
        <input class="form-control" placeholder="review name" type="text" id="reviewNameUpdate"/><br/>
        <input class="form-control" placeholder="review sort description" type="text" id="reviewDescriptionUpdate"/><br/>
        <input class="form-control" placeholder="Image Url" type="text" id="reviewImageUrlUpdate"/><br/>
      </div>
      <div class="modal-footer">
        <button id="reviewEditCancel" type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button id="reviewConfirmUpdate" type="button" class="btn btn-danger">Save</button>
      </div>
    </div>
  </div>
</div>



<div class="modal fade" id="reviewDeleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body text-center mt-3">
        <h5>Do you want to delete!</h5>
        <span id="reviewDeleteDataId"></span>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">NO</button>
        <button id="reviewConfirmDelete" type="button" class="btn btn-danger">YES</button>
      </div>
    </div>
  </div>
</div>





<div class="modal fade" id="reviewAddModal" class="" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body text-center mt-3">
        <h5>Add New review</h5>
        <input class="form-control" placeholder="review name" type="text" id="reviewNameAdd"/><br/>
        <input class="form-control" placeholder="review sort description" type="text" id="reviewDescriptionAdd"/><br/>
        <input class="form-control" placeholder="Image Url" type="text" id="reviewImageUrlAdd"/><br/>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button id="reviewConfirmAdd" type="button" class="btn btn-danger">Save</button>
      </div>
    </div>
  </div>
</div>



@section('script')
    <script type="text/javascript">
        getReviewData();



function getReviewData()
{
    axios.get('/getAllReview')
        .then(function(response){
            if(response.status==200)
            {

                $("#reviewDataDiv").removeClass('d-none');
                $("#reviewLoaderDiv").addClass('d-none');

                $("#reviewDataTable").DataTable().destroy();
                $("#reviewTable").empty();

                let jsonReviewData = response.data;
                //console.log(jsonReviewData);

                $.each(jsonReviewData,function(idx,item){
                    ("<tr>").html(
                        '<td><img class="table-img" src="'+ jsonReviewData[idx].image +'" alt="Client Image"/></td>'+
                        '<td>'+ jsonReviewData[idx].name +'</td>'+
                        '<td>'+ jsonReviewData[idx].description +'</td>'+
                        '<td><a class="reviewUpdateBtn" data-id='+ jsonReviewData[idx].id +'><i class="fas fa-edit"></i></a></td>'+
                        '<td><a class="reviewDeleteBtn" data-id='+ jsonReviewData[idx].id +'><i class="fas fa-trash-alt"></i></a></td>'
                    ).appendTo("#reviewTable")$;
                });

                $(".reviewUpdateBtn").click(function(){
                    let reviewId = $(this).data('id');
                    $("#reviewEditDataId").val(reviewId);
                    reviewUpdateShow();
                })

                $(".reviewDeleteBtn").click(function(){
                    let reviewId = $(this).data('id');
                    $("#reviewDeleteDataId").val(reviewId);
                    $("#reviewDeleteModal").modal('show');
                });
            }
            else{
                toastr.error("Something Went Wrong");
            }
        })
        .catch(function(error){

        })
}

function reviewUpdateShow()
{
    let reviewId = $("#reviewEditDataId").val();
    axios.post('/getReviewDetails',{id:reviewId})
        .then(function(response){
            if(response.status==200)
            {
                $("#reviewNameUpdate").val(response.data.name);
                $("#reviewDescriptionUpdate").val(response.data.description);
                $("#reviewImageUrlUpdate").val(response.data.image);
                $("#reviewUpdateModal").modal('show');
            }
            else{
                toastr.error("Data Not Found");
            }
        }).catch(function(response){
            toastr.error("something Went Wrong");
        });
}

$("#reviewConfirmUpdate").click(function(){
    reviewUpdate();
})
function reviewUpdate()
{   let reviewId = $("#reviewEditDataId").val();
    let reviewName = $("#reviewNameUpdate").val();
    let reviewDesc = $("#reviewDescriptionUpdate").val();
    let reviewImg = $("#reviewImageUrlUpdate").val();

    if(reviewName.length==0)
    {
        toastr.error("Name Required");
    }
    else if(reviewDesc.length==0)
    {
        toastr.error("Review Text Required");
    }
    else if(reviewImg.length==0)
    {
        toastr.error("Valid Image Url Required");
    }
    else{
        axios.post('/reviewUpdate',{
            id : reviewId,
            name:reviewName,
            description : reviewDesc,
            image : reviewImg,
        }).then(function(response){
            if(response.data.status==200)
            {
                $("#reviewUpdateModal").modal('hide');
                toastr.success("Update Success");
                getReviewData();
            }
            else{
                toastr.error("something went wrong");
            }
        }).catch(function(response){
            $("#reviewUpdateModal").modal('hide');
            toastr.error("something went Wrong");
        });
    }
}


$("#reviewConfirmDelete").click(function(){
    let reviewId =  $("#reviewDeleteDataId").val();

    axios.post('/deleteReview',{id:reviewId})
        .then(function(response){
            if(response.data.status==200)
            {
                $("#reviewDeleteModal").modal('hide');
                toastr.success("Delete Success");
                getReviewData();
            }
            else{
                $("#reviewDeleteModal").modal('hide');
                toastr.error("Data Not Found");
            }
        }).catch(function(error){
            toastr.error("something went wrong");
        })
})




$("#addReview").click(function(){
    $("#reviewAddModal").modal('show');

    
    
   
});
$("#reviewConfirmAdd").click(function(){
    let reviewName = $("#reviewNameAdd").val();
    let reviewDesc = $("#reviewDescriptionAdd").val();
    let reviewImg =  $("#reviewImageUrlAdd").val();


    if(reviewName.length==0)
    {
        toastr.error("Name Required");
    }
    else if(reviewDesc.length==0)
    {
        toastr.error("Review Text Required");
    }
    else if(reviewImg.length==0)
    {
        toastr.error("Valid Image Url Required");
    }
    else {
        axios.post('/addReview',{
            name:reviewName,
            description:reviewDesc,
            image:reviewImg,
        }).then(function(response){
            if(response.data.status==200)
            {
                toastr.success("Review Add Success");
                $("#reviewAddModal").modal('hide');
                $("#reviewNameAdd").val("");
                $("#reviewDescriptionAdd").val("");
                $("#reviewImageUrlAdd").val("");
                getReviewData();
            }
            else{
                toastr.error("something went wrong");
            }
        })
        .catch(function(error){
            toastr.error("something went wrong");
        })
    }
    
})



    </script>
@endsection()

