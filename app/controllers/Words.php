<?php

class Words extends Controller
{
    public function __construct()
    {
        $this->wordModel = $this->model('Word');
        $this->tagModel = $this->model('Tag');
    }

    public function index()
    {
        redirect('words/search');
    }

    public function search()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            //Sanitize the post
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [
                'string' => trim($_POST['string']),
                'string_err' => '',
            ];

            //Validate data
            if (empty($data['string'])) {
                $data['string_err'] = 'Please enter something to start the search.';
            }

            //Make sure no errors
            if (empty($data['string_err'])) {
                //Validated
                if ($searchResult = $this->wordModel->getWordByString($data['string'])) {
                    $this->view('word/show/'.$data['string'], $searchResult);
                } else {
                    die('Something went wrong.');
                }
            } else {
                //Return to add post page with data and error information
                $this->view('words/search', $data);
            }
        } else {
            $this->view('words/search');
        }
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
