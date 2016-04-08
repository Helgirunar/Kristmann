<?php namespace App\Http\Controllers;


use App\User;
use App\Vefspurn;
use App\Verktakar;
use App\Vefcomments;
use App\Profilecomments;
use App\Verkcomments;
use App\Verkefnaferills;
use App\Forsida;
use App\Uphlada;
use App\Http\Requests;
//use App\Http\Controllers\Controller;
use App\config;
use Request;
use Input;
use Auth;
?><html>
<head>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
</head>
<?php

class PagesController extends Controller {

  public function indextest()
  {
    return view('auth.login');
  }

  public function index()
    {
      if (Auth::guest())
      return view('auth.login');

    else
      $user = Auth::user();
      $vefsida = Vefspurn::orderBy('viewcount', 'desc')->get();
      $verktakar = Verktakar::orderBy('viewcount', 'desc')->get();
      $forsida = Forsida::get()->where('id', 1)->first();
      return view('indextest2', compact('user','vefsida','verktakar', 'forsida'));
    }
		public function frettin()
		{

			$input = Request::all();
			$frettedit = Forsida::get()->where('id', 1)->first();
			/*if(count($input) == 4)
			{
				$image_name = Request::file('photo')->getClientOriginalName();
				$inputt = Request::file('photo')->move(base_path().'/public/images/frettir', $image_name);
				$post = (Request::except(['photo']));
				$post['photo'] = $image_name;
				$pathToFile = '/images/frettir/' . $post['photo'];

				$frettedit->frettmynd = $pathToFile;
				$frettedit->frettdagsins = $input['frettinn'];

			}
			else*/
				$frettedit = Forsida::get()->where('id', 1)->first();
				$frettedit->frettdagsins = $input['frettinn'];

			$frettedit->save();
			return redirect()->back();
		}

  public function signUp()
	{
			return view('auth.register');
	}
  public function profile($username)
	{
    $user = Auth::user();
    $prouser = User::get()->where('username', $username)->first();
    $profilecomments = Profilecomments::latest('created_at')->get();
    $verkefnaf = Verkefnaferills::latest('created_at')->get();
    if($prouser->username == $user->username)
    {
		return view('profile', compact('user','profilecomments','prouser', 'verkefnaf'));

    }
    else {
      return view('profileguest', compact('user','profilecomments','prouser','verkefnaf'));
    }
	}

  public function store()
	{

			$input = Request::all();
    /*
      $user = User::where('username', '=' ,$input::get('username'))->first();
      if($user != null)
      {
        return redirect()->back();
    */

      if(User::find($input['username']))
      {
        ?>

        <html>
        <div class="alert alert-danger" role="alert" id="alertbox">
            <p class="alert-link">Notendanafn Í Notkun</p>
        </div>
        <script>
        $(document).ready(function(){
         setTimeout(function(){
        $("#alertbox").fadeOut("slow", function () {
        $("#alertbox").remove();
            });

        }, 1500);
        });
        </script>

        <?php

      }
      else
      {

  			$user = new User;
        $input['password'] = bcrypt($input['password']);
        $input['profilephoto'] = '/images/alfa.png';
        User::create($input);
        return redirect('/');
      }
	}

  public function vefsidur()
  {
    if (Auth::guest())
          return view('auth.login');

    else
    {
          $user = Auth::user();
          $vefsida = Vefspurn::orderBy('created_at', 'desc')->get();

          return view('vefsida', compact('vefsida', 'user'));
        }
  }

  public function verktak()
  {
    if (Auth::guest())
          return view('auth.login');

    else
    {
          $user = Auth::user();
          $verk = Verktakar::latest('published_at')->get();
          return view('verktakar', compact('verk', 'user'));

    }
  }

  public function show ($id)
  {
      if (Auth::guest())
        return view('auth.login');

        else
        {
        $user = Auth::user();
        $vefcomments = Vefcomments::latest('created_at')->get();
				$uphlada = Uphlada::latest('created_at')->get();
        $vefsida = Vefspurn::findOrFail($id);
        $vefsida->viewcount = $vefsida->viewcount + 1;
        $vefsida->save();

        return view('show', compact('vefsida','user','vefcomments', 'uphlada'));
      }
  }

