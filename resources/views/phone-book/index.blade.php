<table class="table">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">Фото</th>
        <th scope="col">Имя</th>
        <th scope="col">Фамилия</th>
        <th scope="col">Телефон</th>
        <th scope="col">Email</th>
        <th><a class="btn btn-primary" href="{{route('phone-book.create')}}" style="color: white">Создать</a></th>
    </tr>
    </thead>
    <tbody>
    @foreach($items as $item)
        <tr>
            <th  class="align-middle">{!! GetImageAdmin($item->images()->first()->path??'',asset('default.png')) !!}</th>
            <th class="align-middle" scope="row">{{$loop->iteration}}</th>
            <td class="align-middle">{{$item->name??''}}</td>
            <td class="align-middle">{{$item->surname??''}}</td>
            <td class="align-middle">{{$item->phone??''}}</td>
            <td class="align-middle">{{$item->email??''}}</td>
            <td class="align-middle">
                <div class="btn-group">
                    <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                        Действие
                    </button>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="{{route('phone-book.edit',$item)}}">Редактировать</a>
                        <form class="deleteContact" action="{{route('phone-book.destroy',$item)}}">
                            @method('DELETE')
                            <button  class="dropdown-item"
                               type="submit" >Удалить</button>
                        </form>
                    </div>
                </div>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
{{$items->links()}}
