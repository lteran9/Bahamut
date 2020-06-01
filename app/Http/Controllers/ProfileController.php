<?php

namespace App\Http\Controllers;

use App\Profile;
use Illuminate\Http\Request;
use Coinbase\Pro\Client as HttpClient;

class ProfileController extends Controller
{
    private $coinbaseAPI;

    function __construct(HttpClient $client)
    {
        $this->coinbaseAPI = $client;
    }

    // [HttpGet, route('profiles')]
    public function list(Request $request)
    {
        $coinbaseProfiles = new \Coinbase\Pro\Profiles\Profiles($this->coinbaseAPI);
        $coinbaseProfiles = $coinbaseProfiles->get();

        if (count($coinbaseProfiles) > 0) {
            foreach($coinbaseProfiles as $profile) {
                $dbProfile = Profile::find($profile->id);
                if (!isset($dbProfile)) {
                    Profile::create([
                        'id' => $profile->id,
                        'user_id' => $profile->user_id,
                        'name' => $profile->name,
                        'active' => $profile->active,
                        'is_default' => $profile->is_default,
                        'coinbase_created_at' => date('Y-m-d H:i:s', strtotime($profile->created_at))
                    ]);
                }
            }
        }

        $profiles = Profile::all();

        return view('profiles.list', compact('profiles'));
    }
}