  public function showverk ($id)
  {
      if (Auth::guest())
        return view('auth.login');

        else
        {
        $user = Auth::user();
				$uphlada = Uphlada::latest('created_at')->get();
        $verktakar = Verktakar::findOrFail($id);
        $verkcomments = Verkcomments::latest('created_at')->get();
        $verktakar->viewcount = $verktakar->viewcount + 1;
        $verktakar->save();

        return view('showverk', compact('verktakar','user','verkcomments', 'uphlada'));
      }
  }

public function create()
{
  if (Auth::guest())
        return view('auth.login');

  else
        {
        $user = Auth::user();
        return view('create',  compact('user'));
      }
}

public function createverk()
{
  if (Auth::guest())
        return view('auth.login');

  else
        {
        $user = Auth::user();
        return view('createVerk',  compact('user'));
      }
}

  public function VefStore()
	{
		$input = Request::all();
		$myndir = 0;
		$file = 0;
		//$upload = Uphlada::all();
		//dd($input);
		//Uphlada::create($input);
		$vefcreate = Vefspurn::create($input);
		//dd($input);
		$maxinput = sizeof($input);
		$id = $vefcreate['attributes']['id'];
		$array = [
    "id_vef" => $id,
		];
		$array1 = [
    "id_vef" => $id,
		];
		$z = 1;
		$u = 1;
		$r = 1;
		$input2 = array_values($input);
		for($b = 6; $b < $maxinput; $b++)
		{
			if(isset($input['uphladaimg' . $r]) && $input2[$b] == $input['uphladaimg' . $r])
			{
				$myndir++;
				$r += 1;
			}
			else{
				$file++;
			}
		}
		for($t = 0; $t < $file; $t++)
		{
			$upload_file = Request::file('uphladafile' . $z)->getClientOriginalName();
			$unitname2 = $input['title'] . $upload_file;
			$skra_file = Request::file('uphladafile' . $z);
			$skra_file->move(base_path().'/public/uploads', $unitname2);
			$array['uphlada_file'] = "/uploads/" . $unitname2;
			$array['uphlada_img'] = "null";
			Uphlada::create($array);
			$z += 1;
		}
		for($i = 0; $i < $myndir; $i++)
		{
			$upload_img = Request::file('uphladaimg' . $u)->getClientOriginalName();
			$unitname1 = $input['title'] . $upload_img;
			$skra_img = Request::file('uphladaimg' . $u);
			$skra_img->move(base_path().'/public/uploads', $unitname1);
			//dd(base_path().'/public/uploads', $unitname);
			$array1['uphlada_img'] = "/uploads/" . $unitname1;
			$array1['uphlada_file'] = "null";
			Uphlada::create($array1);
			$u += 1;
		}
		return redirect('/vefsida');
	}

  public function vefedit($id)
  {
    if (Auth::guest())
      return view('auth.login');

      else
      {
      $user = Auth::user();
      $vefsida = Vefspurn::findOrFail($id);

      return view('VefEdit', compact('vefsida','user'));
    }
  }
  public function verkedit($id)
    {
      if (Auth::guest())
        return view('auth.login');

        else
        {
        $user = Auth::user();
        $verktakar = Verktakar::findOrFail($id);

        return view('VerkEdit', compact('verktakar','user'));
      }
    }
public function vefedited($id){
  if (Auth::guest())
      return view('auth.login');
  else{
      $user = Auth::user();
      $input = Request::all();
      $vefsida = Vefspurn::find($input['id']);
			$uphlada = Uphlada::latest('created_at')->get();
      $vefcomments = Vefcomments::latest('created_at')->get();
      //dd($vefsida);
      $vefsida->title = $input['title'];
      $vefsida->body = $input['body'];

      $vefsida->save();
      return view('show', compact('user','vefsida','vefcomments', 'uphlada'));
  }
}


