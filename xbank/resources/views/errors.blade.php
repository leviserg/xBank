@if(count($errors->all())>0)
	<div class="alert alert-danger">
		<strong>Error existing</strong>
		<ul>
		@foreach($errors->all() as $error)
			<li>{{$error}}</li>
		@endforeach
		</ul>
	</div>
@endif