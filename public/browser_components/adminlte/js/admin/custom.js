
//change user status on user list view
//$(function(){

	/*$(document).on("click", ".changestatus", function(){
		var confirmDelete = confirm("Are you sure you want to change the status!");
		if(confirmDelete){
			let id = $(this).data("value");
			let url = $(this).data("url");
			$.ajax({
				url:baseUrl+"admin/"+url,
				type:"post",
				dataType:"json",
				data:{
					id:id
				},
				success:function(response){
					if(response.result=="success"){
						$("#changestatus_"+id).text(response.status);
					}
				}
			});
		}
	});

    $(document).on("click", ".delete", function(){
        var confirmDelete = confirm("Are you sure you want to delete this!");
        if(confirmDelete){
            let id = $(this).attr("id");
            let url = $(this).data("url");
            //console.log(id);
            //console.log(url);
            $.ajax({
                url:baseUrl+"admin/"+url,
                type:"post",
                dataType:"json",
                data:{
                    id:id
                },
                success:function(response){
                    //console.log(response);
                    if(response.result=="success"){
                        location.reload();
                    }else{
                        alert("Something went wrong please try again later");
                    }
                }
            });
        }
    });
*/
	//get league list  from respect to country
    /*$('select[name="countryId"]').on('change', function() {

    	$("#landmark").empty();   
    	$("#culture").empty(); 
    	$("#shopping").empty();    
    	$("#food").empty(); 
        var countryId = $(this).val();
        if(countryId) {
            $.ajax({
                url: baseUrl+"admin/getPackagePlace",
                type: "post",
                dataType: "json",
                data:{ countryId:countryId },
                success:function(data) {
                	console.log(data);
                	$("#landmark").append(data.landMark);   
                	$("#culture").append(data.culture);   
                	$("#shopping").append(data.shopping);   
                	$("#food").append(data.food);   
                }
            });
        }
    });*/
 
	/*$( "#popupDatepicker" ).datepicker({
		startDate: new Date(),
		format: 'yyyy-mm-dd',
		todayHighlight: true,
	});*/


    /*$('#landmark').select2();
    $('#culture').select2();
    $('#shopping').select2();
    $('#food').select2();*/
    /*$('#ingredient').select2();
    $('#ingredient1').select2();*/


    /*$("#add-ing").bind("click", function () {
    	//console.log('Hello');
        var div = $("<div />");
        div.html(addIng(""));
        $(".ing-box").append(div);
    });

    $("#add-method").bind("click", function () {
    	//console.log('Hello');
        var div = $("<div />");
        div.html(addMethod(""));
        $(".method-box").append(div);
    });


    $("body").on("click", ".remove", function () {
        $(this).parent("div").remove();
    });*/
	  
//});

/*function addIng(value) {
    return '<div class="col-md-12  gap-append no-padding"><div class="col-md-9 no-padding"><input name = "ingredient[]" type="text" class = "form-control" value = "' + value + '" /></div>' +
            '<div class="col-md-3 no-padding remove"><input type="button" value="Remove" class=" btn btn-block btn-primary" /> </div></div>'
}*/


/*function addMethod(value) {
    return '<div class="col-md-12  gap-append no-padding"><div class="col-md-9 no-padding"><input name = "method[]" type="text" class ="form-control" value = "' + value + '" /></div>' + 
            '<div class="col-md-3 no-padding remove"><input type="button" value="Remove" class=" btn btn-block btn-primary" /></div></div>'
}*/

//manage datatables grid
$(document).ready(function() {
    $('#example').DataTable();
} );



    