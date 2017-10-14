@extends('layout.app') @section('title') {{ 'Requirements'}} @stop @section('content-header')
<ol class="breadcrumb">
    <li><i class="fa fa-dashboard"></i> Requirements</li>
    <li class="active">Archive</li>
</ol> @stop @section('content')
<style>
    #floortbl td {
        padding-bottom: 5px;
    }
    
    #floortbl th,
    #floortbl td {
        text-align: center;
    }
</style>
<div class="box box-primary">
    <div class="box-body">
        <div class="table-responsive">
            <div class="defaultNewButton">
                <a href="/requirements">
                    <button class="btn btn-primary btn-flat"><span class='fa fa-arrow-left'></span>Back </button>
                </a>
            </div>
            <table id="reqList" class="table table-bordered table-striped" role="grid">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Desc</th>
                        <th style="width: 280px;">Actions</th>
                    </tr>
                </thead>
                <tbody> @foreach($req as $r)
                    <tr>
                        <td>{{$r->reqName}}</td>
                        <td>{{$r->reqDesc}}</td>
                        <td>
                            <div class='btn-group'>
                                <button type='button' class='btn btn-primary btn-flat dropdown-toggle' data-toggle='dropdown'><span class='fa fa-check'></span> Reactivate</button>
                                </button>
                                <ul class='dropdown-menu pull-right opensleft' role='menu'>
                                    <center>
                                        <h4>Are You Sure?</h4>
                                        <li class='divider'></li>
                                        <li><a href='#' data-id="{{$r->reqID}}" id="act">YES</a></li>
                                        <li><a href='#'>NO</a></li>
                                    </center>
                                </ul>
                            </div>
                        </td>
                    </tr> @endforeach </tbody>
            </table>
        </div>
    </div> @stop @section('script')
    <script type="text/javascript" src="{{ URL::asset('js/floor_js.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/requirements.js') }}"></script> @stop