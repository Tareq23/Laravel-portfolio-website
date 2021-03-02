@extends('layout.app')


@section('title','Admin | Image Gallery')


@section('content')

<div id="galleryDataDiv" class="container">
        <button class="btn btn-primary m-0 mt-5 mb-3" id="addGallery">Add New gallery</button>
        <div class="row" id="galleryImg">
            <!-- <div class="col-md-12 p-5">
                
                <img class="galleryImg" src="http://127.0.0.1:8000/storage/O0hFDvNUvuR51ILWvfOn7VVWdHpv8DT3tz13vsaq.jpg" alt=" " />

            </div> -->
        </div>
        <button id="loadMoreImg" class="btn btn-primary mt-5  ml-0">Load More</button>
    </div>
    <div id="galleryLoaderDiv" class="container">
        <div class="row">
            <div class="col-md-12 text-center p-5">
                
                <img  src="{{asset('images/loader.svg')}}">

            </div>
        </div>
    </div>
    <div id="galleryWrongDiv" class="container d-none">
        <div class="row">
            <div class="col-md-12 text-center p-5">
                
               <h3>Something went wrong</h3>

            </div>
        </div>
    </div>



<div class="modal fade" id="galleryAddModal" class="" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body text-center mt-3">
        <h5>Add New Photo</h5>
        <input id="imgInput" class="form-control" type="file" />
        <img id="imgPreview" class="previewImg" src="{{asset('images/default-cover-user.png')}}" alt=" " />
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button id="galleryConfirmAdd" type="button" class="btn btn-danger">Save</button>
      </div>
    </div>
  </div>
</div>




@endsection()


@section('script')
    <script type="text/javascript">

        axios.get('/imageJson')
            .then(function(response){
                if(response.status==200)
                {   
                    let imgJsonUrl = response.data;
                    // console.log(imgJsonUrl[0].url);
                    $.each(imgJsonUrl,function(idx,item){
                        $('<div class="col-md-2 p-1"> style="max-height:250px;"').html(
                            '<img data-id='+ imgJsonUrl[idx].id +' class="galleryImg" src="'+ item['url'] +'" alt=" " />'
                            + '<button class="btn m-5 btn-sm imgDeleteBtn" data-id='+item['id']+' data-url='+ item['url'] +'>Delete</button>'
                        ).appendTo("#galleryImg")
                    });


                    $(".imgDeleteBtn").on('click',function(event){
                        event.preventDefault();
                        let deleteImgId = $(this).data('id');
                        let deleteImgUrl = $(this).data('url');
                        console.log(deleteImgUrl);
                        deleteImage(deleteImgId,deleteImgUrl);
                    })

                }
            }).catch(function(error){
                console.log("Image jsonUrl error");
            })


        $("#addGallery").on('click',function(){
            $("#galleryAddModal").modal('show');
        })

        $("#imgInput").change(function(){
            let imgFileReader = new FileReader();
            // console.log(imgFileReader);
            imgFileReader.readAsDataURL(this.files[0]);
            imgFileReader.onload = function(event){
                let imgUrl = event.target.result;

                $("#imgPreview").attr('src',imgUrl);

                console.log(imgUrl);
            }
            // console.log(imgFileReader.readAsDataURL(this.files[0]));
        })
        
        $("#galleryConfirmAdd").on('click',function(){
            let imgFile  = $("#imgInput").prop('files')[0];
            let formData = new FormData();
            formData.append('image',imgFile);
            // console.log(formData+"\n"+imgFile);
            axios.post('/uploadImage',formData)
                .then(function(response){
                    console.log(response.data);
                    if(response.status==200)
                    {
                        $("#galleryAddModal").modal('hide');
                        toastr.success("Upload success");
                    }   
                    else{
                        toastr.error("Upload Failed!");
                    }
                })
                .catch(function(response){
                    $("#galleryAddModal").modal('hide');
                    toastr.error("Something went wrong");
                    console.log("get Error");
                })
        })
        let onLoadImgId = 0;
        $("#loadMoreImg").click(function(){
            let imgId = $(this).closest('div').find('img').data('id');

            onLoadImgId += 6;
            imgId += onLoadImgId;
            // alert(imgId);

            axios.post('/onScrollImage',{id:imgId})
                .then(function(response){
                    console.log(response.data);
                    if(response.status==200)
                    {   let imgJsonUrl = response.data;
                        $.each(imgJsonUrl,function(idx,item){
                            $('<div class="col-md-2 p-1"> style="max-height:250px;"').html(
                                '<img data-id='+ imgJsonUrl[idx].id +' class="galleryImg" src="'+ item['url'] +'" alt=" " />'
                                + '<button class="btn btn-sm" data-id='+item['id']+' data-url='+ item['url'] +'>Delete</button>'
                            ).appendTo("#galleryImg")
                        });
                        $(".imgDeleteBtn").on('click',function(event){
                            event.preventDefault();
                            let deleteImgId = $(this).data('id');
                            let deleteImgUrl = $(this).data('url');
                            console.log(deleteImgUrl);
                            deleteImage(deleteImgId,deleteImgUrl);
                        })
                    }
                })
        })
        function deleteImage(imgId,imgUrl)
        {
            let formData = new FormData();
            formData.append('id',imgId);
            formData.append('url',imgUrl);
            axios.post('/deleteImage',formData).then(function(response){
                console.log(response.data);
            }).catch(function(error){
                console.log(error);
            })
        }
    </script>
@endsection()

