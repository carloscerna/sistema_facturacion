<?php 
  
// PHP program to set a date time value in excel sheet 
require_once('vendor/autoload.php'); 
  
use PhpOffice\PhpSpreadsheet\Spreadsheet; 
use PhpOffice\PhpSpreadsheet\Writer\Xlsx; 
   
// Creates New Spreadsheet 
$spreadsheet = new Spreadsheet();  
  
// Retrieve the current active worksheet 
$sheet = $spreadsheet->getActiveSheet();  
   
// Set the number format mask so that the excel timestamp  
// will be displayed as a human-readable date/time 
/*$spreadsheet->getActiveSheet()->getStyle('A1') 
    ->getNumberFormat() 
    ->setFormatCode( 
    \PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_DATE_YYYYMMDD
    ); 
  */ 
// Get current date and timestamp 
// Convert to an Excel date/time 
$dateTime = "27/04/2019";  
$excelDateValue = \PhpOffice\PhpSpreadsheet\Shared\Date::PHPToExcel( 
                  $dateTime );  
   
// Set cell A1 with the Formatted date/time value 
$sheet->setCellValue('A1',$excelDateValue); 

$NumFecha = $sheet->getActiveSheet()->getCell('A1');   
   
// Excel-date/time
$sheet->getActiveSheet()->setCellValue('D1', $NumFecha)
$sheet->getActiveSheet()->getStyle('D1')
    ->getNumberFormat()
    ->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_DATE_YYYYMMDDSLASH);   
   
// Write an .xlsx file  
$writer = new Xlsx($spreadsheet); 
  
// Save .xlsx file to the current directory 
$writer->save('gfgdate.xlsx'); 
?> 