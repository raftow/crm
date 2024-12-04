<?php

class CrmObject extends AFWObject{

    // إدارة المنتج	إدارة البيانات العامة للنظام
    public static $AROLE_OF_DATA_SITE = 322;
    
    // التحقيق	التحقيق والرد على طلبات العملاء 
    public static $AROLE_OF_INVESTIGATOR = 323;

    // الإشراف على تشغيل نظام خدمة العملاء
    public static $AROLE_OF_SUPERVISOR = 324;

    // إدخال الطلبات الالكترونية التي تصل عبر الهاتف
    public static $AROLE_OF_REQUEST_ENTER = 327;

    // إدارة البيانات المرجعية للنظام
    public static $AROLE_OF_LOOKUPS = 347;


    public static function userConnectedIsSupervisor($objme=null)
    {
        if(!$objme) $objme = AfwSession::getUserConnected();
        if(!$objme) return 0;

        $employee_id = $objme->getEmployeeId();
        if(!$employee_id) return 0;

        return CrmEmployee::isAdmin($employee_id);
    }

    public static function userConnectedIsGeneralSupervisor($objme=null)
    {
        if(!$objme) $objme = AfwSession::getUserConnected();
        if(!$objme) return 0;

        $employee_id = $objme->getEmployeeId();
        if(!$employee_id) return 0;

        return CrmEmployee::isGeneralAdmin($employee_id);
    }

    public static function userConnectedIsSuperAdmin($objme=null)
    {
            if(!$objme) $objme = AfwSession::getUserConnected();
            if(!$objme) return false;
            return $objme->isSuperAdmin();
    }


    public function fld_CREATION_USER_ID()
        {
                return "created_by";
        }
 
        public function fld_CREATION_DATE()
        {
                return "created_at";
        }
 
        public function fld_UPDATE_USER_ID()
        {
        	return "updated_by";
        }
 
        public function fld_UPDATE_DATE()
        {
        	return "updated_at";
        }
 
        public function fld_VALIDATION_USER_ID()
        {
        	return "validated_by";
        }
 
        public function fld_VALIDATION_DATE()
        {
                return "validated_at";
        }
 
        public function fld_VERSION()
        {
        	return "version";
        }
 
        public function fld_ACTIVE()
        {
        	return  "active";
        }
 
        public function isTechField($attribute) {
            return (($attribute=="created_by") or ($attribute=="created_at") or ($attribute=="updated_by") or ($attribute=="updated_at") or ($attribute=="validated_by") or ($attribute=="validated_at") or ($attribute=="version"));  
        }
	


// object number increase chart functions
        
public static function objectNumberAt($gdate, $dateColumn='', $dateSys='greg')
{
    if(!$dateColumn) $dateColumn = "created_at";
    if($dateSys=='hijri') $idate = AfwDateHelper::to_hijri($gdate);
    else $idate = $gdate;

    $obj = new static();
    $obj->where("$dateColumn <= '$idate'");
    return $obj->count();
}

// data to use for chart by default 1 year ago
public static function oniData($start=-360, $end = 0, $step=30, $unit='d', $index='year', 
        $valMode='', $options=['min'=>50, 'max'=>150],
        $dateColumn='', $dateSys='greg')
{
    if($unit=='d') $unit_value=1;
    if($unit=='m') $unit_value=30;
    if($unit=='y') $unit_value=360;

    $step_value = $step * $unit_value;
    $start_value = $start * $unit_value;
    $end_value = $end * $unit_value;

    $data = [];
    
    $allzero = true;
    for($i=$start; $i<=$end; $i+=$step)
    {
        $gdate = AfwDateHelper::shiftGregDate("", $i*$unit_value);
        $c = static::objectNumberAt($gdate, $dateColumn, $dateSys);
        if($c) $allzero = false;
        if($index=='date') $indx = $gdate;
        elseif($index=='year') list($indx,) = explode("-",$gdate);
        else $indx = $i;
        $data[$indx] = $c;
    }

    if(!$valMode) $valMode='randomAlways';

    if(($allzero and ($valMode=='randomIfAllzero')) or ($valMode=='randomAlways'))
    {
        // throw new AfwRuntimeException("will be randomed data = ".var_export($data,true));
        foreach($data as $dindx => $dc)
        {
            $data[$dindx] = round(rand($options['min'], $options['max']));
        }
        // throw new AfwRuntimeException("has been randomed data = ".var_export($data,true));
    }

    return $data;
}

public static function oniChartScript($idCanvas, $type, 
                        $start = -360,
                        $end = 0,
                        $step = 30,
                        $unit = 'd', 
                        $index = 'year', $valMode = '', $options = ['min'=>50, 'max'=>150],
                        $dateColumn='', $dateSys='greg')
{
    $data = static::oniData($start, $end, $step, $unit, $index, $valMode, $options, $dateColumn, $dateSys);
    if($type=="scatter") return AfwChartHelper::scatterChartScript($data, $idCanvas);    
    if($type=="line") return AfwChartHelper::lineChartScript($data, $idCanvas);    
    
}




     
}