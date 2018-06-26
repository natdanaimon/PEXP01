$(document).ready(function() {

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
