<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\admin\CmsModel;

class CheckLocale
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
        \App::setLocale('en');
        
        if( session()->get('locale') != "")
        {
            \App::setLocale(session()->get('locale'));
        }
        $locale= !empty(session()->get('locale')) ? session()->get('locale') : 'en' ;
        $details= CmsModel::select('key','text')->where('language_id',$locale)->get()->toArray();
        $count= CmsModel::select('key','text')->where('language_id',$locale)->count();
        $result = $this->formatArray($details);
        session(['locale_data' => $result]);  
        
        return $next($request);
    }

    private function formatArray($data){
        $result = [];
        if(!empty($data)) {
            foreach($data as $key=>$value) {
                $result[$value['key']] = $value['text'];
            }
        }
        return $result;
    }
}
