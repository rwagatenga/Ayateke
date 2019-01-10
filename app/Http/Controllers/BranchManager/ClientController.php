<?php

namespace App\Http\Controllers\BranchManager;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

// use Input;
use Session;
use Excel;
use DB;

use \App\District;
use \App\Sector;
use \App\Cell;
use \App\Village;
use \App\Organisation;
use \App\ClientType;
use \App\Line;
use \App\Client;

class ClientController extends Controller
{
  /**
  * Display a listing of the resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function index()
  {
    if (request()->input('t')) {
      $Clients = Client::where('clientTypeId', request()->input('t'))
      ->latest()
      ->paginate(5);
    }
    else
    $Clients = Client::latest()->paginate(5);

    $btnLinks = ClientType::all();
    $targetPage = "";
    return view('admin.client.home',compact('Clients', 'targetPage', 'btnLinks'))
    ->with('i',(request()->input('page',1) -1)*5);
  }

  /**
  * Show the form for creating a new resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function create()
  {
    //

  }

  /**
  * Store a newly created resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @return \Illuminate\Http\Response
  */
  public function store(Request $request)
  {
    //
  }

  /**
  * Display the specified resource.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function show($id)
  {
    //
    // echo $id;
    if($id == "search"){
      // Return the view for abafatabuguzi bo mungo
      return view("admin.client.home")->with("targetPage", $id);
    }
    if($id == "mungo"){
      // return abort(404);
      return view("admin.client.home")->with("targetPage", $id);
    }
    return view("admin.client.home")->with("targetPage", $id);

  }

  /**
  * Show the form for editing the specified resource.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function edit($id)
  {
    //
    return var_dump($id, "Get the Template from here");
    // return view("admin.client.home");
  }

  /**
  * Update the specified resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function update(Request $request, $id)
  {
    //
    $request->validate([
      'Uploadfile' => 'required'
    ]);
    $clientsType = array("amavomo"=>1, "mungo"=>2, "ibigo"=>3);
    $clientTypeId = NULL;
    if(isset($clientsType[$id])){
      $clientTypeId = $clientsType[$id];
    } else{
      $errorMessage = "Client Type is not available";
      return view("admin.client.home")->with("message", $errorMessage)
      ->with("targetPage", $id)
      ;
    }
    /*return view("admin.client.home")->with("message", $clientTypeId)
    ->with("targetPage", $id)
    ;*/
    $path = $request->file('Uploadfile')->getRealPath();
    /*$input = Input::file("Uploadfile");
    $filename = $input->getRealPath();*/
    $data = Excel::load($path)->get();
    $errorMessage = "";

