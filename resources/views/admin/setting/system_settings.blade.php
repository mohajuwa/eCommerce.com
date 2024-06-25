@extends('admin.layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fuild">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1> System Setting </h1>
                </div>

            </div>
        </div>
    </section>
    @include('admin.layouts._message')

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card   card-info">
                        <div class="card-header">
                            <h3 class="card-title"> System Setting</h3>
                        </div>

                        

                        <form action="" method="POST" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="card-body">
                                <div class="form-group">
                                    <label> Website Name <span style="color:red;">*</span></label>
                                    <input type="text" class="form-control"
                                        value="{{ old('website_name', $getRecord->website_name) }}" name='website_name'
                                        placeholder="Enter Website Name">
                                    <div style="color:red">{{ $errors->first('website_name') }}</div>
                                </div>

                                <div class="form-group">
                                    <label> Logo <span style="color:red;">*</span></label>
                                    <input type="file" class="form-control" name='logo'>
                                    <div style="color:red">{{ $errors->first('logo') }}</div>
                                    @if (!empty($getRecord->getLogo()))
                                        <img src="{{ $getRecord->getLogo() }}" style="width:200px;">
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label> Fevicon <span style="color:red;">*</span></label>
                                    <input type="file" class="form-control" name='fevicon'>
                                    <div style="color:red">{{ $errors->first('fevicon') }}</div>
                                    @if (!empty($getRecord->getFevIcon()))
                                        <img src="{{ $getRecord->getFevIcon() }}" style="width:50px;">
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label> Footer Pyement Icon <span style="color:red;">*</span></label>
                                    <input type="file" class="form-control" name='footer_payment_icon'>
                                    <div style="color:red">{{ $errors->first('footer_payment_icon') }}</div>
                                    @if (!empty($getRecord->getFooterPaymenIcon()))
                                        <img src="{{ $getRecord->getFooterPaymenIcon() }}" style="width:200px;">
                                    @endif
                                </div>



                                <div class="form-group">
                                    <label> Address <span style="color:red;">*</span></label>
                                    <textarea type="text" class="form-control"name='address'>{{ old('address', $getRecord->address) }}</textarea>
                                    <div style="color:red">{{ $errors->first('address') }}</div>
                                </div>
                                <div class="form-group">
                                    <label>Phone <span style="color:red;">*</span></label>
                                    <input type="text" class="form-control"
                                        value="{{ old('phone', $getRecord->phone) }}" name='phone'
                                        placeholder="Enter Phone">
                                    <div style="color:red">{{ $errors->first('phone') }}</div>
                                </div>
                                <div class="form-group">
                                    <label>Phone 2 <span style="color:red;">*</span></label>
                                    <input type="text" class="form-control"
                                        value="{{ old('phone_two', $getRecord->phone_two) }}" name='phone_two'
                                        placeholder="Enter Phone 2">
                                    <div style="color:red">{{ $errors->first('phone_two') }}</div>
                                </div>
                                <div class="form-group">
                                    <label>Submit Contact Email <span style="color:red;">*</span></label>
                                    <input type="text" class="form-control"
                                        value="{{ old('submit_email', $getRecord->submit_email) }}" name='submit_email'
                                        placeholder="Enter Submit Contact Email Address">
                                    <div style="color:red">{{ $errors->first('submit_email') }}</div>
                                </div>
                                <div class="form-group">
                                    <label>Email <span style="color:red;">*</span></label>
                                    <input type="text" class="form-control"
                                        value="{{ old('email', $getRecord->email) }}" name='email'
                                        placeholder="Enter Email Address">
                                    <div style="color:red">{{ $errors->first('email') }}</div>
                                </div>
                                <div class="form-group">
                                    <label>Email 2 <span style="color:red;">*</span></label>
                                    <input type="text" class="form-control"
                                        value="{{ old('email_two', $getRecord->email_two) }}" name='email_two'
                                        placeholder="Enter Email Address 2">
                                    <div style="color:red">{{ $errors->first('email_two') }}</div>
                                </div>
                                <div class="form-group">
                                    <label>Working Hours <span style="color:red;">*</span></label>
                                    <textarea type="text" class="form-control" name='working_hours'>{{ old('working_hours', $getRecord->working_hours) }}</textarea>
                                    <div style="color:red">{{ $errors->first('working_hours') }}</div>
                                </div>

                                <hr>

                                <div class="form-group">
                                    <label>Facebook Link <span style="color:red;">*</span></label>
                                    <input type="text" class="form-control"
                                        value="{{ old('facebook_link', $getRecord->facebook_link) }}"
                                        name='facebook_link' placeholder="Enter Facebook Link">
                                    <div style="color:red">{{ $errors->first('facebook_link') }}</div>
                                </div>
                                <div class="form-group">
                                    <label>Twitter(X) Link <span style="color:red;">*</span></label>
                                    <input type="text" class="form-control"
                                        value="{{ old('twitter_link', $getRecord->twitter_link) }}" name='twitter_link'
                                        placeholder="Enter Twitter(X) Link">
                                    <div style="color:red">{{ $errors->first('twitter_link') }}</div>
                                </div>
                                <div class="form-group">
                                    <label>Instagram Link <span style="color:red;">*</span></label>
                                    <input type="text" class="form-control"
                                        value="{{ old('instagram_link', $getRecord->instagram_link) }}"
                                        name='instagram_link' placeholder="Enter Instagram Link">
                                    <div style="color:red">{{ $errors->first('instagram_link') }}</div>
                                </div>
                                <div class="form-group">
                                    <label>Youtube Link <span style="color:red;">*</span></label>
                                    <input type="text" class="form-control"
                                        value="{{ old('youtube_link', $getRecord->youtube_link) }}" name='youtube_link'
                                        placeholder="Enter Youtube Link">
                                    <div style="color:red">{{ $errors->first('youtube_link') }}</div>
                                </div>
                                <div class="form-group">
                                    <label>Paintrest Link <span style="color:red;">*</span></label>
                                    <input type="text" class="form-control"
                                        value="{{ old('paintrest_link', $getRecord->paintrest_link) }}"
                                        name='paintrest_link' placeholder="Enter Paintrest Link">
                                    <div style="color:red">{{ $errors->first('paintrest_link') }}</div>
                                </div>

                                <div class="form-group">
                                    <label> Footer Description <span style="color:red;">*</span></label>

                                    <textarea class="form-control editor" name="footer_description">{{ old('footer_description', $getRecord->footer_description) }}</textarea>

                                    <div style="color:red">{{ $errors->first('footer_description') }}</div>
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-info">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('script')
@endsection
