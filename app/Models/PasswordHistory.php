<?php


namespace App\Models;


use App\Libraries\Hashing;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PasswordHistory extends Model
{
    use HasFactory;

    protected $table = 'password_histories';
    protected $fillable = [
        'password',
        'salt'
    ];

    /**
     * A Password History is belong to a single Password
     *
     * @return BelongsTo
     */
    public function mainPassword(): BelongsTo
    {
        return $this->belongsTo(Password::class, 'password_id');
    }

    public function getCreatedAtDateTextAttribute(): string
    {
        return $this->created_at->format('d/m/Y H:i:s');
    }

    public function getRawPasswordAttribute(): string
    {
        return Hashing::decryptPassword(
            $this->password,
            $this->salt
        );
    }

}
