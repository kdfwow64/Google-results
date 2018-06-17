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
                    <div class="row">
                        <div class="col-md-5">
                            <form action="{{url("blacklist/insertD")}}"  method="post">
                                <div class="row" id="blacklist_insert_div1">
                                    <input type="input" class="form-control input-box" id="blacklist_domain" style="border: solid 1px;" placeholder="Please input domain..." name="blacklist_domain">
                                    <button type="submit" id="blacklist_insert_btn1" class="btn btn-warning" style="margin-left: 10px;">Insert</button>
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
                                            @if($row->domainORemail == 1)
                                            <tr>
                                                <td>{{++$domain_count}}</td>
                                                <td>{{$row->domain}}</td>
                                                <td style="width: 10%;"><a href="{{ url('blacklist/delete/'.$row->id) }}"><i class="fa fa-trash del" style="font-size: 20px;"></i></a></td>
                                            </tr>
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-md-2">
                        </div>
                        <div class="col-md-5">
                            <form action="{{url("blacklist/insertE")}}"  method="post">
                                <div class="row" id="blacklist_insert_div2">
                                    <input type="input" class="form-control input-box" id="blacklist_email" style="border: solid 1px;" placeholder="Please input email..." name="blacklist_email">
                                    <button type="submit" id="blacklist_insert_btn2" class="btn btn-warning" style="margin-left: 10px;">Insert</button>
                                </div>
                                {{csrf_field()}}
                            </form>

                            <div class="row" id="blacklist_show_div">
                                <table id="blacklist_table" class="table table-striped">
                                    <thead>
                                        <tr>
                                            <td style="width: 10%;">No</td>
                                            <td>Email</td>
                                            <td style="width: 10%;"><i class="fa fa-trash" style="font-size: 20px;"></i></td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($blacklist as $key => $row)
                                            @if($row->domainORemail == 2)
                                            <tr>
                                                <td>{{++$email_count}}</td>
                                                <td>{{$row->domain}}</td>
                                                <td style="width: 10%;"><a href="{{ url('blacklist/delete/'.$row->id) }}"><i class="fa fa-trash del" style="font-size: 20px;"></i></a></td>
                                            </tr>
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection