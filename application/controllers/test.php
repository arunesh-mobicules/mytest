<?php
/**
 * Created by JetBrains PhpStorm.
 * User: akhilesh
 * Date: 11/7/11
 * Time: 12:16 PM
 * To change this template use File | Settings | File Templates.
 */

class Test extends CI_Controller
{

    function index()
    {
        $this->template->title("home");
        $this->template->build("home");

    }

    function send_email()
    {
        $config['protocol'] = 'smtp';
        $config['smtp_host'] = 'ssl://smtp.googlemail.com';
        $config['smtp_port'] = '465';
        $config['smtp_timeout'] = '30';
        $config['smtp_user'] = 'aruneshsaxena@gmail.com';
        $config['smtp_pass'] = 'kavi21071991';
        $config['charset'] = 'utf-8';
        $config['newline'] = "\r\n";
        $this->load->library('email');
        $this->email->initialize($config);


        $this->email->from('aruneshsaxena@gmail.com', 'Me');
        $this->email->to('s.arunesh.vit.2007@gmail.com');
        $this->email->subject('testing my mail function with CodeIgniter');
        $this->email->message('this is the content');

        if (!$this->email->send()) {
            echo 'error! <br />';
            // Generate error
        } else {
            echo "success";
        }
//        echo $this->email->print_debugger();
    }

    function login()
    {
        $this->template->title("loging");
        $this->template->build('login');
    }

    function save()
    {
        $name = $this->input->post('name');
        $password = $this->input->post('password');
        $data = array(
            'name' => $name,
            'password' => md5($password)
        );
        $this->Test_model->save($data);
    }

    function get_login()
    {
        $name = $this->input->post('name_l');
        $password = $this->input->post('password_l');
        $hash = md5($password);
        $login = $this->Test_model->get_login($name, $hash);
        if ($login) {
            echo $login->name;
        }

    }


    function validate()
    {
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('mobile', 'Mobile', 'min_length[10]|max_length[10]|numeric');
        $this->form_validation->set_rules('password', 'Password', 'required|matches[passconf]');
        $this->form_validation->set_rules('passconf', 'Password Confirmation', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('home');
        } else {
            $this->load->view('home');
        }
    }


    function go_add()
    {
        $this->template->title("add");
        $this->template->build("add");
    }


    function submit()
    {
        $name = $this->input->post('name');
        $email = $this->input->post('email');
        $gender = $this->input->post('gender');

        $data = array(
            "name" => $name,
            "email" => $email,
            "gender" => $gender
        );

        if ($record = $this->Test_model->get_email($email)) {

            $email_already = $record->email;

            echo json_encode(array(
                "success" => false,
                "message" => "Sorry !! Email already exists."

            ));

        } else {
            $this->Test_model->add_info($data);

            echo json_encode(array(
                "success" => true,
                "message" => "Information save"
            ));
        }
    }

    function view_table()
    {


        $this->load->library('table');
        $db_records = $this->Test_model->get_all_info();
        $data['records'] = $db_records;

        $this->template->title("view_table");
        $this->template->build("view_table", $data);

    }

    function delete()
    {
        // echo "delete";
        $id = $this->input->get('id');
        // echo $id;
        $this->Test_model->delete_info($id);

        $this->load->library('table');
        $db_records = $this->Test_model->get_all_info();
        $data['records'] = $db_records;

        $this->template->title("view_table");
        $this->template->build("view_table", $data);


    }

    function update()
    {
        $id = $this->input->get('id');
        $db_records = $this->Test_model->get_update($id);

        $data['records'] = $db_records;
        $data['id'] = $id;

        $this->template->title("update");
        $this->template->build("update", $data);

    }

    function update_row()
    {

        $id = $this->input->post('id');
        //echo $id;
        $name = $this->input->post('name');
        $email = $this->input->post('email');
        $gender = $this->input->post('gender');

        $data = array(
            "name" => $name,
            "email" => $email,
            "gender" => $gender
        );

        $this->Test_model->update_info($id, $data);

        echo json_encode(array(
            "success" => true,
            "message" => "Information update"
        ));
    }

    function search()
    {
        $email = $this->input->post('email');

        if ($record = $this->Test_model->get_email($email)) {
            $data['record'] = $record;
            $data['success'] = true;
            echo json_encode($data);
        } else {
            $data['success'] = false;
            echo json_encode($data);
        }
    }

    function search_select()
    {
        $gender = $this->input->post('gender');

        $record = $this->Test_model->search_by_gender($gender);
        $data['record'] = $record;
        $data['success'] = true;
        echo json_encode($data);
    }

    function call_curl()
    {
//                $url = "http://www.google.com";
        $url = 'http://localhost/my/index.php/test2/test_curl';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($ch);
        echo curl_error($ch);
        curl_close($ch);


//        echo $output;
        var_dump($output);

        if ($output) {
            echo "true";
        } else {
            echo "false";
        }

    }

    function check(){
        $a[]=array(1,'lavi','klk');
        $a[]=array(1,'lavi','dcd');
        $a[]=array(2,'chavi','dddddddddd');
        $a[]=array(4,'kavi','ddddddssds');

        $b=array();


        foreach($a as $row){
            var_dump($row);
            if(in_array(array($row['0'],$row['1']),$b))  {
                            echo "found";
            }else{
//                $key = array_search($row['id'], $b);
//                if($key){
//                    $b[$key]=$row;
//                }
                $b[]=$row;
            }
        }

//        $a = array(array('p', 'h'), array('l', 'r'), 'o');
//
//        if (in_array(array('p','h'), $a)) {
//            echo "'ph' was found\n";
//        }else{
//            echo "not";
//        }

        var_dump($a);
        var_dump($b);


    }

}
