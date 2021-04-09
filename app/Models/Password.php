<?php


namespace App\Models;


use App\Libraries\Hashing;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Password
 * @package App\Models
 * @property-read string $rawPassword
 * @see \CreatePasswordsTable for columns
 */
class Password extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = "passwords";
    protected $fillable = [
        'label',
        'description',
        'password',
        'salt',
    ];

    /**
     * A MasterPassword has many password histories
     *
     * @return HasMany
     */
    public function passwordHistories(): HasMany
    {
        return $this->hasMany(PasswordHistory::class, 'password_id');
    }

    public function setPasswordAttribute(string $password) {
        // generating salt
        $this->attributes['salt'] = Hashing::generateSalt();
        $this->attributes['password'] = Hashing::encryptPassword(
            $password,
            $this->salt
        );
    }

    public function getRawPasswordAttribute(): string
    {
        return Hashing::decryptPassword(
            $this->password,
            $this->salt
        );
    }

    /**
     * Create a new record for PasswordHistory for the current password
     *
     * @return PasswordHistory
     */
    public function putCurrentPasswordAsHistory(): PasswordHistory
    {
        return $this->passwordHistories()->create([
            'password' => $this->password,
            'salt' => $this->salt
        ]);
    }
}
