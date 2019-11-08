<div class="form-group">
    <label for="exampleInputEmail1">{{$title??''}}</label>
    <input name="{{$name??''}}" value="{{$value??''}}" class="form-control" {!! $props??'' !!} placeholder="{{$title??''}}">
{{--    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>--}}
</div>
