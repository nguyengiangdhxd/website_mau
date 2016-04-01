<?php 
use Flywheel\Db\Manager;
use Flywheel\Model\ActiveRecord;
/**.
 * Contacts
 * @version		$Id$
 * @package		Model

 * @property integer $id id primary auto_increment type : int(11)
 * @property string $fullname fullname type : varchar(300) max_length : 300
 * @property string $address address type : varchar(300) max_length : 300
 * @property string $mobiphone mobiphone type : varchar(300) max_length : 300
 * @property string $email email type : varchar(300) max_length : 300
 * @property string $subject subject type : varchar(300) max_length : 300
 * @property string $content content type : text max_length : 
 * @property datetime $created_time created_time type : datetime
 * @property datetime $modified_time modified_time type : datetime

 * @method void setId(integer $id) set id value
 * @method integer getId() get id value
 * @method static \Contacts[] findById(integer $id) find objects in database by id
 * @method static \Contacts findOneById(integer $id) find object in database by id
 * @method static \Contacts retrieveById(integer $id) retrieve object from poll by id, get it from db if not exist in poll

 * @method void setFullname(string $fullname) set fullname value
 * @method string getFullname() get fullname value
 * @method static \Contacts[] findByFullname(string $fullname) find objects in database by fullname
 * @method static \Contacts findOneByFullname(string $fullname) find object in database by fullname
 * @method static \Contacts retrieveByFullname(string $fullname) retrieve object from poll by fullname, get it from db if not exist in poll

 * @method void setAddress(string $address) set address value
 * @method string getAddress() get address value
 * @method static \Contacts[] findByAddress(string $address) find objects in database by address
 * @method static \Contacts findOneByAddress(string $address) find object in database by address
 * @method static \Contacts retrieveByAddress(string $address) retrieve object from poll by address, get it from db if not exist in poll

 * @method void setMobiphone(string $mobiphone) set mobiphone value
 * @method string getMobiphone() get mobiphone value
 * @method static \Contacts[] findByMobiphone(string $mobiphone) find objects in database by mobiphone
 * @method static \Contacts findOneByMobiphone(string $mobiphone) find object in database by mobiphone
 * @method static \Contacts retrieveByMobiphone(string $mobiphone) retrieve object from poll by mobiphone, get it from db if not exist in poll

 * @method void setEmail(string $email) set email value
 * @method string getEmail() get email value
 * @method static \Contacts[] findByEmail(string $email) find objects in database by email
 * @method static \Contacts findOneByEmail(string $email) find object in database by email
 * @method static \Contacts retrieveByEmail(string $email) retrieve object from poll by email, get it from db if not exist in poll

 * @method void setSubject(string $subject) set subject value
 * @method string getSubject() get subject value
 * @method static \Contacts[] findBySubject(string $subject) find objects in database by subject
 * @method static \Contacts findOneBySubject(string $subject) find object in database by subject
 * @method static \Contacts retrieveBySubject(string $subject) retrieve object from poll by subject, get it from db if not exist in poll

 * @method void setContent(string $content) set content value
 * @method string getContent() get content value
 * @method static \Contacts[] findByContent(string $content) find objects in database by content
 * @method static \Contacts findOneByContent(string $content) find object in database by content
 * @method static \Contacts retrieveByContent(string $content) retrieve object from poll by content, get it from db if not exist in poll

 * @method void setCreatedTime(\Flywheel\Db\Type\DateTime $created_time) setCreatedTime(string $created_time) set created_time value
 * @method \Flywheel\Db\Type\DateTime getCreatedTime() get created_time value
 * @method static \Contacts[] findByCreatedTime(\Flywheel\Db\Type\DateTime $created_time) findByCreatedTime(string $created_time) find objects in database by created_time
 * @method static \Contacts findOneByCreatedTime(\Flywheel\Db\Type\DateTime $created_time) findOneByCreatedTime(string $created_time) find object in database by created_time
 * @method static \Contacts retrieveByCreatedTime(\Flywheel\Db\Type\DateTime $created_time) retrieveByCreatedTime(string $created_time) retrieve object from poll by created_time, get it from db if not exist in poll

 * @method void setModifiedTime(\Flywheel\Db\Type\DateTime $modified_time) setModifiedTime(string $modified_time) set modified_time value
 * @method \Flywheel\Db\Type\DateTime getModifiedTime() get modified_time value
 * @method static \Contacts[] findByModifiedTime(\Flywheel\Db\Type\DateTime $modified_time) findByModifiedTime(string $modified_time) find objects in database by modified_time
 * @method static \Contacts findOneByModifiedTime(\Flywheel\Db\Type\DateTime $modified_time) findOneByModifiedTime(string $modified_time) find object in database by modified_time
 * @method static \Contacts retrieveByModifiedTime(\Flywheel\Db\Type\DateTime $modified_time) retrieveByModifiedTime(string $modified_time) retrieve object from poll by modified_time, get it from db if not exist in poll


 */
