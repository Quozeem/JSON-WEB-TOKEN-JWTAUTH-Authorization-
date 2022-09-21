<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\Table;
class VTUcontroller extends Controller
{
 
  public function index(Request $request)
  {
   $sevice_Alvailable=$this->allServices();
    return view('welcome',[
      'services'=> $sevice_Alvailable,
     'category'=>$this->product_categories($request)
    ]);
  }
    public function allServices()
    {
   
    $curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://v2.api.ibrolinks.com/api/v2/services',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_HTTPHEADER => array(
    'Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiNTNkNmRmZDA5MGViZGI2OTMwNzlkNDdiMTY5NWVkZWVlZjY5OWQwYjdiZjdlYzQzODNkZDA2NWJmZjk3MDM2MjI1ZTRmZTc2M2JmNzAzZTIiLCJpYXQiOjE2NTc5NTc0MjcuNjQ5ODA5LCJuYmYiOjE2NTc5NTc0MjcuNjQ5ODExLCJleHAiOjE2ODk0OTM0MjcuNjQ4MTg4LCJzdWIiOiI2NTQ5Iiwic2NvcGVzIjpbImFwaSJdfQ.LqPaeLeDVxFsfrAkwL3FOHXRx5USjkMq1XH1TQ_NlYz3Oeayrc7yopPODPg0Wn0_0Jo0zTgoLjPGEiEca7xC4Jjieeb2nBzzRn7lADVlh0xKAg4jkf-cV4ltofDQAYRFunZX_0wkeb2sSJilsqRbhA5S-AtoaNuQz3Ge1MekTdWaf8SrUkqNK5z6LYvdpuGL64puvNt-jxNFnWRPIIvRrg55D-STMGu-eUaCrmnCyf_-6i8i_GsxEUf0UWF6QhP4Kz5wqeIX53wQkuwvt6hN9dn-mNrGx9KqVDreJXpUy5ovdD6kIMkv9J4U3_zVVZD5VovIMd0tayZBUiRlB5fc_qnsqWpQDTFUwmmiLiwLUWi2pIxyjR5dKzIuh61aFPmIu7WH9XZXPWaTTcET9GASKAkKNk-53uyPLahQk-683X12E9b4XLr97Q1tQ0Ny5jTx5uginzVcI1VPKwx4XynAEuPrMWP7P1ahXquN4HjM3hHbxIijE1BhZfqsTdrW_O_LSbXobzz8jFS42D8UV2DXepfDHRkKFd-PmEoGc_u5PNFY2R-qqFmOUS5wdqMNWYnlyzIB5v-6JWF5NHPOeWW1WCfsT1TxeFru8P1-zY48vaqHTyOas1HFTbBa-iAPfRzwv4-QsediOiLRkTM_-rYClE2h65PRCVZoz1SVgObDwd8',
    'Secret-key: SGVhbHRoeWZvcmV2ZXJtb3JlQGdtYWlsLmNvbTowNzAzNTA3NzIwOQ=='
  ),
));

$response = curl_exec($curl);
if($response)
{
curl_close($curl);
$result=json_decode($response);
$services=$result->data->services;
return $services;
    }
