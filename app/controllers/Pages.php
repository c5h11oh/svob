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
            'title' => 'About Us',
            'description' => 'Apps that shares posts with other users.',
        ];
        $this->view('pages/about', $data);
    }
}
