<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    //
    public function loginScreen()
    {
        return view('backoffice.users.login');
    }

    public function connexion(Request $request)
    {
        try {
            //dd($request->all());
            $inputVal = $request->all();

            $this->validate($request, [
                'email' => 'required|email',
                'password' => 'required',
            ]);

            if (auth()->attempt(array('email' => $inputVal['email'], 'password' => $inputVal['password']))) {
                return redirect()->route('espace.administrateur');
            } else {
                //dd('Infromation invalide, veiller contacter notre service');
                return redirect('authentification')->with('error', 'Infromation invalide, veiller contacter notre service');
            }


        } catch (\Throwable $th){
            dd($th->getMessage());
            Log::error($th->getMessage());
            return redirect('error')->with('error','Infromation invalide, veiller contacter notre service');
        }
    }


    public function createbackofficeistrator(){
        $roles = User::rolebackoffice();
        return view('backoffice.users.createbackofficeistrator', ['roles'=>$roles]);

    }

    public function listbackofficeistrator()
    {
        $backofficeistrator = User::lisbackofficeistrator();
        $roles = User::rolebackoffice();
        //dd($backofficeistrator);
        return view('backoffice.users.listbackofficeistrator', ['roles' => $roles,'backofficeistrator' => $backofficeistrator]);
    }

    public static function validator(array $data)
    {
        //code...
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'phone' => ['required'],
            'role' => ['required'],
        ]);
    }


    public function savebackofficeistrator(Request $request)
    {
        try {
            //dd($request->all());
            $dataUsers = $this->validator($request->all());
            if ($dataUsers->fails()) {
                return redirect()->back()->withErrors($dataUsers)->withInput();
            }
            $validatedData = $dataUsers->validated();
            $savebackoffice = User::savebackoffice($validatedData);
            //dd($savebackoffice);
            return redirect('/liste/backofficeistrateur')->with('success', "Opération effectuée avec succès.");

        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return redirect('error')->with('error','Une erreur est survenus !s');
        }
    }

    public function updateInfobackoffice(Request $request){
        try{
            //dd($request->all());
            $validatedData = $request->all();
            $savebackoffice = User::savebackoffice($validatedData);
            return redirect('/liste/backofficeistrateur')->with('success', "Opération effectuée avec succès.");

        }catch (\Throwable $th) {
            Log::error($th->getMessage());
            return redirect('error')->with('error','Une erreur est survenus !s');
        }
    }

    public function forgetpasswordScreen()
    {
        return view('backoffice.users.forgetpassword');
    }


    public function pageError()
    {
        return view('backoffice.pageError');
    }

    public function changePassword(Request $request)
    {
        try {
            var_dump($request->all());

            $validator = Validator::make($request->all(), [
                'password' => ['required', 'string', 'min:8', 'confirmed'],
            ]);

            //$id_user = $request->get('id_user');
            $id_user = 9;

            if ($validator->fails()) {
                dd($validator)->withInput($request->all());
                return Redirect::back()->withErrors($validator)->withInput($request->all());
                //return "false";
            } else {

                $user = User::where('id', $id_user)->first();
                $user->password = Hash::make($request->get('password'));
                $user->save();

                return redirect('authentification')->with('success', 'Opération éffectué avec succès.');
            }
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            dd($th);
        }
    }

    public function logout()
    {
        try {
            //code...
            Session::flush();
            Auth::logout();
            return redirect('/');
        } catch (\Throwable $th) {
            //throw $th;
            $error = "Une erreur s'est produite, veuillez réessayer plus tard.";
            Log::error($th->getMessage());
            dd($th);
        }
    }

    //UPDATE PROFIL USER
    public function updateProfilUser(Request $request)
    {
        try {
            // Récupération de toutes les données de la requête
            $data = $request->all();
            // Vérifier si un fichier image est présent dans la requête
            if ($request->hasFile('file')) {
                // dd("Vérifier si un fichier image est présent dans la requête");
                $image = $request->file('file');
                // Obtenez le nom original du fichier
                $originalName = $image->getClientOriginalName();
                // Remplacez les espaces et autres caractères spéciaux par des tirets ou des chaînes vides
                $nameImageSansCaractere = preg_replace('/[^A-Za-z0-9\-_\.]/', '', $originalName);
                // Générer un nom unique pour l'image
                $name_img = time() . '_' . $nameImageSansCaractere;
                Storage::disk('public')->put($name_img, file_get_contents($image));
                // Ajouter le nom de l'image aux données de la requête
                $data['picture'] = $name_img;
            }
            // Créer un objet à partir des données de la requête
            $requestObject = (object)$data;
            // Mise à jour de la photo de profil
            if (isset($data['picture'])) {
                // dd("Mise à jour de la photo de profil");
                User::updatePhotoprofil($requestObject);
            }
            // dd($requestObject);
            // Mise à jour des autres informations du profil
            User::updateProfilbackoffice($requestObject);
            return redirect()->back()->with('success', "Opération effectuée avec succès.");
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return redirect()->back()->with('danger', 'Veuillez réessayer svp!');
        }
    }


    //UPDATE PROFIL USER
    public function changePasswordUser(Request $request)
    {
        try {
            $password = User::savePassword($request);
            return redirect()->back()->with('success', "Opération effectuée avec succès.");

        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return redirect()->back()->with('danger', 'Veuillez réessayer svp!');
        }
    }
}
