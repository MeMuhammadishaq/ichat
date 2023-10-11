@extends('main')
@section('contant')
<form action="">
<div class="mb-3">
  <label for="" class="form-label">old password</label>
  <input type="password"
    class="form-control" name="old-password" id="" aria-describedby="helpId" placeholder="">
</div>
<div class="mb-3">
    <label for="" class="form-label">new passsword</label>
    <input type="password"
      class="form-control" name="password" id="" aria-describedby="helpId" placeholder="">
  </div>
  <div class="mb-3">
    <label for="" class="form-label">confirm password</label>
    <input type="password"
      class="form-control" name="confirm-password" id="" aria-describedby="helpId" placeholder="">
  </div>
  <button type="submit" class="btn btn-primary">change</button>
</form>
@endsection