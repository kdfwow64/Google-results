@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Black List</div>

                <div class="panel-body black-list" style="text-align: center;">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <form action="{{url("blacklist/insert")}}"  method="post">
                        <div class="row" id="blacklist_insert_div">
                            <input type="input" class="form-control input-box" id="blacklist_domain" style="border: solid 1px;" placeholder="Please input domain..." name="blacklist_domain">
                            <button type="submit" id="blacklist_insert_btn" class="btn btn-warning" style="margin-left: 10px;">Insert</button>
                        </div>
                        {{csrf_field()}}
                    </form>

                    <div class="row" id="blacklist_show_div">
                        <table id="blacklist_table" class="table table-striped">
                            <thead>
                                <tr>
                                    <td style="width: 10%;">No</td>
                                    <td>Domain Name</td>
                                    <td style="width: 10%;"><i class="fa fa-trash" style="font-size: 20px;"></i></td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($blacklist as $key => $row)
                                    <tr>
                                        <td>{{$key+1}}</td>
                                        <td>{{$row->domain}}</td>
                                        <td style="width: 10%;"><a href="{{ url('blacklist/delete/'.$row->id) }}"><i class="fa fa-trash del" style="font-size: 20px;"></i></a></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection