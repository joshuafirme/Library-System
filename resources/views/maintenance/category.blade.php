@extends('layouts.maintenance-layout')

@section('content')

<div class="container-fluid">
    <div class="page-header">
        <h3 class="mt-2" id="page-title">Category Maintenance</h3>
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
      
              <div class="row">
      
                <div class="col-sm-2 col-md-2 col-lg-10 mb-3">
                  <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addCategoryModal"><span class='fa fa-plus'></span> Add category</button> 
      
                  </div>
      
                <div class="col-lg-12">
        
      
                <div class="card">
                  <div class="card-body"> 
                      
                    @if($category->count() > 0) 
                        <table class="table table-data responsive  table-hover" width="100%">                               
                            <thead>
                            <tr>
                                <th>Category</th>
                                <th>Classification</th>
                                <th style="width: 100px;">Action</th>
                            </tr>
                            </thead>
                            @foreach ($category as $data)
                            <tbody>
                                <td>{{ $data->category }}</td>
                                <td>{{ $data->classification }}</td>
                                <td>
                                    <a class="btn btn-sm" id="btn-edit-category" category-id="{{ $data->id }}" data-toggle="modal" data-target="#editCategoryModal"><i class="fa fa-edit"></i></a>
                                </td>
                            </tbody>
                            @endforeach
                        </table>       
                    @else
                        <div class="alert alert-danger alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <h5><i class="icon fas fa-exclamation-triangle"></i> </h5>No data found
                        </div>  
                    @endif
 
                    </div>
                </div>
                      
                     
                  </div>
              </div>
      
</div>

@extends('layouts.modals.category-modal')
@section('modals')
@endsection

@endsection


