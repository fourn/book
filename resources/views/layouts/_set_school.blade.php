<!--弹窗-->
<aside class="winbg" id="set_school" @if(!session()->has('school_id')) style="display: block;" @endif>
    <div class="winbgclick"></div>
    <div class="schoolcheck">
        <!--<h2>选择您所在的学校</h2>-->
        <p class="box01">
            <input type="submit" value="搜索" class="sub"/>
            <input type="text" value="" list="school_list" id="school_name" placeholder="请输入" class="text"/>
            @if(session('school_id'))
            <span onclick="$(this).parent().parent().parent().fadeOut(200);">取消</span></p>
            @endif
        <div class="clear h11"></div>
        <section id="school_list">
            @foreach($schools as $school)
                <a id="school_{{$school->id}}" href="{{ $school->setSchoolLink() }}" @if(session('school_id') == $school->id) class="sel" @endif >{{ $school->name }}</a>
            @endforeach
        </section>
    </div>
</aside>
@section('script')
    @parent
    <script type="text/javascript">
        function fuzzySearch(e, _this) {
            const that = _this;
            //获取列表的ID
            let listId = _this.attr("list");
            //列表
            let list = $('#' + listId + ' a');
            //列表项数组  包列表项的id、内容、元素
            let listArr = [];
            //遍历列表，将列表信息存入listArr中
            $.each(list, function (index, item) {
                let obj = {'eleId': item.getAttribute('id'), 'eleName': item.innerHTML, 'ele': item};
                listArr.push(obj);
            });

            //current用来记录当前元素的索引值
            let current = 0;
            //showList为列表中和所输入的字符串匹配的项
            let showList = [];
            //为文本框绑定键盘引起事件
            _this.keyup(function (e) {
                //如果输入空格自动删除
                this.value = this.value.replace(' ', '');
                //列表框显示
                $('#' + listId).show();
                if (e.keyCode == 13) {
                    //enter
                    console.log('enter');
                } else {
                    //other
                    console.log('other');
                    //文本框中输入的字符串
                    const searchVal = $(that).val();
                    showList = [];
                    //将和所输入的字符串匹配的项存入showList
                    //将匹配项显示，不匹配项隐藏
                    $.each(listArr, function (index, item) {
                        if (item.eleName.indexOf(searchVal) != -1) {
                            item.ele.style.display = "block";
                            showList.push(item.ele);
                        } else {
                            item.ele.style.display = 'none';
                        }
                    });
                    console.log(showList);
                }
            })
        }
        $('#school_name').on('input propertychange', function (e){
            var _this = $(this);
            fuzzySearch(e, _this);
        });
    </script>
@endsection
