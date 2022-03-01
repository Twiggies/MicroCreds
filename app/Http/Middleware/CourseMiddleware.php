<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Course;
use App\Models\Enrollment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CourseMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();
        $course = Course::find($request->id);
        if ($user->type == "educator" && $user->id == $course->user_id) {
            return $next($request);
        }
        else if ($user->type == "student") {
            if (Enrollment::where('user_id', $user->id)->where('course_id', $request->id)->first()) {
                return $next($request);
            }
            else {
                return redirect(route('student_dashboard'));
            }
        }
        else {
            return redirect(route('dashboard'));
        }
        
    }
}
