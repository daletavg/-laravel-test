<table class="table">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">Имя</th>
        <th scope="col">Фамилия</th>
        <th scope="col">Телефон</th>
        <th scope="col">Email</th>
        <th><a class="btn btn-primary" href="{{route('phone-book.create')}}" style="color: white">Создать</a></th>
    </tr>
    </thead>
    <tbody>
    @foreach($items as $item)
        <tr class="contact-row">
            <th scope="row">{{$loop->iteration}}</th>
            <td>{{$item->name??''}}</td>
            <td>{{$item->surname??''}}</td>
            <td>{{$item->phone??''}}</td>
            <td>{{$item->email??''}}</td>
            <td>
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
