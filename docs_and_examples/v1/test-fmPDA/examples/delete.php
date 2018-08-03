<?php
// *********************************************************************************************************************************
//
// delete.php
//
// This test creates a record in the database and then deletes it.
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

$fm = new fmPDA(FM_DATABASE, FM_HOST, FM_USERNAME, FM_PASSWORD);

// First, add a record to the database, get the returned recordID, then delete it.
$addCommand = $fm->newAddCommand('Web_Project');
$addCommand->setField('Name', 'Project '. rand());
$addCommand->setField('Date_Start', date('m/d/Y'));
$addCommand->setField('Date_End', date('m/d/Y'));
$addCommand->setField('ColorIndex', 999);

$result = $addCommand->execute();

if (! fmGetIsError($result)) {
   fmLogger('Project Name = '. $result->getField('Name'));
//    fmLogger($result);
   $recordID = $result->getRecordId();
   fmLogger('Record ID of added record: '. $recordID);
   if ($recordID != '') {
      $deleteCommand = $fm->newDeleteCommand('Web_Project', $recordID);
      $result = $deleteCommand->execute();

      if (! fmGetIsError($result)) {
         fmLogger($result);
      }
      else {
         fmLogger('Error = '. $result->getCode() .' Message = '. $result->getMessage());
      }
   }
}
else {
   fmLogger('Error = '. $result->getCode() .' Message = '. $result->getMessage());
}

echo fmGetLog();

?>