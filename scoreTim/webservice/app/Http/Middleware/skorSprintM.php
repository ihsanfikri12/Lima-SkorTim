<?php

namespace App\Http\Middleware;

use Closure;
use App\nilaiDosen;
use App\nilaiPoint;
use App\nilaiSprint;
use App\nilaiTim;

class skorSprintM
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
        $nilaiDosen2 = 0;
        $nilaiPoint2 = 0;
        $nilaiDosen = nilaiDosen::select('TotalNilai')->where('tim_id',$request2->tim_id)->where('sprint_id',$request2->sprint_id)->get();
        $nilaiPoint = nilaiPoint::select('point')->where('tim_id',$request2->tim_id)->where('sprint_id',$request2->sprint_id)->get();
        
        foreach($nilaiDosen as $value) {
            $nilaiDosen2 = $nilaiDosen2+$value->TotalNilai;
        }

       

        foreach($nilaiPoint as $value) {
            $nilaiPoint2 = $nilaiPoint2+$value->point;
        }

        if($nilaiPoint2<=15 && $nilaiPoint2>=12.6) {
            $nilaiPoint2 = 100;
        } else if ($nilaiPoint2>=10.1 && $nilaiPoint2<12.6) {
            $nilaiPoint2 = 90;
        } else if ($nilaiPoint2>=7.6 && $nilaiPoint2<10.1) {
            $nilaiPoint2 = 81;
        } else if ($nilaiPoint2>=5.1 && $nilaiPoint2<7.6) {
            $nilaiPoint2 = 72;
        } else if ($nilaiPoint2>=2.6 && $nilaiPoint2<5.1) {
            $nilaiPoint2 = 63;
        } else if ($nilaiPoint2>=0.1 && $nilaiPoint2<2.6) {
            $nilaiPoint2 = 54;
        } else if ($nilaiPoint2>=2.5 && $nilaiPoint2<0.1) {
            $nilaiPoint2 = 45;
        } else if ($nilaiPoint2>=-5 && $nilaiPoint2<-2.5) {
            $nilaiPoint2 = 36;
        } else if ($nilaiPoint2>=-7.5 && $nilaiPoint2<-5) {
            $nilaiPoint2 = 27;
        } else if ($nilaiPoint2>=-10 && $nilaiPoint2<-7.5) {
            $nilaiPoint2 = 18;
        } else if ($nilaiPoint2>=-12.6 && $nilaiPoint2<-10) {
            $nilaiPoint2 = 9;
        } else if ($nilaiPoint2>=-15 && $nilaiPoint2<-12.5) {
            $nilaiPoint2 = 0;
        }

        $skorSprint = nilaiSprint::where('sprint_id',$request2->sprint_id)->where('tim_id',$request2->tim_id)->get();
        $point = $nilaiPoint2 == 0 ? 0:$nilaiPoint2 ;
        $DosenNilai = $nilaiDosen2 == 0 ? 0:$nilaiDosen2/count($nilaiDosen);
        // echo $skorSprint;
        if(count($skorSprint)==0) {
            $skorSprint = new nilaiSprint;
            $skorSprint->nilai = $point==0 || $DosenNilai==0 ? 0: (($point*(5/100))+($DosenNilai*(40/100)))*(100/45);
            $skorSprint->sprint_id = $request2->sprint_id;
            $skorSprint->tim_id = $request2->tim_id;
            $skorSprint->save();
        } else {
            $skorSprint = nilaiSprint::find($skorSprint[0]->id);
            $skorSprint->nilai = $point==0 || $DosenNilai==0 ? $skorSprint->nilai: (($point*(5/100))+($DosenNilai*(40/100)))*(100/45);
            $skorSprint->sprint_id = $request2->sprint_id;
            $skorSprint->tim_id = $request2->tim_id;
            $skorSprint->save();
        }

        
        $skorDosen3 = nilaiDosen::where('sprint_id',$request2->sprint_id)->where('tim_id',$request2->tim_id)->get();
        $skorPoint3 = nilaiPoint::where('sprint_id',$request2->sprint_id)->where('tim_id',$request2->tim_id)->get();
        
        foreach ($skorDosen3 as $dosen) {
            $idSkorSprint = nilaiDosen::find($dosen->id);
            $idSkorSprint->nilaiSprint_id = $skorSprint->id;
            $idSkorSprint->save();
            // echo $idSkorSprint->idSkorSprint;
        }

        foreach ($skorPoint3 as $point) {
            $idSkorSprint = nilaiPoint::find($point->id);
            $idSkorSprint->nilaiSprint_id = $skorSprint->id;
            $idSkorSprint->save();
            
        }

        

        $finalSprint = 0;
        $uts = 0;
        $uas = 0;

        $totalSprint = nilaiSprint::select('nilai','sprint_id','id','nilaiTim_id')->where('tim_id',$request2->tim_id)->get();
        $id = $totalSprint[0]->nilaiTim_id;
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
        

        $totalFinal = nilaiTim::where('tim_id',$request2->tim_id)->get();
        if (count($totalFinal)==0) {
            $totalFinal = new nilaiTim;
            $totalFinal->nilaiTim = $finalSprint==0? 0:(($finalSprint/10)*(45/100))+$nilaiUts+$nilaiUas;
            $totalFinal->tim_id = $request2->tim_id;
            $totalFinal->save();
        
            foreach ($totalSprint as $sprintNilai) {
                $idSkorSprint = nilaiSprint::find($sprintNilai->id);
                $idSkorSprint->nilaiTim_id = $totalFinal->id;
                $idSkorSprint->save();
                
            }

            return $response;
        }
        $totalFinal = nilaiTim::find($id);
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
