<?php
    use App\Models\Division;
    use App\Models\Township;
    use App\Models\Ward;
    use App\Models\Tenure;
    use App\Models\PropertyType;
    use App\Models\Floor;
    use App\Models\PropertyFloor;
    use App\Models\PropertyRentFloor;
    use App\Models\Invoice;
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
    define('PROPERTY_BUILDYEARFILTER','PROPERTY_BUILDYEARFILTER');
    define('PROPERTY_MINPRICEFILTER','PROPERTY_MINPRICEFILTER');
    define('PROPERTY_MAXPRICEFILTER','PROPERTY_MAXPRICEFILTER');  
    define('PROPERTY_DIVISIONFILTER', 'PROPERTY_DIVISIONFILTER');
    define('PROPERTY_TOWNSHIPFILTER', 'PROPERTY_TOWNSHIPFILTER');
    define('PROPERTY_WARDFILTER', 'PROPERTY_WARDFILTER');

    //rent filter
    define('PROPERTY_RENT_IDFILTER', 'PROPERTY_RENT_IDFILTER');    
    define('PROPERTY_RENT_NAMEFILTER','PROPERTY_RENT_NAMEFILTER');
    define('PROPERTY_RENT_BUILDYEARFILTER','PROPERTY_RENT_BUILDYEARFILTER');
    define('PROPERTY_RENT_MINPRICEFILTER','PROPERTY_RENT_MINPRICEFILTER');
    define('PROPERTY_RENT_MAXPRICEFILTER','PROPERTY_RENT_MAXPRICEFILTER');
    define('PROPERTY_RENT_DIVISIONFILTER', 'PROPERTY_RENT_DIVISIONFILTER');
    define('PROPERTY_RENT_TOWNSHIPFILTER', 'PROPERTY_RENT_TOWNSHIPFILTER');
    define('PROPERTY_RENT_WARDFILTER', 'PROPERTY_RENT_WARDFILTER');  

    //owner filter
    define('OWNER_NAMEFILTER', 'OWNER_NAMEFILTER');
    define('OWNER_PHONEFILTER', 'OWNER_PHONEFILTER');

    //customer filter
    define('CUST_IDFILTER', 'CUST_IDFILTER');
    define('CUST_NAMEFILTER', 'CUST_NAMEFILTER');
    define('CUST_PHONEFILTER', 'CUST_PHONEFILTER');
    define('CUST_ENQUIRYTYPEFILTER', 'CUST_ENQUIRYTYPEFILTER');
    define('CUST_ENQUIRYPROPERTYFILTER', 'CUST_ENQUIRYPROPERTYFILTER');

    //township filter
    define('TOWNSHIP_DIVISIONFILTER', 'TOWNSHIP_DIVISIONFILTERw');
    define('TOWNSHIP_NAMEFILTER', 'TOWNSHIP_NAMEFILTER');

    //ward filter
    define('WARD_DIVISIONFILTER','WARD_DIVISIONFILTER');
    define('WARD_TOWNSHIPFILTER','WARD_TOWNSHIPFILTER');    
    define('WARD_NAMEFILTER', 'WARD_NAMEFILTER');

    //division filter
    define('DIVISION_NAMEFILTER', 'DIVISION_NAMEFILTER');

    //floor filter
    define('FLOOR_NAMEFILTER', 'FLOOR_NAMEFILTER');

    //property type filter
    define('PROPERTY_TYPE_NAMEFILTER', 'PROPERTY_TYPE_NAMEFILTER');

    //tenure filter
    define('TENURE_NAMEFILTER', 'TENURE_NAMEFILTER');

    //invoice filter
    define('INVOICE_INVOICEIDFILTER','INVOICE_INVOICEIDFILTER');
    define('INVOICE_CONTRACTDATEFILTER','INVOICE_CONTRACTDATEFILTER');
    define('INVOICE_RENTOUTDATEFILTER','INVOICE_RENTOUTDATEFILTER');
    define('INVOICE_TYPEFILTER','INVOICE_TYPEFILTER');

    //user filter
    define('USER_NAMEFILTER','USER_NAMEFILTER');
    define('USER_PHONEFILTER','USER_PHONEFILTER');

    //agent filter
    define('AGENT_NAMEFILTER','AGENT_NAMEFILTER');
    define('AGENT_PHONEFILTER','AGENT_PHONEFILTER');
    define('AGENT_COMPANYFILTER','AGENT_COMPANYFILTER');
    
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

    function get_townships_by_division($id){
        $township_arr = [];
        $townships = Township::all()->where('division_id',$id);
        if($townships){
            foreach($townships as $township){
                $township_arr[$township->id] = $township->township;
            }
        }
        return $township_arr;
    }

    function get_wards_by_township($id){
        $ward_arr = [];
        $wards = Ward::all()->where('township_id',$id);
        if($wards){
            foreach($wards as $ward){
                $ward_arr[$ward->id] = $ward->ward;
            }
        }
        return $ward_arr;
    }

    function get_property_floor_id($id){
        
        $property_floor_arr = [];
        $property_floors = PropertyFloor::all()->where('property_id',$id);
        if($property_floors){
            foreach($property_floors as $property_floor){
                $property_floor_arr[$property_floor->id] = $property_floor->floor_id;
            }
        }
        return $property_floor_arr;
    }

    function get_property_rent_floor_id($id){
        $property_rent_floor_arr = [];
        $property_rent_floors = PropertyRentFloor::all()->where('property_rent_id',$id);
        if($property_rent_floors){
            foreach($property_rent_floors as $property_rent_floor){
                $property_rent_floor_arr[$property_rent_floor->id] = $property_rent_floor->floor_id;
            }
        }
        return $property_rent_floor_arr;
    }

    function generate_invoice_id(){
        $length = 16;
        $characters = '0123456789'; // You can add more characters if needed
        $invoice_id = '';
        $charactersLength = strlen($characters);
        
        do {
            $found = false;
            $invoice_id = '';
            for ($i = 0; $i < $length; $i++) {
                $invoice_id .= $characters[mt_rand(0, $charactersLength - 1)];
            }
            $invoice = Invoice::where('invoice_id', $invoice_id)->first();
            if ($invoice) {
                $found = true;
            }
        } while ($found);

        return $invoice_id;        
    }
    
    

?>		