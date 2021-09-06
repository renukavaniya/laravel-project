<?php

namespace App\Imports;

use App\Models\Book;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class BookImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Book([
            //
            'title'=>$row['title'],
            'author'=>$row['author'],
            'publisher'=>$row['publisher'],
            'isbn'=>$row['isbn'],
            'description'=>$row['description'],
            'language'=>$row['language'],
            'genres'=>$row['genres'],
            'isbn'=>$row['isbn'],
            'image'=>$row['image'],
            'quantity'=>$row['quantity']
        ]);
    }
}
