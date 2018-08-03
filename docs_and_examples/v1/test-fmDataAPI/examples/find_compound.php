<?php
// *********************************************************************************************************************************
//
// find_compound.php
//
// This example uses fmDataAPI::apiFindRecords().
//
// *********************************************************************************************************************************
//
// Copyright (c) 2017 - 2018 Mark DeNyse
//
// Permission is hereby granted, free of charge, to any person obtaining a copy
// of this software and associated documentation files (the "Software"), to deal
// in the Software without restriction, including without limitation the rights
// to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
// copies of the Software, and to permit persons to whom the Software is
// furnished to do so, subject to the following conditions:
//
// The above copyright notice and this permission notice shall be included in
// all copies or substantial portions of the Software.
//
// THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
// IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
// FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
// AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
// LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
// OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
// SOFTWARE.
//
// *********************************************************************************************************************************

require_once 'startup.inc.php';

$fm = new fmDataAPI(FM_DATABASE, FM_HOST, FM_USERNAME, FM_PASSWORD);

//$data['query'] = array('ColorIndex' => '5');

//
// Find some records
//
if (1) {

   $options =
         array(
            'query'=> array(
                        array('Name' => 'Test' /*, 'omit' => 'true' */),
                        array('ColorIndex' => '5' /*, 'omit' => 'true' */)
                     )
         );

   $apiResult = $fm->apiFindRecords('Web_Project', '', $options);

}
else {

   $data = array();
   $requests = array();

   $query = array();
   $query['ColorIndex'] = '5';            // Search for: ColorIndex = 5
   $requests[] = $query;

   $query = array();
   $query['Name'] = 'Test';               // *or* Search for Name = Test
   //$query['NNNNN'] = 'VVVVV';
   $requests[] = $query;

   $data['query'] = $requests;

   //$data['offset'] = ...;
   //$data['range'] =  ...;
   //$data['sort'] =  ...;

   $apiResult = $fm->apiFindRecords('Web_Project', $data);
}

if (! $fm->getIsError($apiResult)) {
   $responseData = $fm->getResponseData($apiResult);
   foreach ($responseData as $record) {
      fmLogger('Project Name = '. $record[FM_FIELD_DATA]['Name'] .' ColorIndex = '. $record[FM_FIELD_DATA]['ColorIndex']);
   }
//   fmLogger($apiResult);
}
else {
   $errorInfo = $fm->getMessageInfo($apiResult);
   fmLogger('Found error(s):');
   fmLogger($errorInfo);
}

echo fmGetLog();

?>
