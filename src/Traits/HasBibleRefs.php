<?php

namespace AscentCreative\BibleRef\Traits;

use AscentCreative\CMS\Traits\Extender;
use AscentCreative\BibleRef\Models\BibleRef;

use Illuminate\Http\Request;

trait HasBibleRefs {

    use Extender;


    public function initializeHasBibleRefs() {
        $this->addCapturable('biblerefs');
    }

    public function saveBibleRefs($data) {

        // clear the stored bible refs:
        $this->biblerefs()->delete();
        // recreate with the new data:

        // dd($data);

        if(is_array($data ?? [])) {
            $this->biblerefs()->createMany(
                $data ?? []
            );
        }

    }

    public function deleteBibleRefs() {
        $this->biblerefs()->delete();
    }


    public function biblerefs() {
        return $this->morphMany(BibleRef::class, 'biblerefable');
    }




}