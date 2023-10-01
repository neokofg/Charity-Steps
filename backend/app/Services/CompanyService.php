<?php

namespace App\Services;

use App\Models\Company;
use App\Models\CompanyAvatar;
use App\Models\CompanyInvites;
use App\Models\News;
use App\Models\NewsImage;
use Carbon\Carbon;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Throwable;

class CompanyService {
    public function __construct(private StorageService $storageService)
    {
        $this->relations = [
            "avatar",
            "news",
            "charities",
            "users"
        ];
    }

    public function get_company($r, $u): mixed
    {
        if(!$u->isCompanyUser($r['company_id'])){
            return false;
        }
        try {
            return Company::where("company_id","=",$r['company_id'])->with($this->relations)->get();
        } catch (Throwable $e) {
            return false;
        }
    }
    public function create_link($r, $u): mixed
    {
        if(!$u->isCompanyUser($r['company_id'])){
            return false;
        }
        try {
            $c = Company::findOrFail($r['company_id']);
            $h = Crypt::encryptString($c->id . " " . Carbon::now()->format("Y-m-d"));
            $c_i = new CompanyInvites();
            $c_i->hash = $h;
            $c_i->company_id = $c->id;
            $c_i->save();
            return "https://inv.charity-steps.ru/company?hash=". $h;
        } catch (Throwable $e) {
            return false;
        }
    }

    public function create_news($r, $u):mixed
    {
        if(!$u->isCompanyUser($r['company_id'])){
            return false;
        }
        try {
            DB::transaction(function() use($r, $u) {
                $n = new News();
                $n->title = $r['title'];
                $n->content = $r['content'];
                $n->company_id = $r['company_id'];
                $n->save();

                if(isset($r['images'])){
                    foreach($r['images'] as $image) {
                        $us = $this->storageService->upload_file($image);
                        $i = new NewsImage();
                        $i->url = $us['url'];
                        $i->url_128 = $us['url_128'] ?? null;
                        $i->url_256 = $us['url_256'] ?? null;
                        $i->url_512 = $us['url_512'] ?? null;
                        $i->url_1024 = $us['url_1024'] ?? null;
                        $i->news_id = $n->id;
                        $i->save();
                    }
                }
            });
            return true;
        } catch (Throwable $e) {
            return false;
        }
    }

    public function update_avatar($r, $u): Bool
    {
        if(!$u->isCompanyUser($r['company_id'])){
            return false;
        }
        try {
            $us = $this->storageService->upload_file($r['file']);
            $c_a = CompanyAvatar::firstOrCreate([
                "company_id" => $r['company_id'],
            ]);
            $c_a->url = $us['url'];
            $c_a->url_128 = $us['url_128'] ?? null;
            $c_a->url_256 = $us['url_256'] ?? null;
            $c_a->url_512 = $us['url_512'] ?? null;
            $c_a->url_1024 = $us['url_1024'] ?? null;
            $c_a->save();

            return true;
        } catch(Throwable $e) {
            return false;
        }
    }
}
