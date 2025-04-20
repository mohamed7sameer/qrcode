<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;



use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Writer\SvgWriter;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel;
use Endroid\QrCode\Label\LabelAlignment;
use Endroid\QrCode\RoundBlockSizeMode;


class Qrcode extends Model
{
    /** @use HasFactory<\Database\Factories\QrcodeFactory> */
    use HasFactory;

    use HasUuids;



    

    protected $guarded = [];


    public function qCategory()
    {
        return $this->belongsTo(QCategory::class);
    }

   /* 00 */
    public function getQrcodeSvgAttribute(){
        $qrcodeMode = config('qrcode.mode');
        $data = config('qrcode.' . $qrcodeMode . '.url'). $this->uuid;
        // $data =  config('app.qr_code_url')  . $this->uuid;
        $builder = new Builder(
            writer: new SvgWriter(),
            writerOptions: [
                SvgWriter::WRITER_OPTION_EXCLUDE_XML_DECLARATION => true
            ],
            data: $data,
            encoding: new Encoding('UTF-8'),
            errorCorrectionLevel: ErrorCorrectionLevel::High,
            // size: config('qrcode.width'),
            size: 500,
            margin: 1,
            // margin: 0,
            // roundBlockSizeMode: RoundBlockSizeMode::Margin,
            // logoPath: storage_path('logo.png'),
            logoResizeToWidth: 25,
        );
        return $builder->build()->getString() ;
    }
    
}
