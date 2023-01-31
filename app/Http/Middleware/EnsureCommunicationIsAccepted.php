<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class EnsureCommunicationIsAccepted
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure(Request): (Response|RedirectResponse) $next
     * @return Response|RedirectResponse
     */
    public function handle(Request $request, Closure $next): Response|RedirectResponse
    {
        $communication = $request->route('communication');
        if ($communication->accepted === false) {
            return redirect()->route('communication.index')->with('error', 'Cette communication n\'est pas encore acceptée');
        }
        return $next($request);
    }
}
