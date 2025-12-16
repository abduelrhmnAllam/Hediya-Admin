<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;

class Attachment extends Model
{
    use HasFactory;

    protected $fillable = [
        'person_id',
        'file',
        'product_name',
        'product_brand',
        'price',
        'store_name',
        'note',
    ];

    /*
    |--------------------------------------------------------------------------
    | Mutator: setFileAttribute
    |--------------------------------------------------------------------------
    | Supports:
    | - Uploaded File
    | - Direct URL
    | - Base64
    | Saves files using the real file extension (jpg, png, pdf)
    | Stores only the relative path in the database
    |--------------------------------------------------------------------------
    */
    public function setFileAttribute($value)
    {
        if (!$value) {
            $this->attributes['file'] = null;
            return;
        }

        // Direct URL
        if (filter_var($value, FILTER_VALIDATE_URL)) {
            $this->attributes['file'] = $value;
            return;
        }

        // Uploaded File
        if ($value instanceof UploadedFile) {
            $originalName = pathinfo($value->getClientOriginalName(), PATHINFO_FILENAME);
            $extension    = $value->getClientOriginalExtension();
            $fileName     = $originalName . '_' . time() . '.' . $extension;

            $path = $value->storeAs('attachments', $fileName, 'public');

            // Store only the relative path (no /storage prefix)
            $this->attributes['file'] = $path;
            return;
        }

        // Base64 File
        if (preg_match('/^data:(.*);base64,/', $value, $matches)) {
            $mimeType = $matches[1]; // image/png, image/jpeg, application/pdf

            $extension = match ($mimeType) {
                'image/jpeg'       => 'jpg',
                'image/png'        => 'png',
                'application/pdf' => 'pdf',
                default            => 'bin',
            };

            $fileData = substr($value, strpos($value, ',') + 1);
            $fileName = 'attach_' . uniqid() . '.' . $extension;

            Storage::disk('public')->put(
                'attachments/' . $fileName,
                base64_decode($fileData)
            );

            $this->attributes['file'] = 'attachments/' . $fileName;
            return;
        }

        // Fallback for any other value
        $this->attributes['file'] = $value;
    }

    /*
    |--------------------------------------------------------------------------
    | Accessor: file_url
    |--------------------------------------------------------------------------
    | Returns a full public URL for the stored file
    |--------------------------------------------------------------------------
    */
    public function getFileUrlAttribute()
    {
        if (!$this->file) {
            return null;
        }

        // If the stored value is already a full URL
        if (filter_var($this->file, FILTER_VALIDATE_URL)) {
            return $this->file;
        }

        return asset('storage/' . $this->file);
    }

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */
    public function person()
    {
        return $this->belongsTo(People::class);
    }
}