  public function VerkStore(){
    $input = Request::all();
		$maxinput = sizeof($input);
		$myndir = 0;
		$file = 0;

		$verkCreate = Verktakar::Create($input);
		$id = $verkCreate['attributes']['id'];
		$array = [
			"id_verk" => $id,
		];
		$array1 = [
				"id_verk" => $id,
			];
		$z = 1;
		$u = 1;
		$r = 1;
		$input2 = array_values($input);
		for($b = 6; $b < $maxinput; $b++)
		{
			if(isset($input['uphladaimg' . $r]) && $input2[$b] == $input['uphladaimg' . $r])
			{
				$myndir++;
				$r += 1;
			}
			else{
				$file++;
			}
		}
		for($t = 0; $t < $file; $t++)
		{
			$upload_file = Request::file('uphladafile' . $z)->getClientOriginalName();
			$unitname2 = $input['title'] . $upload_file;
			$skra_file = Request::file('uphladafile' . $z);
			$skra_file->move(base_path().'/public/uploads', $unitname2);
			$array['uphlada_file'] = "/uploads/" . $unitname2;
			$array['uphlada_img'] = "null";
			Uphlada::create($array);
			$z += 1;
		}
		for($i = 0; $i < $myndir; $i++)
		{
			$upload_img = Request::file('uphladaimg' . $u)->getClientOriginalName();
			$unitname1 = $input['title'] . $upload_img;
			$skra_img = Request::file('uphladaimg' . $u);
			$skra_img->move(base_path().'/public/uploads', $unitname1);
			//dd(base_path().'/public/uploads', $unitname);
			$array1['uphlada_img'] = "/uploads/" . $unitname1;
			$array1['uphlada_file'] = "null";
			Uphlada::create($array1);
			$u += 1;
		}
    return redirect('/verktakar');
  }
  public function verkedited($id)
  {
    if (Auth::guest())
        return view('auth.login');
    else
    {
      $user = Auth::user();
      $input = Request::all();
			$uphlada = Uphlada::latest('created_at')->get();
      $verktakar = Verktakar::find($input['id']);
      $verkcomments = Verkcomments::latest('created_at')->get();
      //dd($vefsida);
      $verktakar->title = $input['title'];
      $verktakar->body = $input['body'];

      $verktakar->save();
      return view('showverk', compact('user','verktakar','verkcomments', 'uphlada'));
    }
  }
public function PhotoId(){
  $user = Auth::user();
  $image_name = Request::file('photo')->getClientOriginalName();
  $unitname = $user->id . $image_name;
  Request::file('photo')->move(base_path().'/public/images', $unitname);
  $post = (Request::except(['photo']));
  $post['photo'] = $unitname;
  $pathToFile = '/images/' . $post['photo'];
  $user->profilephoto = $pathToFile;
  $user->save();
  return redirect()->back();
}

  public function editDescription()
  {
    $user = Auth::user();
    $input = Request::all();

    $user->description = $input['descritionEdited'];
    $user->save();
    return redirect()->back();
  }
  public function vefComments()
  {

      $user = Auth::user();
      $input = Request::all();
      Vefcomments::Create($input);
      return redirect()->back();
  }
  public function verkComments()
  {

      $user = Auth::user();
      $input = Request::all();
      Verkcomments::Create($input);
      return redirect()->back();
  }

  public function profileComments()
  {

      $user = Auth::user();
      $input = Request::all();
      profilecomments::Create($input);
      return redirect()->back();
  }
  public function contact()
  {

          $user = Auth::user();
    return view("/Contact", compact('user'));
  }
  public function kristmann()
  {
        $user = Auth::user();
    return view("/Kristmann", compact('user'));
  }
  public function helgi()
  {
        $user = Auth::user();
    return view("/Helgi", compact('user'));
  }
	public function veljamann($username)
  {
      $input = Request::all();
      $vefmann = Vefspurn::find($input['post_id']);
      $user = User::get()->where('username', $input['post_user'])->first();
      $user->verkefni = $input['post_title'];
      $vefmann->starfsmadur = $input['post_user'];
      $user->save();
      $vefmann->save();

      Verkefnaferills::Create($input);

      return redirect()->back();
  }
	  public function Veljaverktaka($username)
	  {
	      $input = Request::all();
	      $verkmann = Verktakar::find($input['post_id']);
	      $user = User::get()->where('username', $input['post_user'])->first();
	      $user->verkefni = $input['post_title'];
	      $verkmann->starfsmadur = $input['post_user'];
	      $user->save();
	      $verkmann->save();

	      Verkefnaferills::Create($input);

	      return redirect()->back();
	  }

  public function breytacommentsvef()
  {
		$input = Request::all();
		$vefcomments = Vefcomments::find($input['id']);
		$vefcomments->comment = $input['comment'];
		$vefcomments->save();
    return redirect()->back();
  }

	public function breytacommentsverk()
	{
		$input = Request::all();
		$verkcomments = Verkcomments::find($input['id']);
		$verkcomments->comment = $input['comment'];
		$verkcomments->save();
		return redirect()->back();
	}
	public function breytacommentsprofile()
	{
		$input = Request::all();
		$profilecomments = Profilecomments::find($input['id']);
		$profilecomments->comment = $input['comment'];
		$profilecomments->save();
		return redirect()->back();
	}

}//slaufusvigi??
