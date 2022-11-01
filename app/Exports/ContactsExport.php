<?php

namespace App\Exports;

use App\Models\Contact;
use Maatwebsite\Excel\Concerns\FromCollection;

class ContactsExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
public function collection()
{
    return Contact::select("id", "firstname", "lastname", "email", "phone","address","nickname","company","status")->get();
}

/**
 * Write code on Method
 *
 * @return response()
 */
public function headings(): array
{
    return ["ID", "First Name","Last Name", "Email", "Phone", "Address", "Nickname", "Company", "Status"];
}


}
