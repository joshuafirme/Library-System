<?php

namespace App\Http\Controllers\Maintenance;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Input, DB, Excel, Session;

class BookCtr extends Controller
{
    public function index()
    {
        if(request()->ajax())
        {
            return datatables()->of($this->getBooks())
            ->addColumn('action', function($b){
                $button = ' <a class="btn btn-sm btn-primary" id="btn-edit-book" book-id="'. $b->id .'" 
                data-toggle="modal" data-target="#editBookModal"><i class="fa fa-edit"></i></a>';

                $button .= ' <a class="btn btn-sm btn-danger" id="btn-weed-book" book-id="'. $b->id .'" 
                data-toggle="modal" data-target="#weedModal"><i class="fa fa-archive"></i></a>';

                return $button;
            })
            ->rawColumns(['action'])
            ->make(true);      
        }

        return view('maintenance.book',[
            'category' => $this->getCategories()
        ]);
    }

    public function getBooks()
    {
       return DB::table('tbl_books AS B')
                ->select('B.*', DB::raw('CONCAT(B._prefix, B.accession_no) as accession_no,category,classification'))
                ->leftJoin('tbl_category AS C', 'C.id', '=', 'B.category_id')
                ->where('is_weed', 0)
                ->get();
    }

    

    public function store()
    {
        $data = Input::all();

        $category_id = $this->getCategoryID($data['category'],$data['classification']);

        $id = DB::table('tbl_books')
                ->insertGetId([
                    '_prefix' => 'ACN'.date('Y'),
                    'accession_no' => $this->getAccessionNo(),
                    'title' => $data['title'],
                    'author' => $data['author'],
                    'copies' => $data['copies'],
                    'publisher' => $data['publisher'],
                    'category_id' => $category_id,
                    'edition' => $data['edition'],
                    'no_of_pages' => $data['no_of_pages'],
                    'amount_if_lost' => $data['amount_if_lost'],
                    'cost' => $data['cost'],
                    'date_acq' => $data['date_acq'],
                    'date_published' => $data['date_published'],
                    'is_weed' => 0
                ]);

        return redirect('/book-maintenance')->with('success', 'Data Saved');
    }


    public function getCategoryID($category, $classification)
    {
      return DB::table('tbl_category')
                ->where('category', $category)
                ->where('classification', $classification)
                ->value('id');
    }

    public function getBookDetails($id)
    {
        return DB::table('tbl_books AS B')
                ->select('B.*', DB::raw('CONCAT(B._prefix, B.accession_no) as accession_no, category, classification'))
                ->leftJoin('tbl_category AS C', 'C.id', '=', 'B.category_id')
                ->where('B.id', $id)
                ->get();
    }

    public function update()
    {
        $data = Input::all();

        $category_id = $this->getCategoryID($data['category'],$data['classification']);

        DB::table('tbl_books')
            ->where('id', $data['id_hidden'])
            ->update([
                'title' => $data['title'],
                'author' => $data['author'],
                'publisher' => $data['publisher'],
                'copies' => $data['copies'],
                'category_id' => $category_id,
                'edition' => $data['edition'],
                'no_of_pages' => $data['no_of_pages'],
                'amount_if_lost' => $data['amount_if_lost'],
                'cost' => $data['cost'],
                'date_acq' => $data['date_acq'],
                'date_published' => $data['date_published'],
                'is_weed' => 0
            ]);


        return redirect('/book-maintenance')->with('success', 'Data updated successfully');
    }


    public function weed()
    {
        $data = Input::all();
        DB::table('tbl_books')
            ->where('id', $data['id_weed'])
            ->update([
                'is_weed' => 1
            ]);

        return redirect('/book-maintenance')->with('success', 'Book weed successfully');
    }

    public function getAccessionNo()
    {
        $sales_inv_no = DB::table('tbl_books')
        ->max('accession_no');
        $inc = ++ $sales_inv_no;
        return str_pad($inc, 5, '0', STR_PAD_LEFT);
    }

    public function getAccessionNo_ajax()
    {
        $sales_inv_no = DB::table('tbl_books')
        ->max('accession_no');
        $inc = ++ $sales_inv_no;
        return 'ACN' . date('Y') . str_pad($inc, 5, '0', STR_PAD_LEFT);
    }

    public function getCategories()
    {
       $categories = DB::table('tbl_category')->get();
       return $categories->unique('category');
    }


    function import(Request $request)
    {
        if ($request->input('submit') != null ){

            $file = $request->file('file');
      
            // File Details 
            $filename = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
            $tempPath = $file->getRealPath();
            $fileSize = $file->getSize();
            $mimeType = $file->getMimeType();
      
            // Valid File Extensions
            $valid_extension = array("csv");
      
            // 2MB in Bytes
            $maxFileSize = 2097152; 
      
            // Check file extension
            if(in_array(strtolower($extension),$valid_extension)){
      
              // Check file size
              if($fileSize <= $maxFileSize){
      
                // File upload location
                $location = 'uploads';
      
                // Upload file
                $file->move($location,$filename);
      
                // Import CSV to Database
                $filepath = public_path($location."/".$filename);
      
                // Reading file
                $file = fopen($filepath,"r");
      
                $importData_arr = array();
                $i = 0;
      
                while (($filedata = fgetcsv($file, 1000, ",")) !== FALSE) {
                   $num = count($filedata );
                   
                   // Skip first row (Remove below comment if you want to skip the first row)
                   if($i == 0){
                      $i++;
                      continue; 
                   }
                   for ($c=0; $c < $num; $c++) {
                      $importData_arr[$i][] = $filedata [$c];
                   }
                   $i++;
                }
                fclose($file);
      
                // Insert to MySQL database
                foreach($importData_arr as $importData){
      
                  $insertData = array(
                     "username"=>$importData[1],
                     "name"=>$importData[2],
                     "gender"=>$importData[3],
                     "email"=>$importData[4]);
                  Page::insertData($insertData);
      
                }
      
                Session::flash('message','Import Successful.');
              }else{
                Session::flash('message','File too large. File must be less than 2MB.');
              }
      
            }else{
               Session::flash('message','Invalid File Extension.');
            }
      
          }
      
          return redirect('/book-maintenance')->with('success', 'Data imported');
        }
}
