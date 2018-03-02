@extends('layout')
@section('title',trans('phrases.create_topic'))
@section('css')
<link href="{{ asset('css/views/upload.css') }}" rel="stylesheet" >
@endsection
@section('content')
    <div class="title" style="padding-bottom: 15px;border-bottom: 1px solid #dddddd;margin-bottom: 20px;">
        <h2>@lang('phrases.create_topic')</h2>
    </div>
    @if(!empty($aError))
        @foreach($aError as $value)
            <div class="error" style="padding: 20px;color: white;background-color: #ee5454;margin-bottom: 20px;display: none">
                {{$value['content']}}
            </div>
        @endforeach
    @endif
    @if(!empty($sSuccess))
        <div class="success" style="padding: 20px;color: white;background-color: #67b168;margin-bottom: 20px;display: none">
            {{$sSuccess}}
        </div>
    @endif
    <div class="upload" style="padding-left: 15px;">
        <input type="hidden" id="error" value="{{ !empty($aError) ? 1 : 0 }}">
        <input type="hidden" id="success" value="{{ !empty($sSuccess) ? 1 : 0 }}">
        <form method="POST" action="{{ action('Topic\UploadController@process') }}" enctype="multipart/form-data">
            {!! csrf_field() !!}
            <div style="margin-bottom: 15px;">
                <div><b>@lang('phrases.create_topic_title') </b>:</div>
                <input type="text" name="name" id="name" style="display: block;width: 100%; height: 40px; font-size: 14px;padding: 9px 12px;border: 1px solid #dddddd;outline: none; margin: 10px 0;"  placeholder="Bạn đang bán gì ?" class="check-special-characters">
                <div class="col-md-12 col-sm-12 warning" style="color: #ce1126;padding-left: 0; padding-right: 0; margin-bottom: 10px;display: none;">
                    @lang('phrases.special_character_permission')
                </div>
            </div>
            <div>
                <div><b>@lang('phrases.choose_category')</b> :</div>
                <select id="category" class="form-control" name="category">
                    @if(!empty($aFrontend['aCategories']))
                        @foreach($aFrontend['aCategories'] as $aCategory)
                            <option value="{{ $aCategory['category_id'] }}">{{ $aCategory['title'] }}</option>
                        @endforeach
                    @endif
                </select>
            </div>
            <div>
                <div><b>@lang('phrases.choose_currency')</b> :</div>
                <select id="currency" class="form-control" name="currency">
                    @if(!empty($aFrontend['aCurrencies']))
                        @foreach($aFrontend['aCurrencies'] as $aCurrency)
                        <option value="{{ $aCurrency['currency_id'] }}">{{ $aCurrency['title'] }}</option>
                        @endforeach
                    @endif
                </select>
            </div>
            <div>
                <div><b>@lang('phrases.price') </b>:</div>
                <input type="text" name="price" id="price" class="form-control check-special-characters"  placeholder="@lang('phrases.price')">
                <div class="col-md-12 col-sm-12 warning" style="color: #ce1126;padding-left: 0; padding-right: 0; margin-bottom: 10px;display: none;">
                    @lang('phrases.special_character_permission')
                </div>
            </div>
            <div>
                <div><b>@lang('phrases.product_description') </b>:</div>
                <input type="text" name="description" id="description" class="form-control check-special-characters"  placeholder="@lang('phrases.product_description')">
                <div class="col-md-12 col-sm-12 warning" style="color: #ce1126;padding-left: 0; padding-right: 0; margin-bottom: 10px;display: none;">
                    @lang('phrases.special_character_permission')
                </div>
            </div>
            <div>
                <div><b>@lang('phrases.address') </b>:</div>
                <input type="text" name="address" id="address" class="form-control check-special-characters"  placeholder="@lang('phrases.address')">
                <div class="col-md-12 col-sm-12 warning" style="color: #ce1126;padding-left: 0; padding-right: 0; margin-bottom: 10px;display: none;">
                    @lang('phrases.special_character_permission')
                </div>
            </div>
            <div>
                <div><b>@lang('phrases.phone') </b>:</div>
                <input type="text" name="phone" id="phone" class="form-control check-special-characters"  placeholder="@lang('phrases.phone')">
                <div class="col-md-12 col-sm-12 warning" style="color: #ce1126;padding-left: 0; padding-right: 0; margin-bottom: 10px;display: none;">
                    @lang('phrases.special_character_permission')
                </div>
            </div>
            <div class="attachments">
                <div><b>@lang('phrases.attach_file_title')</b>:</div>
                <div class="attachment-list">
                    <div class="item col-md-12" data-id="1" style="padding-left: 0; padding-right: 0; margin-bottom: 15px;" id="item_1">
                        <div class="input-group image-preview" style="margin-bottom: 15px;position: relative; width: 35%;">
                            <input type="text" class="form-control image-preview-filename" disabled="disabled">
                            <span class="input-group-btn">
                                <button type="button" class="btn btn-default image-preview-button" style="display:none;margin-top: 10px;height: 40px;border-radius: 0">
                                    <span class="glyphicon glyphicon-eye-open" style="top: 2px;"></span> Preview
                                </button>
                                <div class="btn btn-default image-preview-input" style="margin-top: 10px;height: 40px;border-radius: 0">
                                    <span class="glyphicon glyphicon-folder-open" style="padding-top: 5px;"></span>
                                    <span class="image-preview-input-title">Browse</span>
                                    <input type="file" accept="image/*, video/mp4" name="file[]" style="height: 40px"/> <!-- rename it -->
                                </div>
                            </span>
                            <div class="remove-attachment" style="position: absolute;top: 20px;left: 425px;display: none;cursor: pointer;"><i class="fa fa-minus" aria-hidden="true" style="font-size: 22px"></i></div>

                        </div>
                        <div class="col-md-4 preview-file" style="padding-left: 0;height: auto;width: 35%;display: none;padding-top: 10px;padding-right: 0;">
                        </div>
                    </div>
                </div>
            </div>
            <div class="add-attachment-button col-md-12" style="padding-left: 0;cursor: pointer;margin-bottom: 15px;margin-top: 15px;"><i class="fa fa-plus" aria-hidden="true" style="font-size: 18px;"></i></div>
            <div class="col-md-12" style="padding-left: 0;">
                <button class="btn btn-danger" id="submit" value="login">@lang('phrases.create_title')</button>
            </div>
        </form>
    </div>
@endsection
@section('js')
<script src="{{ asset('js/views/upload.js') }}"></script>
@endsection