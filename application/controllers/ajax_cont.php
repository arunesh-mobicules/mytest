<?php
/**
 * Created by JetBrains PhpStorm.
 * User: akhilesh
 * Date: 11/9/11
 * Time: 11:10 AM
 * To change this template use File | Settings | File Templates.
 */

class Ajax_cont extends CI_Controller
{
    function index()
    {

        $this->template->title("Ajax");
        $this->template->build("ajax");
    }

    function  call()
    {

        $this->load->view('ajax_info');
    }

    function search()
    {
        $email = $this->input->post('email');
        if ($record = $this->Test_model->get_email($email)) {
            $data['record'] = $record;
            $data['success'] = true;
            echo json_encode($data);
        }
        else
        {
            $data['success'] = false;
            echo json_encode($data);
        }

    }

}
