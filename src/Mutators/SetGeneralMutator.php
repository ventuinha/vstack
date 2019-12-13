<?php 

namespace marcusvbda\vstack\Mutators;

use Illuminate\Support\Arr;

class SetGeneralMutator extends BaseMutator{
    protected $needsAuth = true;
    public function process($content){
        $content["general"] = [
            "csrf_token" =>  csrf_token(),
            "root_url"   => url(''),
            "default_upload_route"   => Config("vstack.fields.summernote.default_upload_route")
        ];
        return $content;
    }
}