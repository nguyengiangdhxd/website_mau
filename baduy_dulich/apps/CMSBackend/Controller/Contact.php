<?php
namespace CMSBackend\Controller;


use CMSBackend\Event\CMSBackendEvent;
use CMSBackend\Library\Table\PostList;
use Flywheel\Db\Type\DateTime;
use Flywheel\Session\Session;
use Toxotes\Plugin;

class Contact extends CMSBackendBase
{

    /**
     * @autho vanhs
     *  @time 23:48 06/08/2015
     */
    public function beforeExecute(){

        parent::beforeExecute();
    }

    /**
     *
     * @autho vanhs
     * @time 23:48 06/08/2015
     * @return string
     * @throws \Flywheel\Controller\Exception
     * @throws \Flywheel\View\Exception
     */
    public function executeDefault()
    {
        $this->setTemplate('Flat');

        $query = \Contacts::select();
        $query->orderBy(" `created_time` ", "DESC");
        $q = clone $query;
        $total_records = $q->count('id')->execute();
        $contacts = $query->execute();

        $this->setView('Contact/default');
        $this->view()->assign([ 'contacts' => $contacts, 'total_records' => $total_records ]);
        return $this->renderComponent();
    }

    /**
     * @autho vanhs
     * @time 23:48 06/08/2015
     * @return string
     */
    public function executeDelete(){
        $ajax = new \AjaxResponse();
        $ajax->type = \AjaxResponse::ERROR;

        try{
            $id = $this->post('id', 'INT', 0);

            $contact = \Contacts::retrieveById($id);
            if($contact instanceof \Contacts){
                $contact->delete();
            }

            $ajax->type = \AjaxResponse::SUCCESS;
            $ajax->message = "Xóa thành công";
            return $this->renderText($ajax->toString());

        }catch (\Exception $e){
            $ajax->message = "Có lỗi xảy ra, vui lòng thử lại.";
            return $this->renderText($ajax->toString());
        }
    }
}