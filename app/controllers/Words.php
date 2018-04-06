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
            //Sanitize input
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            //Initialize data
            $data = [
                'string' => $_POST['string'],
                'string_err' => '',
            ];

            //Validate data
            if (empty($data['string'])) {
                $data['string_err'] = 'Please enter something to start the search.';
            }

            if (empty($data['string_err'])) {
                //go search
                redirect('words/show/'.$_POST['string']);
            } else {
                //Return to search page with data and error information
                $this->view('words/search', $data);
            }
        } else {
            $data = [
                'string' => '',
                'string_err' => '',
            ];
            $this->view('words/search', $data);
        }
    }

    public function show($string)
    {
        $count = 0;
        $searchResult = $this->wordModel->getWordByString($string);
        if ($searchResult) {
            $count = count($searchResult);
        }
        $data = [
            'count' => $count,
            'searchResult' => $searchResult,
        ];
        $this->view('words/show', $data);
    }
}
