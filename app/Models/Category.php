<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    /**
     * Tắt tính năng tự động quản lý các trường timestamps (created_at và updated_at).
     *
     * 
     */
    public $timestamps = false;

    use HasFactory;
}
