<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Memo
 *
 * @package App\Models
 */
class Memo extends Model
{
    use HasFactory;
    
    /**
     * @var list<string>
     */
    protected $fillable = [
        'description',
    ];
}
