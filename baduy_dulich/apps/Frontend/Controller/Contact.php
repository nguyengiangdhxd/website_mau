<?php
/**
 * Created by PhpStorm.
 * User: nobita
 * Date: 2/3/15
 * Time: 11:12 AM
 */

namespace Frontend\Controller;

class Contact extends FrontendBase {
    public function executeDefault() {
        return $this->executeDetail();
    }

    public function executeDetail() {
        $this->setView('Contact/default');
        return $this->renderComponent();
    }

    /**
     * @author vanhs
     * @time 23:11 05/08/2015
     *
     * @return string
     */
    public function executeSave() {
        $ajax = new \AjaxResponse();
        $ajax->type = \AjaxResponse::ERROR;

        try{

            $send_data = [
                'fullname' => '',
                'address' => '',
                'mobiphone' => '',
                'email' => '',
                'subject' => '',
                'content' => ''
            ];

            $send_data = array_merge($send_data, $this->post('send_data', 'ARRAY', []));
//            var_dump($send_data);

            $contact = new \Contacts();
            $contact->setFullname($send_data['fullname']);
            $contact->setAddress($send_data['address']);
            $contact->setMobiphone($send_data['mobiphone']);
            $contact->setEmail($send_data['email']);
            $contact->setSubject($send_data['subject']);
            $contact->setContent($send_data['content']);
            $contact->setCreatedTime(new \DateTime());
            $contact->save();

            $ajax->type = \AjaxResponse::SUCCESS;
            $ajax->message = "Gửi thông tin thành công";
            return $this->renderText($ajax->toString());

        }catch (\Exception $e){
            $ajax->message = "Có lỗi xảy ra, vui lòng thử lại.";
            return $this->renderText($ajax->toString());
        }

    }
}