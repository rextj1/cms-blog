<?php

namespace App\Http\Middleware;

use Closure;
use App\Category;

class VerifyCategoriesCount
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(Category::all()->count()== 0){
            return redirect(route('categories.create'))->with('error','You need to add Categories to be able to create Posts');
        }
        return $next($request);
    }
}
