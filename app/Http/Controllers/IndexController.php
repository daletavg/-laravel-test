<?php

namespace App\Http\Controllers;

use App\Http\Requests\PhoneBookRequest;
use App\Models\PhoneBook;
use Illuminate\Http\Request;
use mysql_xdevapi\Session;

class IndexController extends BaseController
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $this->setTitle('Контакты');
        $vars['items'] = PhoneBook::paginate(10);
        $this->setContent(view('phone-book.index',$vars));
        return $this->main();
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $this->setTitle('Создание контакта');
        $this->setBackUrl(route('phone-book.index'));
        $this->setContent(view('phone-book.create'));
        return $this->main();
    }

    /**
     * @param PhoneBookRequest $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function store(PhoneBookRequest $request)
    {
        $phone = new PhoneBook();
        $phone->fill($request->all());
        $phone->save();
        return $this->setSuccess('Данные успешно добавлены');
    }

    /**
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(int $id)
    {

        $book = PhoneBook::find($id);
        $this->setTitle('Редактирование контакта');
        $this->setBackUrl(route('phone-book.index'));
        $this->setContent(view('phone-book.edit',['item'=>$book]));
        return $this->main();
    }

    /**
     * @param PhoneBookRequest $request
     * @param int $id
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function update(PhoneBookRequest $request, int $id)
    {
        $book = PhoneBook::find($id);
        $book->update($request->except('_method'));
        return $this->setSuccess('Данные успешно обновлены');
    }

    /**
     * @param int $id
     */
    function destroy(int $id)
    {
        $book = PhoneBook::find($id);
        $book->delete();
        return $this->setSuccess('Запись успешно удалена!');
    }
}
