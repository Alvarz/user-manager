@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
      <div class="col-md-8 col-md-offset-2 alertas col-xs-12">

      </div>
        <div class="col-xs-12">
            <div class="panel panel-default">
              <div class="panel-heading">
                Property creator
              </div>
              <div class="panel-body">
                  <form id="createProperty" role="form">
                    <div class="form-group">
                      <label for="">title</label>
                      <input type="text" name="title" class="form-control" value="" maxlength="255" required>
                    </div>
                    <div class="form-group">
                      <label for="">Address</label>
                      <input type="text" name="address" class="form-control" value="" maxlength="255" required>
                    </div>
                    <div class="form-group">
                      <label for="">Desccription</label>
                      <textarea name="description" class="form-control" max-length="500" rows="8" cols="40"></textarea>
                    </div>
                    <div class="form-group">
                      <label for="">Town</label>
                      <input type="text" name="town" class="form-control" value="" maxlength="255" required>
                    </div>
                    <div class="form-group">
                      <label for="">County</label>
                      <input type="text" name="county" class="form-control" value="" maxlength="255" required>
                    </div>
                    <div class="form-group">
                      <label for="">Country</label>
                      <input type="text" name="country" class="form-control" value="" maxlength="255" required>
                    </div>

                    <div class="form-group">
                      <label for="">Facilities</label>
                      <select class="form-control" name="facilities[]" multiple required>
                        @foreach($facilities as $facility)
                          <option value="{{$facility->id}}">{{$facility->name}}</option>
                        @endforeach
                      </select>
                    </div>
                    {!! csrf_field() !!}
                    <input type="submit" name="submit" class="btn btn-success" value="Add property">
                  </form>

              </div>
            </div>
        </div>
    </div>
</div>
@endsection
