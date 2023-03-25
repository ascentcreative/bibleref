<?php

namespace AscentCreative\BibleRef\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BibleRef extends Model
{

    use HasFactory;

    protected $table = 'bible_refs';
    protected $fillable = ['biblerefable_type', 'biblerefable_id', 'biblerefable_key', 'biblerefable_sort', 'ref', 'book_id', 'start_chapter', 'start_verse', 'start_verse_suffix', 'end_chapter', 'end_verse', 'end_verse_suffix', 'ref'];

    public function getSearchUrlAttribute() {

    //    return "/songs?biblerefs[ref]=$this->ref&biblerefs[book]=$this->book&biblerefs[startChapter]=$this->startChapter&biblerefs[startVerse]=$this->startVerse&biblerefs[endChapter]=$this->endChapter&biblerefs[endVerse]=$this->endVerse";

    }

    public function __toString() {
        $brp = new \AscentCreative\BibleRef\Parser();
        return $brp->makeBibleRefFromArray($this->toArray());
    }


}
 