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
            $data = [
                'count' => count($searchResult),
                'searchResult' => $searchResult,
            ];
            foreach ($searchResult as $word) {
                if (!$this->wordModel->editSearchInfo($word->id)) {
                    echo 'Can not edit searched time information!';
                }
            }
            $this->view('words/show', $data);
        } else {
            redirect('words/add/'.$string);
        }
    }

    public function add($string = null)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            //Sanitize the post
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [
              'type_id' => (int) trim($_POST['type_id']),
              'word' => trim($_POST['word']),
              'meaning' => trim($_POST['meaning']),
              //'user_id' => $_SESSION['user_id'],
              'form2' => trim($_POST['form2']),
              'form3' => trim($_POST['form3']),
              'form4' => trim($_POST['form4']),
              'form5' => trim($_POST['form5']),
              //'tag' => trim($_POST['tag']),
              'type_id_err' => '',
              'word_err' => '',
              'meaning_err' => '',
              //'tag_err' => '',
            ];

            //Validate data
            if (empty($data['type_id'])) {
                $data['type_id_err'] = '請選擇詞性';
            }
            if (empty($data['word'])) {
                $data['word_err'] = '請輸入單字';
            }
            ///////記得測試這項數字檢查能否成功
            if (preg_match('~[0-9]~', $data['word'])) {
                $data['word_err'] = '單字不應有數字';
            }
            if (empty($data['meaning'])) {
                $data['meaning_err'] = '請輸入意思';
            }

            ///////拆分tag，驗證tag

            //Make sure no errors
            if (empty($data['type_id_err']) && empty($data['word_err']) && empty($data['meaning_err'])) {
                //Validated
                if ($this->wordModel->addWord($data)) {
                    flash('word_message', 'New word added!');
                    redirect('words/show/'.$data['word']);
                } else {
                    die('Something went wrong.');
                }
            } else {
                //Return to add post page with data and error information
                $this->view('words/add', $data);
            }
        } else {
            $data = [
                'type_id' => '',
                'word' => $string,
                'meaning' => '',
                //'user_id' => '',
                'form2' => '',
                'form3' => '',
                'form4' => '',
                'form5' => '',
                //'tag' => trim($_POST['tag']),
                'type_id_err' => '',
                'word_err' => '',
                'meaning_err' => '',
                //'tag_err' => '',
            ];
            $this->view('words/add', $data);
        }
    }
}
