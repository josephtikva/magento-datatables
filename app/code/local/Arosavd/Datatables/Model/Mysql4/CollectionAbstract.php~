<?php
    abstract class Arosavd_Datatables_Model_Mysql4_CollectionAbstract extends Mage_Core_Model_Mysql4_Collection_Abstract
    {

        protected $dataTables = array();
        protected $params = array();
        protected $returnValues = array();

        public function applyFiltersFromParams($params){
            $this->params = $params;
            $this->setupFields()->applySearch();
            $this->addFieldToSelect('*')->setSort()->setLimit();
            return $this;
        }


        protected function setupFields(){
               $params = $this->params;
               $fieldNames = array();
               for($x = 0; $x < (int)$params['iColumns']; $x++){
                   $fieldNames[$x] = $params['mDataProp_'.$x];
               }
               $this->dataTables['fields'] = $fieldNames;
               return $this;
        }

        protected function applySearch(){
            $params = $this->params;
            $this->setTotal('iTotalRecords');
            if(strlen(trim($params['sSearch'])) > 0){
                $searchFields = $searchConditions = array();
                foreach($this->dataTables['fields'] as $key => $field){
                    if($params['bSearchable_'.$key] == 'true'){
                        $searchFields[] = $field;
                        $searchConditions[] = array('like'=> '%'.$params['sSearch'].'%');
                    }
                }
                $this->addFieldToFilter($searchFields, $searchConditions);
            }
            //TODO implement the bRegex and bRegex_n items
            foreach($this->dataTables['fields'] as $key => $field){
                if(strlen(trim($params['sSearch_'.$key]))){
                    $this->addFieldToFilter($field, array('like'=>'%'. $params['sSearch_'.$key].'%'));
                }
            }
            return $this;
        }

        protected function setSort(){
                $params = $this->params;
                $numberOfSortingColumns = (int) $params['iSortingCols'];
                for($x = 0; $x < $numberOfSortingColumns; $x++){
                    $columnIndex = $params['iSortCol_'.$x];

                    $fieldName = $this->dataTables['fields'][$columnIndex];
                    $dir = $params['sSortDir_'.$x];
                    if($params['bSortable_'.$columnIndex] == 'true'){
                        $this->setOrder($fieldName, strtoupper($dir));
                    }
                }
                return $this;
        }

        protected function setLimit(){
            $params = $this->params;
            $this->dataTables['iDisplayStart'] = $startItem = (int)$params['iDisplayStart'];
            $itemPerPage = (int)$params['iDisplayLength'];
            $this->clear()->getSelect()->limit($itemPerPage,$startItem);
            return $this;
        }

        protected function setTotal($totalType = 'iTotalDisplayRecords'){
            $count = $this->getSelectCountSql();
            $this->returnValues[$totalType] = $count->query()->fetchColumn();
            return $this;
        }

        protected function getReturnValues(){
            //set the total records after applying the filter
            $this->setTotal('iTotalDisplayRecords');

            $this->returnValues['sEcho'] = (int)$this->params['sEcho'];
            return $this->returnValues;
        }
		

    }
	 
