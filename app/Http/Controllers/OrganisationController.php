<?php

namespace App\Http\Controllers;

use App\Models\Organisation;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Session;
use Exception;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB as FacadesDB;
use Illuminate\Support\Facades\File;

class OrganisationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function showOrganisation(Request $request)
    {
        try {
            if ($request->ajax()) {
                $Organisation = Organisation::latest()->get();
                return DataTables::of($Organisation)
                    ->addIndexColumn()
                    ->addColumn('action', function($row) {
                        $encryptedId = encrypt($row->id);
                        $editUrl = route('edit-organisation', ['id' => $encryptedId]);
                        $deleteUrl = route('delete-organisation', ['id'=>$encryptedId]);
                       
                     $actionBtn = '<a href="' . $editUrl . '" title="Edit" class="menu-link flex-stack px-3" style="font-weight:normal !important;"><i class="fa fa-edit" id="ths" style="font-weight:normal !important;"></i></a>
                     <a  href="' . $deleteUrl . ' "title="Delete"   style="cursor: pointer;font-weight:normal !important;" class="menu-link flex-stack px-3"><i class="fa fa-trash" style="color:red"></i></a>';
                     return $actionBtn;
                    })
                    ->rawColumns(['action'])
                    
                    ->make(true);
            }
        } catch (Exception $exception) {
            return back()->withError($exception->getMessage())->withInput();
        }

          
        return view('admin.Organisation.showOrganisation');
    }

  
    public function storeOrganisation(Request $request)
    {
     
        $request->validate([
            'name' => 'required',
            'code' => 'required|unique:organisation_master',
        ]);

        // $code=$request->name;
        // $emails = explode(',', $code);
        // $validatedEmails = array_map('trim', $emails);
        // $validatedEmails = array_filter($validatedEmails, 'filter_var', FILTER_VALIDATE_EMAIL);
        // dd($validatedEmails);
        FacadesDB::beginTransaction();
        try {
             Organisation::create($request->all());
             FacadesDB::commit();
            //create  new folder in public folder with organisation code.
             $orgCode=$request->code;
            $publicPath = public_path("Organisation/{$orgCode}");
            if (!File::isDirectory($publicPath)) {
                File::makeDirectory($publicPath, 0755, true);
            }
        } catch (Exception $exception) {

            FacadesDB::rollback();
            return back()->withError($exception->getMessage())->withInput();

        }

        Session::flash('message', 'Organisation Added Successfully.!');
        return redirect('show-organisation');
                       
    }
   
    
    public function editOrganisation($id)
    {

        $Organisation = Organisation::find(decrypt($id));
        return view('admin.Organisation.editOrganisation' , ['Organisation'=>$Organisation]);
       
    }

    public function updateOrganisation(Request $request,$id)
    {
        // dd($id);
        $request->validate([
            'name' => 'required',
           
        ]);
        FacadesDB::beginTransaction();
        try {
            $org = Organisation::find(decrypt($id));
            $org->update($request->all());
            
            FacadesDB::commit();
        } catch (Exception $exception) {

            FacadesDB::rollback();
            return back()->withError($exception->getMessage())->withInput();

        }
        Session::flash('message', 'Organisation update Successfully.!');
        return redirect('show-organisation');
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroyOrganisation($id)
    {
        FacadesDB::beginTransaction();
        try {
            $deleteOrg = Organisation::find(decrypt($id));
            $deleteOrg->delete();
            FacadesDB::commit();
        } 
        catch (Exception $exception) {
            FacadesDB::rollback();
            
            return back()->withError($exception->getMessage())->withInput();
        }
        Session::flash('message', 'Organisation deleted Successfully.!');
        return redirect('show-organisation');
                       

    }
}
