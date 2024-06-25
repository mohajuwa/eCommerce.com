@extends('layout.app')
@section('title', '{{ $meta_title }}')

@section('content')
    <main class="main">
        <nav aria-label="breadcrumb" class="breadcrumb-nav border-0 mb-0">
            <div class="container">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page"> {{ $getPage->title }}
                    </li>
                </ol>
            </div>
        </nav>
        <div class="container">
            <div class="page-header page-header-big text-center"
                style="background-image: url('{{ $getPage->getImage() }}')">
                <h1 class="page-title text-white">{{ $getPage->name }}<span class="text-white">{{ $getPage->title }}</span>
                </h1>
            </div>
        </div>

        <div class="page-content pb-0">
            <div class="container">

                <div class="row">
                    <div class="col-lg-6 mb-2 mb-lg-0">
                        {!! $getPage->description !!}
                        <div class="row">

                            <div class="col-sm-7">
                                <div class="contact-info">

                                    <ul class="contact-list">
                                        @if (!empty($getSystemSettingApp->address))
                                            <li>
                                                <i class="icon-map-marker"></i>
                                                {{ $getSystemSettingApp->address }}
                                            </li>
                                        @endif
                                        @if (!empty($getSystemSettingApp->phone))
                                            <li>
                                                <i class="icon-phone"></i>
                                                <a
                                                    href="tel:{{ $getSystemSettingApp->phone }}">{{ $getSystemSettingApp->phone }}</a>
                                            </li>
                                        @endif
                                        @if (!empty($getSystemSettingApp->phone_two))
                                            <li>
                                                <i class="icon-phone"></i>
                                                <a
                                                    href="tel:{{ $getSystemSettingApp->phone_two }}">{{ $getSystemSettingApp->phone_two }}</a>
                                            </li>
                                        @endif
                                        @if (!empty($getSystemSettingApp->submit_email))
                                            <li>
                                                <i class="icon-envelope"></i>
                                                <a
                                                    href="mailto:{{ $getSystemSettingApp->submit_email }}">{{ $getSystemSettingApp->submit_email }}</a>
                                            </li>
                                        @endif
                                        @if (!empty($getSystemSettingApp->email))
                                            <li>
                                                <i class="icon-envelope"></i>
                                                <a
                                                    href="mailto:{{ $getSystemSettingApp->email }}">{{ $getSystemSettingApp->email }}</a>
                                            </li>
                                        @endif
                                        {{-- @if (!empty($getSystemSettingApp->email_two))
                                                <li>
                                                    <i class="icon-envelope"></i>
                                                    <a
                                                        href="mailto:{{ $getSystemSettingApp->email_two }}">{{ $getSystemSettingApp->email_two }}</a>
                                                </li>
                                            @endif --}}

                                    </ul>
                                </div>
                            </div>

                            <div class="col-sm-5">
                                <div class="contact-info">

                                    <ul class="contact-list">
                                        @if (!empty($getSystemSettingApp->working_hours))
                                            <li>
                                                <i class="icon-clock-o"></i>
                                                {{ $getSystemSettingApp->working_hours }}
                                            </li>
                                        @endif
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6">

                        <h2 class="title mb-1">Got Any Questions?</h2>
                        <p class="mb-2">Use the form below to get in touch with the sales team</p>
                        <div style="padding-top: 10px;padding-bottom:10px">
                            @include('layout._message')

                        </div>
                        <form action="" class="contact-form mb-3" method="POST">
                            {{ csrf_field() }}


                            <div class="row">
                                <div class="col-sm-6">
                                    <label for="cname" class="sr-only">Name</label>
                                    <input type="text" class="form-control" value="{{ old('name') }}" name="name"
                                        id="cname" placeholder="Name *" required>
                                </div>

                                <div class="col-sm-6">
                                    <label for="cemail" class="sr-only">Email</label>
                                    <input type="email" class="form-control" value="{{ old('email') }}" name="email"
                                        id="cemail" placeholder="Email *" required>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-6">
                                    <label for="cphone" class="sr-only">Phone</label>
                                    <input type="tel" class="form-control" value="{{ old('phone') }}" name="phone"
                                        id="cphone" placeholder="Phone">
                                </div>

                                <div class="col-sm-6">
                                    <label for="csubject" class="sr-only">Subject</label>
                                    <input type="text" class="form-control" value="{{ old('subject') }}" name="subject"
                                        id="csubject" placeholder="Subject">
                                </div>
                            </div>

                            <label for="cmessage" class="sr-only">Message</label>
                            <textarea class="form-control" cols="30" rows="4" value="{{ old('message') }}" name="message" id="cmessage"
                                required placeholder="Message *"></textarea>

                            <div class="row">
                                <div class="col-sm-12">
                                    <label for="verfication">{{ $first_number }} + {{ $second_number }} = ?</label>
                                    <input type="text" class="form-control" value="{{ old('verfication') }}"
                                        name="verfication" placeholder="Verfication Sum">
                                </div>
                            </div>
                            <button type="submit" class="btn btn-outline-primary-2 btn-minwidth-sm">
                                <span>SUBMIT</span>
                                <i class="icon-long-arrow-right"></i>
                            </button>
                        </form>
                    </div>
                </div>

                <hr class="mt-4 mb-5">


            </div>
            {{-- <div value="{{old('ap')}}" name="ap" id="map"></div> --}}
        </div>
    </main>
@endsection
