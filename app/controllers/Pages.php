<?php

class Pages extends Controller
{
    public function __construct()
    {
    }

    public function index()
    {
        if(isset($_SESSION['user_id'])) redirect('vocabularies/index');
        redirect('users/login');
    }

    public function about()
    {
        $data = [
            'title' => SITENAME,
            'description' => '製作一個可以新增、編輯、刪除的瑞典語單字本。',
        ];
        $this->view('pages/about', $data);
    }
}
