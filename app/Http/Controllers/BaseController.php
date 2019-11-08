<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use mysql_xdevapi\Session;

abstract class BaseController extends Controller
{
    protected $data = [];
    public function main(){
        $this->checkTitle();


        if (\Arr::get($this->data, 'content') AND ($this->data['content'] instanceof \Illuminate\View\View)) {
            $this->setSections($this->data['content']->renderSections());
        }
        return view('app',$this->data);
    }

    protected function setContent($contnent)
    {
        $this->data['content']= $contnent;
    }
    private function checkTitle()
    {
        if(array_key_exists('bladeTitle',$this->data) && $this->data['bladeTitle']===null)
        {
            $this->setTitle('empty');
        }
    }
    protected function setBackUrl(string $url)
    {
        $this->data['backUrl']= $url;
    }
    protected function setTitle(string $title)
    {
        $this->data['bladeTitle'] = $title;
    }
    protected function setSections($sections)
    {
        $this->data['sections'] = $sections;
    }

    protected function setSuccess(string $title, $props = null)
    {
        $responseData = ['msg'=>$title];
        if(!is_null($props)) {
            $responseData+=$props;
        }
       return response($responseData,200);
    }

    protected function setError($title)
    {
        return response(['msg'=>$title],416);
    }
}
