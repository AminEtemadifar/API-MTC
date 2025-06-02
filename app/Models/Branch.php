<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    protected $table = 'info_branch';
    protected $primaryKey = 'CodeBrc';
    public function rank()
    {
        $this->belongsTo(Rank::class, 'CodeRnk');
    }
}
