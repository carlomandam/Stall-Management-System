@extends('layout.app')

@section('title')
{{'Backup and Recovery'}}
@stop


@section('content')
<div>
  <h2>Reset and Backup Files</h2>
  <p>Reset all the data from the workstation and backup important data<br> to safe place (It takes time in resetting and backup files)</p>
  <button class="btn btn-default" style="background-color: lightgray; border: 2px solid black;">Reset & Backup Files</button>
</div>

<div>
  <h2>Recover all deleted Files</h2>
  <p>Recover all files from the database</p>
  <button class="btn btn-default" style="background-color: lightgray; border: 2px solid black;">Recover</button>
</div>
@stop
@section('script')
<script type="text/javascript" src ="js/request.js"></script>

@stop