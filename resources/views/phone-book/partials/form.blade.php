@include('partials.crud.default-input',['value'=>$item->name??'','title'=>'Имя','name'=>'name','props'=>'required'])
@include('partials.crud.default-input',['value'=>$item->surname??'','title'=>'Фамилия','name'=>'surname','props'=>'required'])
@include('partials.crud.default-input',['value'=>$item->phone??'','title'=>'Телефон','name'=>'phone','props'=>'required type="tel" placeholder="(098)-000-0000"'])
@include('partials.crud.default-input',['value'=>$item->email??'','title'=>'Email','name'=>'email','props'=>'type="email"'])

@include('partials.crud.save-save-close')

