@if(Session('success'))
<div class="alert alert-success" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <strong><i class="fa fa-check"></i></strong><span class="po">{{Session('success')}}</span>
</div>
@endif

@if(Session('error'))
<div class="alert alert-danger" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <strong><i class="fa fa-exclamation-circle"></i></strong><span class="po">{{Session('error')}}</span>
</div>
@endif

@if($errors->any())
   @foreach($errors->all() as $error)
   <div class="alert alert-danger" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <strong><i class="fa fa-exclamation-circle"></i></strong><span class="po">{{$error}}</span>
</div>
   @endforeach
@endif