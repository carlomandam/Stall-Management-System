@extends('layout.app') @section('title') {{ 'Dashboard'}} @stop @section('content-header')
@stop @section('content')

<div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">List of Stalls</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="table-responsive">
                <table class="table no-margin">
                  <thead>
                  <tr>
                    <th>Stall Code</th>
                    <th>Stall Type</th>
                    <th>Location</th>
                    <th>Status</th>
                  </tr>
                  </thead>
                </table>
              </div>
              <!-- /.table-responsive -->
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix">
              <a href="javascript:void(0)" class="btn btn-sm btn-primary btn-flat pull-right">Register StallHolder</a>
            </div>
            <!-- /.box-footer -->
          </div>



 @stop
  @section('script')

 @stop 