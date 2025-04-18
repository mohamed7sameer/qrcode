<?php

namespace App\Observers;

use App\Models\QCategory;
use App\Models\Qrcode;
use Illuminate\Support\Facades\DB;
// use BaconQrCode\Encoder\QrCode;
use Illuminate\Support\Str;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Nova;



class QcategoryObserver
{

    


    public function created(QCategory $model): void
    {


        // $this->createSVQrcode('aaa');

        



        Nova::whenServing(function (NovaRequest $request) use ($model) {
            $id = $model->id;
            $count = $model->count;
            $now = now();
            
            
            $batchSize = 1000;
            $totalBatches = ceil($count / $batchSize);
            
            for ($batch = 0; $batch < $totalBatches; $batch++) {
                $records = [];
                $start = $batch * $batchSize;
                $end = min(($batch + 1) * $batchSize, $count);
                
                for ($i = $start; $i < $end; $i++) {
                    $qrcode = new Qrcode();
                    $records[] = [
                        'uuid' => $qrcode->newUniqueId(),
                        'q_category_id' => $id,
                        'created_at' => $now,
                        'updated_at' => $now,
                        // add other required fields here
                    ];
                }
                
                // استخدام المعاملات للتأكد من السلامة
                DB::transaction(function () use ($records) {
                    Qrcode::insert($records);
                });
                
                // إعطاء النظام فرصة للتنفس بين الدفعات
                if ($batch % 10 === 0) {
                    sleep(1); // تأخير قصير كل 10 دفعات
                }
            }
        });
    
    
    }
}
