@extends('layout.app') @section('title') {{ 'Holiday'}} @stop @section('content-header')
<ol class="breadcrumb">
    <li><i class="fa fa-dashboard"></i> Maintenance</li>
    <li class="active">Holidays</li>
</ol> @stop @section('content')
<style>
    #floortbl td {
        padding-bottom: 5px;
    }
    
    #floortbl th,
    #floortbl td {
        text-align: center;
    }
    .valid-class {
        color: black !important;
    }
</style>
<div class="box box-primary">
    <div class="box-body">
        <div class="table-responsive">
            <div class="defaultNewButton">
                <div class="defaultNewButton"> <a href="{{ url('/Holiday') }}" class="btn btn-primary btn-flat"><span class='fa fa-arrow-left'></span>&nbspBack</a> </div>
            </div>
            <table id="prodtbl" class="table table-responsive table-bordered table-striped" role="grid">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
@stop @section('script')
<script type="text/javascript" src="{{ URL::asset('js/floor_js.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $('#prodtbl').DataTable({
            ajax: '/holidayTableTrashed'
            , responsive: true
            , "columns": [
                {
                    "data": "Name"
                    }
                    , {
                    "data": function (data, type, dataToSet){
                            var month = "";
                            switch(data.Month){
                                case 1: 
                                    month = 'January';
                                    break;
                                case 2: 
                                    month = 'February';
                                    break;
                                case 3: 
                                    month = 'March';
                                    break;
                                case 4: 
                                    month = 'April';
                                    break;
                                case 5: 
                                    month = 'May';
                                    break;
                                case 6: 
                                    month = 'June';
                                    break;
                                case 7: 
                                    month = 'July';
                                    break;
                                case 8: 
                                    month = 'August';
                                    break;
                                case 9: 
                                    month = 'September';
                                    break;
                                case 10: 
                                    month = 'October';
                                    break;
                                case 11: 
                                    month = 'November';
                                    break;
                                case 12: 
                                    month = 'December';
                                    break;
                            }

                            return month+" "+data.Day;
                        }
                    }
                    , {
                    "data": function (data, type, dataToSet) {
                        return "<div class='btn-group'><button type='button' class='btn btn-success btn-flat dropdown-toggle' data-toggle='dropdown'><span class='glyphicon glyphicon-refresh'></span> Restore</button></button><ul class='dropdown-menu pull-right opensleft' role='menu'><center><h4>Are You Sure?</h4><li class='divider'></li><li><a href='#' onclick='restore(" + data.ID + ");return false;'>YES</a></li><li><a href='#' onclick='return false'>NO</a></li></center></ul></div>"
                    }
                    }
            ]
            , "columnDefs": [
                {
                    "searchable": false
                    , "sortable": false
                    , "targets": 2
                    }
            ]
        });
        $(".modal").on('hidden.bs.modal', function () {
            $(this).find('form').validate().resetForm();
            $(this).find('form')[0].reset();
        });
    });

    function restore(id) {
        $.ajax({
            type: "POST"
            , url: '/restoreHoliday'
            , data: {
                "_token": "{{ csrf_token() }}"
                , "id": id
            }
            , success: function (data) {
                $('#prodtbl').DataTable().ajax.reload();
                toastr.success('Holiday Restored');
            }
        });
    }
</script> @stop