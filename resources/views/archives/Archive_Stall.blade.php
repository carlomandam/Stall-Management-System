@extends('layout.app')

@section('title')
    {{ 'Stall Archive'}}
@stop
@section('content-header')

        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Maintenance</a></li>
            <li class="active">Stall</li>
        </ol>
        @stop

        @section('content')


   
<div class = "box box-primary">
        <div class = "box-body">

            <div class="table-responsive">
              <div  class = "defaultNewButton">
               <a href="{{ url('/Stall') }}" class="btn btn-primary btn-flat" ><span class='fa fa-arrow-left'></span>&nbspBack</a>
              </div>
          
                <table id="prodtbl" class="table table-bordered table-striped" role="grid" >
                    <thead>
                        <tr>
                            <th style="width: 100px;">Stall Code</th>
                            <th style="width: 180px;">Type</th>
                            <th style="width: 280px;">Location</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                        <tr>
                        <td>BLDG-201</td>
                        <td>Cart</td>
                        <td>Floor 2, Building 3</td>
                        <td></td>
                        <td>  <button class="btn btn-primary btn-flat"><span class='fa fa-mail-reply'></span>&nbspReactivate </button></td>

                </table>
            </div>
       </div>
    
    
 </div>
@stop

  @section('script')
  <script type="text/javascript">
   
    </script>
    @stop