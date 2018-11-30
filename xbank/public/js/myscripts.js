$(document).ready(function(){

	$(document).on('blur','#searchId', function(){
		var val = $(this).val();
		var lim = $('#limId').val();
			if(val.length!=0){
				if(lim>0){
					window.location.href = '/search/' + val + '/limit/' + lim;
				}
				else{
					window.location.href = '/search/' + val;
				}
			}
			else{
				window.location.href = '/home';
			}
	});

	$(document).on('change','#limId', function(){
		var val = $('#searchId').val();
		var lim = $(this).val();
			if(val.length!=0){
				if(lim>0){
					window.location.href = '/search/' + val + '/limit/' + lim;
				}
				else{
					window.location.href = '/search/' + val;
				}
			}
			else{
				window.location.href = '/home';
			}
	});

	$(document).on('click','#sortdesc', function(){
		var val = $('#searchId').val();
		var lim = $('#limId').val();
			if(val.length!=0){
				if(lim>0){
					window.location.href = '/search/' + val + '/limit/' + lim + '/desc';
				}
				else{
					window.location.href = '/search/' + val + '/desc';
				}
			}
			else{
				window.location.href = '/home/desc';
			}
	});

	$(document).on('click','#sortasc', function(){
		var val = $('#searchId').val();
		var lim = $('#limId').val();
			if(val.length!=0){
				if(lim>0){
					window.location.href = '/search/' + val + '/limit/' + lim + '/asc';
				}
				else{
					window.location.href = '/search/' + val + '/asc';
				}
			}
			else{
				window.location.href = '/home/asc';
			}
	});


});
