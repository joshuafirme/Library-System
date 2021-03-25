@extends('layouts.utilities-layout')

@section('content')

<div class="container-fluid">
    <div class="page-header">
        <h3 class="mt-2" id="page-title">Backup and Restore</h3>
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
          
              @if(\Session::has('success'))
              <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fas fa-check"></i> </h5>
                {{ \Session::get('success') }}
              </div>      
              @endif

              @if(\Session::has('danger'))
              <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fas fa-exclamation-triangle"></i> </h5>
                {{ \Session::get('danger') }}
              </div>      
              @endif
      
              <div class="row">
      
                <div class="col-md-12 col-lg-12">
        
      
                <div class="card">
                    <div class="card-body">
                        <form action="{{ action('Utilities\BackupAndRestoreCtr@backup') }}" method="POST" style="margin-bottom: 20px;">
                            @csrf
                            <button class="btn btn-outline-secondary" style="width: 300px; height:80px;" type="submit">Backup</button>
                        </form>

                        <form action="{{ action('Utilities\BackupAndRestoreCtr@restore') }}" method="POST">
                            @csrf
                            <button class="btn btn-outline-secondary" style="width: 300px; height:80px;" type="submit">Restore</button>
                        </form>
      
                    </div>
                </div>
                      
                     
                  </div>
              </div>
      
</div>

@endsection

