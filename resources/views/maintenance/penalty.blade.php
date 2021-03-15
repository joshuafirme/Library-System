@extends('layouts.maintenance-layout')

@section('content')

<div class="container-fluid">
    <div class="page-header">
        <h3 class="mt-2" id="page-title">Penalty Maintenance</h3>
                <hr>
            </div>
      
              @if(count($errors)>0)
              <div class="alert alert-danger">
                  <ul>
                      @foreach ($errors->all() as $error)
          
                      <li>{{$error}}</li>
                          
                      @endforeach
                  </ul>
              </div>
              @endif
          
      
              <div class="row">
      
                  <div class="col-sm-2 col-md-4 col-lg-4 mt-3">
                      <div class="card">
                      
                          <div class="card-body">
                          @if(\Session::has('success'))
                          <div class="alert alert-success alert-dismissible">
                              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                              <h5><i class="icon fas fa-check"></i> </h5>
                              {{ \Session::get('success') }}
                          </div>
                          @endif
                          <form method="POST" action="{{ action('Maintenance\PenaltyCtr@activate') }}">
                              @csrf
                                  <div class="form-group">
                                  <label>Days</label>
                                  <input type="number" min="1" class="form-control" name="days" value={{ $days }}>
                  
                                  </div> 
                                  
                                  <div class="form-group">
                                  <label>Penalty per day</label>
                                  <input type="number" step="any" class="form-control" name="penalty" value={{ $penalty }}>
                                  </div>  
                                  <button type="submit" class="btn btn-sm btn-success" id="btn-activate">Activate</button>
                              </form>
                          
                          </div>
                      </div>
                  </div>
                  
              </div>
</div>


@endsection