abstract class ContactsBase extends ActiveRecord {
    protected static $_tableName = 'contacts';
    protected static $_phpName = 'Contacts';
    protected static $_pk = 'id';
    protected static $_alias = 'c';
    protected static $_dbConnectName = 'contacts';
    protected static $_instances = array();
    protected static $_schema = array(
        'id' => array('name' => 'id',
                'not_null' => true,
                'type' => 'integer',
                'primary' => true,
                'auto_increment' => true,
                'db_type' => 'int(11)',
                'length' => 4),
        'fullname' => array('name' => 'fullname',
                'not_null' => false,
                'type' => 'string',
                'db_type' => 'varchar(300)',
                'length' => 300),
        'address' => array('name' => 'address',
                'not_null' => false,
                'type' => 'string',
                'db_type' => 'varchar(300)',
                'length' => 300),
        'mobiphone' => array('name' => 'mobiphone',
                'not_null' => false,
                'type' => 'string',
                'db_type' => 'varchar(300)',
                'length' => 300),
        'email' => array('name' => 'email',
                'not_null' => false,
                'type' => 'string',
                'db_type' => 'varchar(300)',
                'length' => 300),
        'subject' => array('name' => 'subject',
                'not_null' => false,
                'type' => 'string',
                'db_type' => 'varchar(300)',
                'length' => 300),
        'content' => array('name' => 'content',
                'not_null' => false,
                'type' => 'string',
                'db_type' => 'text'),
        'created_time' => array('name' => 'created_time',
                'not_null' => false,
                'type' => 'datetime',
                'db_type' => 'datetime'),
        'modified_time' => array('name' => 'modified_time',
                'not_null' => false,
                'type' => 'datetime',
                'db_type' => 'datetime'),
     );
    protected static $_validate = array(
    );
    protected static $_validatorRules = array(
    );
    protected static $_init = false;
    protected static $_cols = array('id','fullname','address','mobiphone','email','subject','content','created_time','modified_time');

    public function setTableDefinition() {
    }

    /**
     * save object model
     * @return boolean
     * @throws \Exception
     */
    public function save($validate = true) {
        $conn = Manager::getConnection(self::getDbConnectName());
        $conn->beginTransaction();
        try {
            $this->_beforeSave();
            $status = $this->saveToDb($validate);
            $this->_afterSave();
            $conn->commit();
            self::addInstanceToPool($this, $this->getPkValue());
            return $status;
        }
        catch (\Exception $e) {
            $conn->rollBack();
            throw $e;
        }
    }

    /**
     * delete object model
     * @return boolean
     * @throws \Exception
     */
    public function delete() {
        $conn = Manager::getConnection(self::getDbConnectName());
        $conn->beginTransaction();
        try {
            $this->_beforeDelete();
            $this->deleteFromDb();
            $this->_afterDelete();
            $conn->commit();
            self::removeInstanceFromPool($this->getPkValue());
            return true;
        }
        catch (\Exception $e) {
            $conn->rollBack();
            throw $e;
        }
    }
}