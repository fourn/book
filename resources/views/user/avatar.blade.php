@extends('layouts.app')
@section('body', '')
@section('content')
<header class="comhead">
    <h2>修改头像</h2>
    <a href="{{ route('user.index') }}" class="back"></a>
</header>
<div class="comheadbg"></div>

<form id="head" action="{{ route('user.avatar') }}" method="post" accept-charset="UTF-8" enctype="multipart/form-data" >
    {{csrf_field()}}
<div id="clipArea" style="height: 400px;"></div>
<div class="edittext">
    <input type="file" id="file" name="avatar" />
    <input type="hidden" id="base" name="base" value="">
    {{--<input type="file" value="" class="text" placeholder="请输入" />--}}
</div>

<input type="button" id="clipBtn" class="editbtn" style="margin-top: 0.2rem;" value="确认修改" />
</form>
@endsection

@section('script')
    <script src="{{ asset('js/app.js') }}"></script>
    <script>
        var pc = new PhotoClip('#clipArea', {
            size: [200, 200],
            file:'#file',
            ok:'#clipBtn',
            outputQuality: 1,
            //view: '#clipArea',
            loadComplete: function() {
                //layer.msg('图片载入完成');
            },
            done: function (dataUrl){
                //最终裁剪结果
                //console.log(dataUrl);
                $('#file').val('');
                $('#base').val(dataUrl);
                $('#head').submit();
            }
        });
        file.addEventListener('change', function() {
            pc.load(this.files[0]);
        });
    </script>
@endsection