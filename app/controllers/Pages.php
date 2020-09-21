<?php

class Pages extends Controller
{
    public function __construct()
    {
    }

    public function index()
    {
        redirect('words/search');
    }

    public function about()
    {
        $data = [
            'title' => SITENAME,
            'description' => '製作一個可以新增、編輯、刪除以及建立標籤的瑞典語單字本。',
        ];
        $this->view('pages/about', $data);
    }
}
