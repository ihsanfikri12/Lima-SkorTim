<?php

namespace App\Http\Middleware;

use Closure;
use App\nilaiSprint;
use App\nilaiTim;

class skorFinalM
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
        $response = $next($request);

        $request2 = json_decode($response->getContent());
        $finalSprint = 0;
        $uts = 0;
        $uas = 0;

        $totalSprint = nilaiSprint::select('nilai','sprint_id','id')->where('tim_id',$request2->tim_id)->get();
    
        foreach($totalSprint as $value) {
            if($value->sprint_id == 11) {
                $uts = $value->nilai;
                continue;
            } else if ($value->sprint_id == 12) {
                $uas = $value->nilai;
                continue;
            }
            else {
                $finalSprint = ($finalSprint+$value->nilai);
            }
        } 
        $nilaiUts = $uts == 0 ? 0: $uts * (25/100);
        $nilaiUas = $uas == 0 ? 0: $uas * (25/100); 
        

        $totalFinal = nilaiTim::where('tim_id',$request2->tim_id);
        if (count($totalFinal==0)) {
            $totalFinal = new nilaiTim;
            $totalFinal->nilaiTim = $finalSprint==0? 0:(($finalSprint/10)*(45/100))+$nilaiUts+$nilaiUas;
            $totalFinal->save();
        
            foreach ($totalSprint as $sprintNilai) {
                $idSkorSprint = nilaiSprint::find($sprintNilai->id);
                $idSkorSprint->nilaiTim_id = $totalFinal->id;
                $idSkorSprint->save();
                
            }
        }
        
        $totalFinal->nilaiTim = $finalSprint==0? 0:(($finalSprint/10)*(45/100))+$nilaiUts+$nilaiUas;
        $totalFinal->save();
       
        
        foreach ($totalSprint as $sprintNilai) {
            $idSkorSprint = nilaiSprint::find($sprintNilai->id);
            $idSkorSprint->nilaiTim_id = $totalFinal->id;
            $idSkorSprint->save();
            
        }
        return $response;
    }
}
