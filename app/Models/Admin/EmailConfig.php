<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmailConfig extends Model
{
    use HasFactory;
    protected $fillable = ['driver','host', 'port','encryption','email_username','email_password','sendermail','pretend'];
}

