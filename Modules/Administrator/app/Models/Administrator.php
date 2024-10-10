<?php

namespace Modules\Administrator\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;
use Modules\Administrator\Database\Factories\AdministratorFactory;
use Modules\File\Casts\UploadFile;
use Spatie\Permission\Traits\HasRoles;

class Administrator extends Authenticatable
{
    use HasApiTokens;
    use HasRoles;
    use HasFactory;
    use Notifiable;

    public const RESOURCE_NAME = 'Administrator';

    protected $table = 'user_administrators';

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'email',
        'password',
        'face_url',
        'first_name',
        'middle_name',
        'last_name',
        'suffix',
    ];

    protected $hidden = [
        'password',
    ];

    /**
     * Casts
     *
     * @return array
     */
    protected function casts(): array
    {
        return [
            'face_url' => UploadFile::class,
        ];
    }

    /**
     * Factory
     *
     * @return AdministratorFactory
     */
    protected static function newFactory(): AdministratorFactory
    {
        return AdministratorFactory::new();
    }

    /**
     * Passsword
     *
     * @return Attribute
     */
    protected function password(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => Hash::make($value),
        );
    }
}
