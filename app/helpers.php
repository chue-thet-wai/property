<?php
    use App\Models\Division;
    use App\Models\Township;
    use App\Models\Ward;
    use App\Models\Tenure;
    use App\Models\PropertyType;
    use App\Models\Floor;
    // category
    define('RENT', 'R');
    define('SALE', 'S');

    //status
    define('AVAILABLE', 'AV');
    define('SOLDOUT', 'SO');
    define('PENDING', 'PE');
    define('SOLDOUTBYOTHERAGENCY', 'SOBOA');

    //  Available / Rent Out / Cancel / Rent Out by Other Agenc
    define('RENTAVAILABLE', 'AV');
    define('RENTOUT', 'RO');
    define('CANCEL', 'CL');
    define('RENTOUTBYOTHERAGENCY', 'ROBOA');    

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

    //sale filter
    define('PROPERTY_IDFILTER', 'PROPERTY_IDFILTER');    
    define('PROPERTY_NAMEFILTER','PROPERTY_NAMEFILTER');
    define('PROPERTY_CATEGORYFILTER','PROPERTY_CATEGORYFILTER');
    define('PROPERTY_LOCATIONFILTER','PROPERTY_LOCATIONFILTER');
    define('PROPERTY_BUILDYEARFILTER','PROPERTY_BUILDYEARFILTER');
    define('PROPERTY_MINPRICEFILTER','PROPERTY_MINPRICEFILTER');
    define('PROPERTY_MAXPRICEFILTER','PROPERTY_MAXPRICEFILTER');  

    //rent filter
    define('PROPERTY_RENT_IDFILTER', 'PROPERTY_RENT_IDFILTER');    
    define('PROPERTY_RENT_NAMEFILTER','PROPERTY_RENT_NAMEFILTER');
    define('PROPERTY_RENT_CATEGORYFILTER','PROPERTY_RENT_CATEGORYFILTER');
    define('PROPERTY_RENT_LOCATIONFILTER','PROPERTY_RENT_LOCATIONFILTER');
    define('PROPERTY_RENT_BUILDYEARFILTER','PROPERTY_RENT_BUILDYEARFILTER');
    define('PROPERTY_RENT_MINPRICEFILTER','PROPERTY_RENT_MINPRICEFILTER');
    define('PROPERTY_RENT_MAXPRICEFILTER','PROPERTY_RENT_MAXPRICEFILTER');  

    //owner filter
    define('OWNER_NAMEFILTER', 'OWNER_NAMEFILTER');
    define('OWNER_PHONEFILTER', 'OWNER_PHONEFILTER');

    //customer filter
    define('CUST_IDFILTER', 'CUST_IDFILTER');
    define('CUST_NAMEFILTER', 'CUST_NAMEFILTER');
    define('CUST_PHONEFILTER', 'CUST_PHONEFILTER');
    define('CUST_ENQUIRYTYPEFILTER', 'CUST_ENQUIRYTYPEFILTER');
    define('CUST_ENQUIRYPROPERTYFILTER', 'CUST_ENQUIRYPROPERTYFILTER');

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

    function get_all_wards(){
        $ward_arr = [];
        $wards = Ward::all();
        if($wards){
            foreach($wards as $ward){
                $ward_arr[$ward->id] = $ward->ward;
            }
        }
        return $ward_arr;
    }

    function get_all_tenures(){
        $tenure_arr = [];
        $tenures = Tenure::all();
        if($tenures){
            foreach($tenures as $tenure){
                $tenure_arr[$tenure->id] = $tenure->tenure;
            }
        }
        return $tenure_arr;
    }

    function get_all_propertytypes(){
        $propertytype_arr = [];
        $propertytypes = PropertyType::all();
        if($propertytypes){
            foreach($propertytypes as $propertytype){
                $propertytype_arr[$propertytype->id] = $propertytype->property_type;
            }
        }
        return $propertytype_arr;
    }

    function get_all_floors(){
        $floor_arr = [];
        $floors = Floor::all();
        if($floors){
            foreach($floors as $floor){
                $floor_arr[$floor->id] = $floor->floor;
            }
        }
        return $floor_arr;
    }
    

?>		