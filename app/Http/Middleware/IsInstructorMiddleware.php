<?php

namespace App\Http\Middleware;

use App\Models\Instructor;
use App\Models\Organization;
use Closure;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Str;

class IsInstructorMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (auth()->check()) {
            if (auth()->user()->role_id == 2) {
                // Load instructor relationship if not already loaded
                $user = auth()->user();
                if (!$user->relationLoaded('instructor')) {
                    $user->load('instructor');
                }
                
                // Check if user has an instructor record
                if (!$user->instructor) {
                    // Try to auto-create instructor record with default organization
                    $defaultOrg = Organization::first();
                    if ($defaultOrg) {
                        try {
                            Instructor::create([
                                'user_id' => $user->id,
                                'organization_id' => $defaultOrg->id,
                                'slug' => Str::slug($user->name . '-' . $user->id),
                            ]);
                            // Reload the relationship
                            $user->load('instructor');
                        } catch (\Exception $e) {
                            Toastr::error(__('instructor_not_found') . ': ' . $e->getMessage());
                            return redirect()->route('home');
                        }
                    } else {
                        Toastr::error(__('instructor_not_found'));
                        return redirect()->route('home');
                    }
                }
                
                // Check if instructor has an organization
                if (!$user->instructor || !$user->instructor->organization_id) {
                    Toastr::error(__('instructor_not_found'));
                    return redirect()->route('home');
                }
                
                return $next($request);
            }
        }

        return redirect()->route('login');
    }
}
