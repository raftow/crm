<?php

class RequestStatusEnTranslator{
    public static function initData()
    {
        $trad = [];

		$trad["request_status"]["requeststatus.single"] = "Request status";
		$trad["request_status"]["requeststatus.new"] = "new";
		$trad["request_status"]["request_status"] = "Request statuses";
		$trad["request_status"]["request_status_name_ar"] = "Request status name ar";
		$trad["request_status"]["request_status_name_en"] = "Request status name en";
		$trad["request_status"]["who"] = "Who";
        // steps
        return $trad;
    }

    public static function getInstance()
	{
        if(false) return new RequestStatusArTranslator();
		return new RequestStatus();
	}
}

