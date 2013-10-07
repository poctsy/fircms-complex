<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity {

    private $_id;



    /**
     * Authenticates a user.
     * @return boolean whether authentication succeeds.
     */
    public function authenticate() {

   
        $criteria = new CDbCriteria;
        $criteria->with = 'authassignments';
        $criteria->addCondition("authassignments.itemname=:a", 'OR');//创始人进入后台权限
        $criteria->addCondition("authassignments.itemname='Admin'", 'OR');//超级管理员进入后台权限.数据名称默认不变
        $criteria->addCondition("authassignments.itemname=:b", 'OR');//后台管理组进入后台权限
        $criteria->addCondition("LOWER(username)=:username", 'AND');
        $criteria->params = array(':a' => $this->SuperAdminUse,':b' => $this->GeneralAdmins, ':username' => strtolower($this->username));
        $user = User::model()->find($criteria);
  
        if ($user === null)
            $this->errorCode = self::ERROR_USERNAME_INVALID;
        else if (!$user->validatePassword($this->password))
            $this->errorCode = self::ERROR_PASSWORD_INVALID;
        else {
            $this->_id = $user->id;
            $this->username = $user->username;
            $this->errorCode = self::ERROR_NONE;
        }
        return $this->errorCode == self::ERROR_NONE;
    }

    /**
     * @return integer the ID of the user record
     */
    public function getId() {
        return $this->_id;
    }

    public function getGeneralAdmins() {
        return Yii::app()->params['generalAdmins'];
    }
    
    public function getSuperAdminUse() {
        return Yii::app()->params['superAdminUse'];
    }

}