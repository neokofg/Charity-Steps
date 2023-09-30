<?php

namespace App\Services;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class StorageService {
    public function upload_file($r)
    {
        $rs = [128, 256, 512, 1024];
        $us = [
            'url' => null,
            'url_128' => null,
            'url_256' => null,
            'url_512' => null,
            'url_1024' => null
        ];
        $i = Image::make($r->getRealPath());
        $fn = $r->getFilename();
        $i_p = $fn . "_original.webp";
        $i->stream();
        Storage::disk('s3')->put($i_p, $i);
        $us['url'] = Storage::disk('s3')->url($i_p);

        foreach ($rs as $res) {
            $i = Image::make($r->getRealPath());

            if ($i->width() > $res) {
                $i->resize($res, null, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                });

                $i_p = $fn . "_" . $res . ".webp";
                $i->stream();
                Storage::disk('s3')->put($i_p, $i);

                $us['url_' . $res] = Storage::disk('s3')->url($i_p);
            }
        }
        return $us;
    }
}