    $branchId= Session::get("branchId");
    // var_dump($branchId);
    DB::beginTransaction();
    try {
      // echo count($data);
      $mainBreak = false;
      foreach ($data as $k => $value) {
        $mainBreak = false;
        // $index = array_keys($value->items);
        $number         = NULL;
        $firstName      = NULL;
        $lastName       = NULL;
        $idCard         = NULL;
        $organisationId = NULL;
        $telephone1     = NULL;
        $telephone2     = NULL;

        $districtName   = NULL;
        $sectorName     = NULL;
        $cellName       = NULL;
        $villageName    = NULL;

        $lineName       = NULL;

        $counterNumber  = NULL;
        $firstConnection= NULL;
        $comment        = NULL;

        $lineId         = NULL;
        // var_dump($value["items"]);
        foreach($value AS $key=>$v){
          // echo $k.". ".'$v='.$v."<br />";
          // var_dump($k, $v, (strtolower($key) == "izina"), "<br />" );
          if(strtolower($key) == "no"){
            $number = $v;
          } else if( in_array(strtolower($key), array("izina", "amazina_yuvomesha") )  ){
            // echo "Hello";
            $firstName = $v;
          } else if(in_array(strtolower($key), array("andi_mazina", "uhagariye_ikigo", "numero_yivomo") ) ) {
            $lastName = $v;
          } else if(in_array(strtolower($key), array("indangamuntu", "ikiciro") ) ){
            $idCard = $v;
          } else if(strtolower($key) == "telephone1"){
            $telephone1 = $v;
          } else if(strtolower($key) == "telephone2"){
            $telephone2 = $v;
          } else if(strtolower($key) == "akarere"){
            $districtName = $v;
          } else if(strtolower($key) == "umurenge"){
            $sectorName = $v;
          } else if(strtolower($key) == "akagari"){
            $cellName = $v;
          } else if(strtolower($key) == "umudugudu"){
            $villageName = $v;
          } else if(strtolower($key) == "umuyoboro"){
            $lineName = $v;
          } else if(strtolower($key) == "mubazi"){
            $counterNumber = $v;
          } else if(strtolower($key) == "igihe_yaherewe_amazi"){
            $firstConnection = $v;
          }

        }

        if($clientTypeId == 3){
          $organisationInfo = DB::select("SELECT * FROM organisations AS a WHERE name = ?", array($idCard));
          if( count($organisationInfo) <= 0){
            $errorMessage = "Organisation on No. ".$number." does not have a class.";
            DB::rollback();
            break;
          } else{
            $organisationId = $organisationInfo[0]->id;
          }
          $idCard = NULL;
        }
        if( is_null($firstName)){
          $errorMessage = "Client on No. ".$number." Does not have at least a name.";
          // var_dump($value);
          // echo "<hr />";
          DB::rollback();
          break;
        }
        if( is_null($districtName)){
          $errorMessage = "Client on No. ".$number." Does not have a district of residence.";
          DB::rollback();
          break;
        }
        if( is_null($sectorName)){
          $errorMessage = "Client on No. ".$number." Does not have a sector of residence.";
          DB::rollback();
          break;
        }
        if( is_null($cellName)){
          $errorMessage = "Client on No. ".$number." Does not have a cell of residence.";
          DB::rollback();
          break;
        }
        if( is_null($villageName)){
          $errorMessage = "Client on No. ".$number." Does not have a village of residence.";
          DB::rollback();
          break;
        }
        if( is_null($lineName)){
          $errorMessage = "Client on No. ".$number." is not connected.";
          DB::rollback();
          break;
        }
        // check the comming line is in the list of my branch
        $lines = DB::select($sql = "SELECT a.id AS lineId,
          a.blancheId AS blancheId,
          a.name AS lineName,
          a.code AS lineCode
          FROM line AS a
          WHERE a.blancheId = ? &&
          a.name = ?
          ", array($branchId, $lineName));
          if(count($lines) != 1){
            $errorMessage = "Client on No. ".$number." is not connected to any of our lines.".$sql.$branchId." ".$lineName;
            DB::rollback();
            break;
          }
          $lineId = $lines[0]->lineId;
          $lineCode = $lines[0]->lineCode;
          // Check if the district is already in the Database
          $districtInfo = DB::select("SELECT * FROM ad_districts WHERE name=?", array($districtName));
          $districtData = NULL;
          $districtCode = NULL;

          if(count($districtInfo) != 0){
            $districtData = $districtInfo[0];
          } else{
            $next = DB::select("SELECT MAX(a.code) AS maximum FROM ad_districts AS a");
            $nextCode = $next[0]->maximum;
            $nextCode++;
            while(strlen($nextCode) < 2){
              $nextCode = "0".$nextCode;
            }
            $districtData = District::create(array("name"=>$districtName, "code"=>$nextCode));
          }
          $districtId = $districtData->id;
          $districtCode = $districtData->code;

          // Check if the Sector exits before
          $sectorInfo = DB::select("SELECT * FROM ad_sectors WHERE districtId=? && name=?", array($districtId, $sectorName));
          $sectorData = NULL;
          if(count($sectorInfo) != 0){
            $sectorData = $sectorInfo[0];
          } else{
            $sectorData = Sector::create(array("districtId"=> $districtId, "name"=>$sectorName));
          }
          $sectorId = $sectorData->id;

          // Check if the Cell exits before
          $cellInfo = DB::select("SELECT * FROM ad_cells WHERE sectorId=? && name=?", array($sectorId, $cellName));
          $cellData = NULL;
          if(count($cellInfo) != 0){
            $cellData = $cellInfo[0];
          } else{
            $cellData = Cell::create(array("sectorId"=> $sectorId, "name"=>$cellName));
          }
          $cellId = $cellData->id;

          // Check if the Cell exits before
          $villageInfo = DB::select("SELECT * FROM ad_villages WHERE cellId=? && name=?", array($cellId, $villageName));
          $villageData = NULL;
          if(count($villageInfo) != 0){
            $villageData = $villageInfo[0];
          } else{
            $villageData = Village::create(array("cellId"=> $cellId, "name"=>$villageName));
          }
          $villageId = $villageData->id;

          // Check if idCard is used by some else before
          if(!is_null($idCard)){
            $idCardInfo = DB::select("SELECT    a.id as id,
              a.firsname AS firsname,
              a.surname AS surname
              FROM clients AS a
              WHERE a.idCard = ?
              ", array($idCard));
              if( count($idCardInfo) > 0){
                $errorMessage = "Id Card on No. ".$number." is used By {$idCardInfo[0]->firsname} {$idCardInfo[0]->surname}.";
                DB::rollback();
                break;
              }
            }
            if(!is_null($telephone1)){
              $telephone = DB::select("SELECT a.id as id,
                a.firsname AS firsname,
                a.surname AS surname
                FROM clients AS a
                WHERE a.phoneNumber1 = ? ||
                a.phoneNumber2 = ?
                ", array($telephone1, $telephone1));
                if( count($telephone) > 0){
                  $errorMessage = "Phone Number 1 on No. ".$number." is used By {$idCardInfo[0]->firsname} {$idCardInfo[0]->surname}.";
                  DB::rollback();
                  break;
                }
              }
              if(!is_null($telephone2)){
                $telephone = DB::select("SELECT a.id as id,
                  a.firsname AS firsname,
                  a.surname AS surname
                  FROM clients AS a
                  WHERE a.phoneNumber1 = ? ||
                  a.phoneNumber2 = ?
                  ", array($telephone2, $telephone2));
                  if( count($telephone) > 0){
                    $errorMessage = "Phone Number 2 on No. ".$number." is used By {$idCardInfo[0]->firsname} {$idCardInfo[0]->surname}.";
                    DB::rollback();
                    break;
                  }
                }

                // Here every daa is ready now generate the Client Code
                //get the Last code on the current line
                $prefixPart = $districtCode.$lineCode;
                $suffix = DB::select("SELECT MAX(a.code) AS maximum FROM clients AS a WHERE a.code LIKE('{$prefixPart}%')");
                $suffixPart = $suffix[0]->maximum;
                $suffixPart = preg_replace("/^\d{4}/", "", $suffixPart);
                $suffixPart++;
                while(strlen($suffixPart) < 3){
                  $suffixPart = "0".$suffixPart;
                }

                // Every data is ok now run the create commad
                $clientCode = $prefixPart.$suffixPart;
                Client::create(['clientTypeId'=>$clientTypeId, 'organisationId'=>$organisationId, 'villageId'=>$villageId, 'lineId'=>$lineId, 'code'=>$clientCode, 'firsname'=>$firstName, 'surname'=>$lastName, 'idCard'=>$idCard, 'phoneNumber1'=>$telephone1, 'phoneNumber2'=>$telephone2, 'counterNumber'=>$counterNumber, 'firstConnection'=>$firstConnection]);
                // echo "<hr /><hr /><hr />";
                if($mainBreak){
                  break;
                }
                /*echo "<hr />";
                break;*/
              }
            } catch (\Exception $e) {
              DB::rollback();
              print_r('success => false '.$e->getMessage() );
            }

            if(!$errorMessage){
              DB::commit();
              return view("admin.client.home")->with("success", count($data). " client".(count($data) > 1?"s":""). " uploaded successfully" )
              ->with("targetPage", $id)
              ;
            } else{
              DB::rollback();
              return view("admin.client.home")->with("message", $errorMessage)
              ->with("targetPage", $id)
              ;
            }


          }

          /**
          * Remove the specified resource from storage.
          *
          * @param  int  $id
          * @return \Illuminate\Http\Response
          */
          public function destroy($id)
          {
            //
          }
        }
