<?php

class Arosavd_Datatables_TodoController extends Mage_Core_Controller_Front_Action{

   
    function indexAction(){
        $params = $this->getRequest()->getParams();
        $collection = Mage::getModel('{somemodel}')
			->getCollection()
			->applyFiltersFromParams($params);
        //you can add a custom filter here
	//$collection->addFieldToFilter('string {field}', '{array $condition}'

	$returnValues = $collection->getReturnValues();
        $rows= array();
        foreach($collection as $item){
	    //write a custom helper -- which formats row to be ouput in the format expected by datatables
            $data = $helper->getFormattedRow($item);
            if($data){
                $rows[] = $data;
            }
        }
        $returnValues['aaData']=>$rows;
        echo json_encode($returnValues);

    }
}
