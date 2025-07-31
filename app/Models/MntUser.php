<?php

namespace App\Models;


use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Laravel\Passport\HasApiTokens;


class MntUser extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, Notifiable, SoftDeletes;
    protected $table = "mnt_user";
    protected $primaryKey = "id";
    protected $fillable = [
        "id",
        "id_people",
        "user_name",
        "password",
        "id_status",
        "last_access",
        "is_validated",
        "email_verified_at"
    ];
    protected $casts = ["last_access" => 'datetime', "is_validated" => "boolean"];

    protected $hidden = ['password', "remember_token"];

    public function people(): BelongsTo
    {
        return $this->belongsTo(MntPeople::class, "id_people", "id");
    }
    public function rol(): BelongsToMany
    {
        return $this->belongsToMany(MntRol::class, "user_rol", "id_user", "id_rol");
    }
    public function status() : BelongsTo {
        return $this->belongsTo(CtlStatus::class);
    }

    public function findForPassport($username)
    {
        return $this->where('user_name', $username)->first();
    }

    public function validateForPassportPasswordGrant($password)
    {
        return Hash::check($password, $this->password);
    }

    public function getEmailForVerification(): string
    {
        if (!$this->relationLoaded('people')) {
            $this->load('people');
        }
        Log::info($this->people->email);
        return $this->people->email;
    }

    public function hasVerifiedEmail(): bool
    {
        return (bool) $this->is_validated;
    }

    public function markEmailAsVerified(): bool
    {
        return $this->forceFill(["is_validated" => true,])->save();
    }

    // public function sendEmailVerificationNotification()
    // {
    //     Log::info('Enviando verificación a: ' . $this->getEmailForVerification());
    //     parent::sendEmailVerificationNotification();
    // }

    public function routeNotificationForMail($notification)
{
    return $this->getEmailForVerification();
}
}
