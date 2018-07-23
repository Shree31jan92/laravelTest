$( document ).ready(function() {
    
});

function editPost(id){
	$('#editPostForm').attr('action','/posts/'+id);
	$.ajax({
		url: "/posts/"+ id,
		type:'get',
		dataType:'json', 
		success: function(result){
        console.log(result);
        $('#editname').val(result.data.title);
        $('#editcontent').val(result.data.content);
	    }
	});
}

function viewPost(id){
	$.ajax({
		url: "/posts/"+ id,
		type:'get',
		dataType:'json', 
		success: function(result){
        console.log(result);
        $('#viewTitle').val(result.data.title);
        $('#viewContent').val(result.data.content);
	    }
	});
}

function deletePost(id){
	$('#deletePostForm').attr('action','/posts/'+id);
}

$('#my-model').on('shown.bs.modal', function (e) {
  // do something here...
})

$('#my-model').on('hidden.bs.modal', function() {
    // do something here...
});