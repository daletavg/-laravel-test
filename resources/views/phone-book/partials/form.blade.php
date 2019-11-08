@include('partials.crud.default-input',['value'=>$item->name??'','title'=>'Имя','name'=>'name','props'=>'required'])
@include('partials.crud.default-input',['value'=>$item->surname??'','title'=>'Фамилия','name'=>'surname','props'=>'required'])
@include('partials.crud.default-input',['value'=>$item->phone??'','title'=>'Телефон','name'=>'phone','props'=>'required type="tel" placeholder="(098)-000-0000"'])
@include('partials.crud.default-input',['value'=>$item->email??'','title'=>'Email','name'=>'email','props'=>'type="email"'])
<div id="contactImage">
    @isset($item)
        @php
            $image = $item->getAttribute('images')->first() ?? null;
        @endphp
        @if(is_null($image))
            <div class="mb-3 d-flex flex-column" id="defaultImage">
                <div class="mb-3">
                    {!! GetImageAdmin('',asset('default.png'))!!}
                </div>
            </div>
        @else
            <div class="mb-3 d-flex flex-column">
                <div class="mb-3">
                    {!! GetImageAdmin($image->path??'','')!!}
                </div>
                <a href="#" data-id="{{$image->id}}" data-edit-id="{{$item->id}}" data-name="imageUploaded"
                   data-url="{{route('phone_book.deleteImage')}}" data-img-delete class="btn btn-danger w-25">Удалить
                    фото</a>
            </div>
        @endif
    @endisset
</div>
<input name="image" id="myImage" type="file" class="form-control">

@include('partials.crud.save-save-close')

