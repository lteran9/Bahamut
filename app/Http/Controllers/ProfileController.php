<?php

namespace App\Http\Controllers;

use App\Bahamut;
use App\Profile;
use Illuminate\Http\Request;
use Coinbase\Pro\Client as HttpClient;

class ProfileController extends Controller
{
   private $system;

   function __construct(Bahamut $bhm)
   {
      $this->system = $bhm;
   }

   // [HttpGet, route('profiles')]
   public function list(Request $request)
   {
      $profiles = Profile::all();

      return view('profiles.list', compact('profiles'));
   }

   // [HttpPost, route('profiles.sync')]
   public function synchronize(Request $request)
   {
      // Calls coinbase and updates database
      $this->system->getProfiles();

      return redirect()->route('profiles');
   }
}