return "";
}
public function product_categories(Request $request)
{
  return response()->json($request->all());
  // collect id from index()
  // $iD=$this->index();
  $endpoint="https://v2.api.ibrolinks.com/api/v2/product-by-category";
  $curl=curl_init();
  $serviceData=array(
    'service_id' => 3
  );
  curl_setopt($curl,CURLOPT_URL,$endpoint);
  curl_setopt($curl,CURLOPT_POST,1);
  curl_setopt($curl,CURLOPT_POSTFIELDS,json_encode($serviceData));
  curl_setopt($curl,CURLOPT_RETURNTRANSFER,true);
  curl_setopt($curl,CURLOPT_CONNECTTIMEOUT,0);
  curl_setopt($curl,CURLOPT_TIMEOUT,0);
  //SETHEADER FROM HEAD POINT
  curl_setopt($curl,CURLOPT_HTTPHEADER,array(
    'Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiNTNkNmRmZDA5MGViZGI2OTMwNzlkNDdiMTY5NWVkZWVlZjY5OWQwYjdiZjdlYzQzODNkZDA2NWJmZjk3MDM2MjI1ZTRmZTc2M2JmNzAzZTIiLCJpYXQiOjE2NTc5NTc0MjcuNjQ5ODA5LCJuYmYiOjE2NTc5NTc0MjcuNjQ5ODExLCJleHAiOjE2ODk0OTM0MjcuNjQ4MTg4LCJzdWIiOiI2NTQ5Iiwic2NvcGVzIjpbImFwaSJdfQ.LqPaeLeDVxFsfrAkwL3FOHXRx5USjkMq1XH1TQ_NlYz3Oeayrc7yopPODPg0Wn0_0Jo0zTgoLjPGEiEca7xC4Jjieeb2nBzzRn7lADVlh0xKAg4jkf-cV4ltofDQAYRFunZX_0wkeb2sSJilsqRbhA5S-AtoaNuQz3Ge1MekTdWaf8SrUkqNK5z6LYvdpuGL64puvNt-jxNFnWRPIIvRrg55D-STMGu-eUaCrmnCyf_-6i8i_GsxEUf0UWF6QhP4Kz5wqeIX53wQkuwvt6hN9dn-mNrGx9KqVDreJXpUy5ovdD6kIMkv9J4U3_zVVZD5VovIMd0tayZBUiRlB5fc_qnsqWpQDTFUwmmiLiwLUWi2pIxyjR5dKzIuh61aFPmIu7WH9XZXPWaTTcET9GASKAkKNk-53uyPLahQk-683X12E9b4XLr97Q1tQ0Ny5jTx5uginzVcI1VPKwx4XynAEuPrMWP7P1ahXquN4HjM3hHbxIijE1BhZfqsTdrW_O_LSbXobzz8jFS42D8UV2DXepfDHRkKFd-PmEoGc_u5PNFY2R-qqFmOUS5wdqMNWYnlyzIB5v-6JWF5NHPOeWW1WCfsT1TxeFru8P1-zY48vaqHTyOas1HFTbBa-iAPfRzwv4-QsediOiLRkTM_-rYClE2h65PRCVZoz1SVgObDwd8',
    'Secret-key: SGVhbHRoeWZvcmV2ZXJtb3JlQGdtYWlsLmNvbTowNzAzNTA3NzIwOQ==',
    "Cache-Control: no-cache",
    'Content_Type : Application/json'
  ));
  $response = curl_exec($curl);
  if($response)
{ 
 //  curl_close($curl);
   $result=json_decode($response);
   $categories=$result->data->category;
  return $result;
 }
 return "";
  // $curl = curl_init();

  // curl_setopt_array($curl, array(
  //   CURLOPT_URL => 'https://v2.api.ibrolinks.com/api/v2/product-by-category',
  //   CURLOPT_RETURNTRANSFER => true,
  //   CURLOPT_ENCODING => '',
  //   CURLOPT_MAXREDIRS => 10,
  //   CURLOPT_TIMEOUT => 0,
  //   CURLOPT_FOLLOWLOCATION => true,
  //   CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  //   CURLOPT_CUSTOMREQUEST => 'POST',
  //   CURLOPT_POSTFIELDS =>'{
  //     service_id : 3
  // }',
//     CURLOPT_HTTPHEADER => array(
//       'Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiNTNkNmRmZDA5MGViZGI2OTMwNzlkNDdiMTY5NWVkZWVlZjY5OWQwYjdiZjdlYzQzODNkZDA2NWJmZjk3MDM2MjI1ZTRmZTc2M2JmNzAzZTIiLCJpYXQiOjE2NTc5NTc0MjcuNjQ5ODA5LCJuYmYiOjE2NTc5NTc0MjcuNjQ5ODExLCJleHAiOjE2ODk0OTM0MjcuNjQ4MTg4LCJzdWIiOiI2NTQ5Iiwic2NvcGVzIjpbImFwaSJdfQ.LqPaeLeDVxFsfrAkwL3FOHXRx5USjkMq1XH1TQ_NlYz3Oeayrc7yopPODPg0Wn0_0Jo0zTgoLjPGEiEca7xC4Jjieeb2nBzzRn7lADVlh0xKAg4jkf-cV4ltofDQAYRFunZX_0wkeb2sSJilsqRbhA5S-AtoaNuQz3Ge1MekTdWaf8SrUkqNK5z6LYvdpuGL64puvNt-jxNFnWRPIIvRrg55D-STMGu-eUaCrmnCyf_-6i8i_GsxEUf0UWF6QhP4Kz5wqeIX53wQkuwvt6hN9dn-mNrGx9KqVDreJXpUy5ovdD6kIMkv9J4U3_zVVZD5VovIMd0tayZBUiRlB5fc_qnsqWpQDTFUwmmiLiwLUWi2pIxyjR5dKzIuh61aFPmIu7WH9XZXPWaTTcET9GASKAkKNk-53uyPLahQk-683X12E9b4XLr97Q1tQ0Ny5jTx5uginzVcI1VPKwx4XynAEuPrMWP7P1ahXquN4HjM3hHbxIijE1BhZfqsTdrW_O_LSbXobzz8jFS42D8UV2DXepfDHRkKFd-PmEoGc_u5PNFY2R-qqFmOUS5wdqMNWYnlyzIB5v-6JWF5NHPOeWW1WCfsT1TxeFru8P1-zY48vaqHTyOas1HFTbBa-iAPfRzwv4-QsediOiLRkTM_-rYClE2h65PRCVZoz1SVgObDwd8',
//     'Secret-key: SGVhbHRoeWZvcmV2ZXJtb3JlQGdtYWlsLmNvbTowNzAzNTA3NzIwOQ==',
//     "Cache-Control: no-cache",
//   ),
// ));
  

// collect product id here=$product_id
//push category out to ajax and collect category id and category name e.g mtn,glo or nepa bill for electrician
}
public function packages(Request $request)
{
  
  $client = new Client();
  $headers = [
    'secret_key' => '{{secret_key}}'
  ];
  $body = '{
      "product_id": '.$product_id.'
  }';
  $request = new Request('POST', '{{base_url}}packages', $headers, $body);
  $res = $client->sendAsync($request)->wait();
  return $res->getBody();
  // return the package product e.g mtn #100 50mb etc
}
}

