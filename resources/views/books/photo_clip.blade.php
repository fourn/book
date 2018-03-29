@extends('layouts.app')
@section('css')
<style>
    body {
        margin: 0;
        text-align: center;
    }
    #clipArea {
        height: 7.5rem;
        width: 7.5rem;
    }
    #file {

    }

    .btn_group{
        padding-top: 0.5rem;
        display: inline-block;
    }

    #clipBtn {
        display: block;
        float: left;
        width: 2rem;
        height: 0.6rem;
        line-height: 0.6rem;
        text-align: center;
        border: 0.02rem solid #0cbf9f;
        background: #FFF;
        border-radius: 0.04rem;
    }


    .left_btn{
        display: block;
        margin-right: 0.8rem;
        float: left;
        width: 2rem;
        height: 0.6rem;
        line-height: 0.6rem;
        text-align: center;
        border: 0.02rem solid #0cbf9f;
        background: #FFF;
        border-radius: 0.04rem;
    }
    .left_btn input{
        width: 100%; height: 100%;
        display: block;
        opacity:0;
    }
</style>
@endsection

@section('content')
<div id="clipArea"></div>
<div class="btn_group">

    <label class="left_btn">
        选择
        <input type="file" id="file">
    </label>
    <button id="clipBtn">截取</button>

</div>
@endsection
@section('script')
<script src="{{ asset('js/app.js') }}"></script>
<script>
    var functionName = '{{ Request::query('fn') }}';

    var size = eval('{{ Request::query('size') }}');

    var percent = [];
    percent[0] = (size[0] / (size[0] + size[1])) * 100;
    percent[1] = (size[1] / (size[0] + size[1])) * 100;
    percent[0] = percent[0] + '%';
    percent[1] = percent[1] + '%';
    console.log(size);
    console.log(percent);

    var pc = new PhotoClip('#clipArea', {
        size: size,
//        type: Number|Array
//
//        截取框大小。
//当值为数字时，表示截取框为宽高都等于该值的正方形。
//当值为数组时，数组中索引[0]和[1]所对应的值分别表示宽和高。
//默认值为 [100,100]。
        adaptive: percent,
        // adaptive: percent,

//        type: String|Array
//
//        截取框自适应。设置该选项后，size 选项将会失效，此时 size 进用于计算截取框的宽高比例。
//当值为一个百分数字符串时，表示截取框的宽度百分比。
//当值为数组时，数组中索引 [0] 和 [1] 所对应的值分别表示宽和高的百分比。
//当宽或高有一项值未设置或值无效时，则该项会根据 size 选项中定义的宽高比例自适应。
//默认为 ''。
        outputSize: [0,0],
//        type: Number|Array
//
//        输出图像大小。
//当值为数字时，表示输出宽度，此时高度根据截取框比例自适应。
//当值为数组时，数组中索引 [0] 和 [1] 所对应的值分别表示宽和高，若宽或高有一项值无效，则会根据另一项等比自适应。
//默认值为[0,0]，表示输出图像原始大小。
        outputQuality: 1,
//        type: Number
//
//        图片输出质量，仅对 jpeg 格式的图片有效，取值 0 - 1，默认为0.8。
//    （这个质量并不是图片的最终质量，而是在经过 lrz 插件压缩后的基础上输出的质量。相当于 outputQuality * lrzOption.quality）

        file: '#file',
//        view: '#view',
        ok: '#clipBtn',
        //img: 'img/mm.jpg',
        loadStart: function() {
            //console.log('开始读取照片');
        },
        loadComplete: function() {
            // msg('图片载入完成');
        },
        done: function(dataURL) {
            //console.log(dataURL);
            eval("window.parent."+functionName+"(dataURL)");
            var index = parent.layer.getFrameIndex(window.name); //先得到当前iframe层的索引
            parent.layer.close(index); //再执行关闭
        },
        fail: function(msg) {
            alert(msg);
        }
    });



</script>
@endsection
