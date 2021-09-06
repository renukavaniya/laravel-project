<?php

namespace App\Exports;

use App\Models\Borrow;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class BydateExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        /*$borrow = new Borrow();

$borrow->getAllBooks();
return $borrow;*/
        //return Borrow::all();
        
        return collect(Borrow::getBooks());
    }
    public function headings():array
    {
        return[
          'Firstname',
          'Title',
          'Author',
          'ISBN',
          'Language',
          'Genres',
          'Issue_date'
        ];
    }
}
