var longtime = 1000;
$(document).ready(function() {
	blockui();
//	blockui_always(); for test
});

function logout() {

	$.ajax({
		type : 'POST',
		url : contextPath + '/api/Authen/Logout',
		dataType : 'json',
		beforeSend : function() {

		},
		success : function(data) {
			window.location = contextPath + '/index.jsp';
		},
		error : function(data) {
			window.location = contextPath + '/index.jsp';
		}

	});
}



function changepassword() {
	
	var jsonData = $("#form-action").serialize()

	$.ajax({
		type : 'POST',
		url : contextPath + '/api/Authen/passDefault',
		data : jsonData,
		dataType : 'json',
		beforeSend : function() {
			
			blockui_always();
			
		},
		success : function(data) {

			
			notify_Password(data);
			if(isSuccess(data)){
				window.location = contextPath + '/module/dashboard/index.jsp';
			}

			unblockui();
		},
		error : function(data) {
			console.log(data);
		}

	});
}

function notify_Password(data) {
	if (data != '') {
		$('[data-switch=true]').bootstrapSwitch();
		data = convertString2Json(data);
		var content = {};
		var color = "";
		content.title = Bundles['txt.script.noti.title'];
		if (data.statusCode != "0")  {
			 content.message = data.statusDesc;
		     content.icon = 'icon ' + 'la la-times-circle';
			 color = 'danger';
			 var notify = $.notify(content, { 
			        type: color,
			        allow_dismiss: true,
			        newest_on_top: false,
			        mouse_over:  true,
			        showProgressbar:  false,
			        spacing: 10,                    
			        timer: 2000,
			        placement: {
			            from: 'top', 
			            align: 'center'
			        },
			        offset: {
			            x: 30, 
			            y: 30
			        },
			        delay: 100,
			        z_index: 10000,
			        animate: {
			            enter: 'animated ' + 'rubberBand',
			            exit: 'animated ' + 'flash'
			        }
			    });
		}
	   
		
	} else {
		console.log("Response is null");
	}
}



function blockui_always() {

    mApp.blockPage({
        overlayColor: '#000000',
        type: 'loader',
        state: 'success',
        message: 'Please wait...'
    });
}

function blockui() {

        mApp.blockPage({
            overlayColor: '#000000',
            type: 'loader',
            state: 'success',
            message: 'Please wait...'
        });

        setTimeout(function() {
            mApp.unblockPage();
        }, longtime);

}

function unblockui() {

	 setTimeout(function() {
         mApp.unblockPage();
     }, longtime);

}

function convertString2Json(data){
	if(typeof data == "string"){
		return JSON.parse(data);
	}else{
		return data;
	}
}

function isSuccess(data) {
	if (data != '') {
		data = convertString2Json(data);
		if (data.statusCode == "0") {
			return true;
		} 
	} 
	return false;
}
