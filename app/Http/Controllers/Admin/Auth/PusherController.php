<?php
namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Broadcasting\Broadcasters\PusherBroadcaster;
use Illuminate\Http\Request;
use Pusher\Pusher;

class PusherController extends Controller
{
    /**
     * Authenticates logged-in user in the Pusher JS app
     * For presence channels.
     */
    public function postAuth(Request $request)
    {
        $pusher = new Pusher(
            config('broadcasting.connections.pusher.key'),
            config('broadcasting.connections.pusher.secret'),
            config('broadcasting.connections.pusher.app_id')
        );
        $broadcaster = new PusherBroadcaster($pusher);

        /*
         * Since the dashboard itself is already secured by the
         * Authorize middleware, we can trust all channel
         * authentication requests in here.
         */
        return $broadcaster->validAuthenticationResponse($request, []);
    }
}
