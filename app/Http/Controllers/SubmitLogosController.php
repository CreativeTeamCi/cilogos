<?php

namespace App\Http\Controllers;

use App\Mail\SubmissionMail;
use App\Models\ActivityArea;
use App\Models\BusinessLogo;
use App\Models\FailedMail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class SubmitLogosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['activity_areas'] = ActivityArea::orderBy('label','asc')->get();
        return view('pages.soumission.index',$data);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function activitiesArea()
    {
        $data= ActivityArea::orderBy('label','asc')->get();
        return response()->json([
            'error'=>false,
            'message'=>'Liste des logos recherchés.',
            'data'=>$data,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request['business_name_slug'] = Str::slug($request->business_name);
        $validator=Validator::make($request->all(),
            [
                'name'  =>'required|string',
                'email'  =>'required|email',
                // 'business_name'  =>'required|string',
                'business_name_slug'  =>'required|string|unique:business_logos,business_name_slug',
                'activity_areas_id'  =>'required|integer|exists:activity_areas,id',
                // 'url'  =>'required|url',
                // 'logo_svg'  =>'required|file|mimes:svg',
                'logo_png'  =>'required|file|mimes:png'
            ],
            [
                'name.*'  =>"Veuillez saisir votre nom",
                'email.*'  =>"L'adresse email saise est invalide",
                // 'business_name.required'  =>"Veuillez saisir un nom valide",
                // 'business_name.string'  =>"Veuillez saisir un nom valide",
                'business_name_slug.required'  =>"Veuillez saisir un nom valide",
                'business_name_slug.string'  =>"Veuillez saisir un nom valide",
                'business_name_slug.unique'  =>"Cette dénomination existe déjà",
                'activity_areas_id.*'  =>"Veuillez choisir le secteur d'activité svp",
                'url.*'  =>"Cette url n'existe pas",
                'logo_svg.*'  =>"Veuillez télécharger un fichier au format svg",
                'logo_png.*'  =>"Veuillez télécharger un fichier au format png"
            ]
        );

        $validator->sometimes('url',['required','url'],function() use ($request){
            return !is_null($request->logo_svg);
        });
        $validator->sometimes('logo_svg',['required','file','mimes:svg'],function() use ($request){
            return !is_null($request->logo_svg);
        });
        $validator->sometimes('url',['required','url'],function() use ($request){
            return !is_null($request->url);
        });
        if($validator->fails()) return $this->sendError($validator->errors()->messages(), null);
        $request['activity_areas']=ActivityArea::find($request->activity_areas_id)->slug;
        $businees_logo = BusinessLogo::create([
            'name'                  =>$request->name,
            'email'                 =>$request->email,
            'business_name'         =>$request->business_name,
            'business_name_slug'    =>Str::slug($request->business_name),
            'activity_areas_id'     =>$request->activity_areas_id,
            'url'                   =>$request->url,
            'logo_png'              =>$this->uploadPNGLogo($request),
            'logo_svg'              =>$this->uploadSVGLogo($request),
            'status'                =>'submitted',
        ]);

        // Sending Email
        try {
            Mail::to($request->email)
            ->send(new SubmissionMail($businees_logo));
            // - Save repport
            FailedMail::create([
                'name' => $request->name,
                'email' => $request->email,
                'business_name' => $request->business_name,
                'comment' => null,
                'status' => 'failed'
            ]);
        } catch (\Exception $e) {
            // - Save repport
            FailedMail::create([
                'name' => $request->name,
                'email' => $request->email,
                'business_name' => $request->business_name,
                'comment' => $e->getMessage(),
                'status' => 'failed'
            ]);
        }

        return response()->json(['message'=>"Votre logo a été soumis avec succès."],200);
    }

    public function uploadPNGLogo(Request $request){
        if(!is_file($request->logo_png) || is_null($request->logo_png)) return null;
        $folder=$request->activity_areas;
        $filename=Str::slug($request->business_name);
        $filename=$filename.'.'.$request->logo_png->extension();
        $path=$request->logo_png->move(storage_path('app/public/uploads/logos/png/'.$folder),$filename);
        return 'storage/uploads/logos/png/'.$folder.'/'.$filename;
    }

    public function uploadSVGLogo(Request $request){
        if(!is_file($request->logo_svg) || is_null($request->logo_svg)) return null;
        $folder=$request->activity_areas;
        $filename=Str::slug($request->business_name);
        $filename=$filename.'.'.$request->logo_svg->extension();
        $path=$request->logo_svg->move(storage_path('app/public/uploads/logos/svg/'.$folder),$filename);
        return 'storage/uploads/logos/svg/'.$folder.'/'.$filename;
    }

}
