<?php
    use App\Models\Division;
    use App\Models\Township;
    // category
    define('RENT', 'R');
    define('SALE', 'S');

    //status
    define('AVAILABLE', 'AV');
    define('SOLDOUT', 'SO');
    define('PENDING', 'PE');
    define('SOLDOUTBYOTHERAGENCY', 'SOBYA');

    // property location
    // define('STATE', 'S');
    // define('CITY', 'C');
    // define('TOWNSHIP', 'T');

    //property type
    define('APARTMENT', 'A');
    define('CONDO', 'C');

    // //features
    define('SEAVIEW', 'SV');
    define('SWIMMINGPOOL', 'SPV');
    define('CONERUNIT', 'CU');
    define('HIGHFLOOR', 'HF');

    //customer enquiry type
    define('CBUY', 'B');
    define('CRENT', 'R');

    //properties filter
    define('PROPERTY_IDFILTER', 'PROPERTY_IDFILTER');    
    define('PROPERTY_NAMEFILTER','PROPERTY_NAMEFILTER');
    define('PROPERTY_CATEGORYFILTER','PROPERTY_CATEGORYFILTER');
    define('PROPERTY_LOCATIONFILTER','PROPERTY_LOCATIONFILTER');
    define('PROPERTY_BUILDYEARFILTER','PROPERTY_BUILDYEARFILTER');
    define('PROPERTY_MINPRICEFILTER','PROPERTY_MINPRICEFILTER');
    define('PROPERTY_MAXPRICEFILTER','PROPERTY_MAXPRICEFILTER');  

    //owner filter
    define('OWNER_NAMEFILTER', 'OWNER_NAMEFILTER');
    define('OWNER_PHONEFILTER', 'OWNER_PHONEFILTER');

    //customer filter
    define('CUST_IDFILTER', 'CUST_IDFILTER');
    define('CUST_NAMEFILTER', 'CUST_NAMEFILTER');
    define('CUST_PHONEFILTER', 'CUST_PHONEFILTER');
    define('CUST_ENQUIRYTYPEFILTER', 'CUST_ENQUIRYTYPEFILTER');
    define('CUST_ENQUIRYPROPERTYFILTER', 'CUST_ENQUIRYPROPERTYFILTER');

    // tenure property
    define('TENURE0', '0');
    define('TENURE1', '1');
    define('TENURE2', '2');
    

    function get_all_divisions(){
        $division_arr = [];
        $divisions = Division::all();
        if($divisions){
            foreach($divisions as $division){
                $division_arr[$division->id] = $division->division;
            }
        }
        return $division_arr;
    }
    function get_all_townships(){
        $township_arr = [];
        $townships = Township::all();
        if($townships){
            foreach($townships as $township){
                $township_arr[$township->id] = $township->township;
            }
        }
        return $township_arr;
    }

?>		