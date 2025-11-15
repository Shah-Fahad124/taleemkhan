<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaperFormat extends Model
{
    protected $fillable = [
        'paper_type',
        'version',
        'mcq_easy',
        'mcq_medium',
        'mcq_hard',
        'fib_easy',
        'fib_medium',
        'fib_hard',
        'rrq_easy',
        'rrq_medium',
        'rrq_hard',
        'erq_easy',
        'erq_medium',
        'erq_hard'

    ];

}
