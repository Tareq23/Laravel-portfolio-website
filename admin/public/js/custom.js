
function getCoursesData() {
    // console.log("getCourseData");
    $(document).ready(function () {
        axios.get('/allCourse')
            .then(function (response) {
                if (response.status == 200) {
                    // $("#courseDataTable").DataTable().destroy();
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
                    $(".courseDetailsBtn").click(function () {
                        let courseId = $(this).data('id');
                        courseDetails(courseId);
                    });
                    
                    $(".courseDeleteBtn").click(function () {
                        let courseId = $(this).data('id');
                        // $("#courseDeleteDataId").attr('data-id',courseId);
                        $("#courseDeleteDataId").val(courseId);
                        $("#courseDeleteModal").modal('show');
                        // courseDelete(courseId);
                    })
                    $(".courseUpdateBtn").click(function () {
                        let courseId = $(this).data('id');
                        //$("#courseUpdateDataId").attr('data-id',courseId);
                        $("#courseUpdateDataId").val(courseId);
                        courseUpdateShow(courseId)
                        // courseDelete(courseId);
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
    // console.log(courseId);
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
    
    // $("#courseConfirmAddCancel").click(function () {
    //     $("#courseNameAdd").val("");
    //     $("#courseClassAdd").val("");
    //     $("#courseEnrollAdd").val("");
    //     $("#courseFeeAdd").val("");
    //     $("#courseLinkAdd").val("");
    //     $("#courseImageAdd").val("");
    //     $("#courseDescAdd").val("");
    
    // });
    
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
    // console.log(courseId);
    axios.post('/courseDtails', { id: courseId })
        .then(function (response) {
            if (response.status == 200) {
                // $("#courseDetailsModal").modal('show');
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
    console.log("courseUpdateId : "+courseId+"\ncourseUpdateName : "+courseName);

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
        // $("#courseDeleteDataId").removeAttr('data-id');
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
