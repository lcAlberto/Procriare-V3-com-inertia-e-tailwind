<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckUserType
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        foreach ($roles as $role) {
            if ($request->user()->hasRole($role)) {
                return $next($request);
            }
        }

        if (in_production()) {
            flash()->error('Acesso não autorizado');
            return redirect()->route('home');
        }

        $message = 'Forbidden Route. ';
        $message .= "This resource was meant for '" . $this->getUserTypeLabel($roles[0]) . "' and ";
        $message .= "you are authenticated as '" . $this->getUserTypeLabel($request->user()->type) . "'.";

        return abort(403, $message);
    }

    private function getUserTypeLabel($userType)
    {
        return $userType;
    }
}
