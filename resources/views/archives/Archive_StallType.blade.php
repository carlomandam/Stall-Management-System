@extends('layout.app')

@section('title')
    {{ 'Stall Type Archive'}}
<style type="text/css">
</style>
@stop
@section('content-header')

        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Maintenance</a></li>
            <li class="active">Stall Type</li>
        </ol>
        @stop

        @section('content')



<div class = "box box-primary">
        <div class = "box-body">

            <div class="table-responsive">
              <div  class = "defaultNewButton">
               <a href="{{ url('/StallType') }}" class="btn btn-primary btn-flat" ><span class='fa fa-arrow-left'></span>&nbspBack</a>
              </div>
          
                <table id="prodtbl" class="table table-bordered table-striped" role="grid" >
                    <thead>
                        <tr>
                            <th>Stall Type</th>
                            <th>Area</th>
                            <th>Description</th>
                            <th style="width: 280px;">Actions</th>
                        </tr>
                    </thead>
                        <tr>
                        <td>Chuchu</td>
                        <td>ekek</td>
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