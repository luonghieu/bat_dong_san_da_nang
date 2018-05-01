@extends('admin.inc.index')
@section('css')
@include('admin.news.css')
@endsection
@section('title')
Profile
@endsection
@section('content')
@if (session('objUser'))
@php      
$objUser = Session::get("objUser");
@endphp
@endif
<div class="pagecontent">
    @if (session('success'))
        <div class="alert alert-danger">
            <p>Update account successfully!</p>
        </div>
        @endif
    <form method="post" action="{!! route('admins.profile.update') !!}" enctype="multipart/form-data">
        <input type="hidden" name="_token" value="{{csrf_token()}}" />
        <div class="row">

            <div class="col-md-3">

                <!-- tile -->
                <section class="tile tile-simple">

                    <!-- tile widget -->
                    <div class="tile-widget p-30 text-center">

                        <div class="thumb thumb-xl">
                            <img class="img-circle" src="{!! asset((empty($objUser->image)) ? '/images/profile.png' : $objUser->image ) !!}" style="width: 100px; height: 100px;" alt="">
                        </div>
                    </div>
                    <div class="tile-body text-center bg-blue p-0">
                        <input type="file" id="avatar" class="filestyle" data-buttonText="Find file" data-iconName="fa fa-inbox" name="image">

                    </div>

                </section>
            </div>
            <div class="col-md-9">

                <section class="tile tile-simple">
                    <div class="tile-body p-0">
                        <div class="tab-content">
                            <div style="padding: 10px;" id="settingsTab">
                                <div class="wrap-reset">
                                    <div class="row">
                                        <div class="form-group col-md-12 legend">
                                            <h4><strong>{!! $objUser->username !!}</strong></h4>
                                        </div>
                                    </div>

                                    <div class="row">

                                        <div class="form-group col-sm-6">
                                            <label>Email</label>
                                            <input type="text" class="form-control" name="email" value="{!! $objUser->email !!}">
                                            @if ($errors->has('email'))
                                            <div class="alert alert-lightred alert-dismissable fade in">
                                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                                <strong>{!! $errors->first('email') !!}</strong>
                                            </div>
                                            @endif
                                        </div>

                                        <div class="form-group col-sm-6">
                                            <label>Password</label>
                                            <input type="password" class="form-control" name="password" placeholder="*******">
                                            @if ($errors->has('password'))
                                            <div class="alert alert-lightred alert-dismissable fade in">
                                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                                <strong>{!! $errors->first('password') !!}</strong>
                                            </div>
                                            @endif
                                        </div>

                                    </div>
                                    @if($objUser->role!=1)
                                    <div class="row">

                                        <div class="form-group col-sm-6">
                                            <label>Fullname</label>
                                            <input type="text" class="form-control" name="name" value="{!! $objUser->employee->name !!}">
                                            @if ($errors->has('name'))
                                            <div class="alert alert-lightred alert-dismissable fade in">
                                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                                <strong>{!! $errors->first('name') !!}</strong>
                                            </div>
                                            @endif
                                        </div>

                                        <div class="form-group col-sm-6">
                                            <label>Phone</label>
                                            <input type="text" class="form-control" name="phone" value="{!! $objUser->employee->phone !!}">
                                            @if ($errors->has('phone'))
                                            <div class="alert alert-lightred alert-dismissable fade in">
                                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                                <strong>{!! $errors->first('phone') !!}</strong>
                                            </div>
                                            @endif
                                        </div>

                                    </div>

                                    <div class="row">

                                        <div class="form-group col-sm-12">
                                            <label>Address</label>
                                            <input type="text" class="form-control" name="address" value="{!! $objUser->employee->address !!}">
                                            @if ($errors->has('address'))
                                            <div class="alert alert-lightred alert-dismissable fade in">
                                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                                <strong>{!! $errors->first('address') !!}</strong>
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                    @endif
                                    <div class="row">
                                        <center><input type="submit" value="Update" class="btn btn-rounded btn-primary btn-sm"></center>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </form>
</div>
</div>
@endsection

@section('script')
@include('admin.news.script')
@endsection