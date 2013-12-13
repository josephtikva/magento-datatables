Datatables server side code for Magento.

Supports search, pagination, filtering(global and multi-column), sorting(multi-column), 

Roadmap: To Support EAV collections, Regex Filtering

Usage:

1. Install Module.
2. When creating collections, extend class `Arosavd_Datatables_Model_Mysql4_CollectionAbstract` instead of `Mage_Core_Model_Mysql4_Collection_Abstract`
3. see /app/code/local/Arosavd/Datatables/controllers/IndexController.php for a sample usage.
4. see app/code/local/Arosavd/Datatables/Model/Mysql4/CollectionAbstract.php for the implentation.
