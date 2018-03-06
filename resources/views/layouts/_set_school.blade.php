<!--弹窗-->
<aside class="winbg" id="set_school" @if(!session()->has('school_id')) style="display: block;" @endif>
    <div class="winbgclick"></div>
    <div class="schoolcheck">
        <h2>选择您所在的学校</h2>
        <section>
            @foreach($schools as $school)
                <a href="{{ $school->setSchoolLink() }}" @if(session('school_id') == $school->id) class="sel" @endif >{{ $school->name }}</a>
            @endforeach
        </section>
    </div>
</aside>
