<?php

declare(strict_types=1);

namespace App\Models;

use Database\Factories\MemoFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Memo
 *
 * @package App\Models
 */
class Memo extends Model
{
    /**
     * @use HasFactory<MemoFactory>
     */
    use HasFactory;

    /**
     * @var list<string>
     */
    protected $fillable = [
        'description',
    ];
}
