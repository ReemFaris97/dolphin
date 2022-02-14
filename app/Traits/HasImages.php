<?php

namespace App\Traits;
use Illuminate\Database\Eloquent\Concerns\HasAttributes;

trait HasImages
{
    public function setAttribute($key, $value)
    {
        if (in_array($key, $this->images)) {
            $value = Fileuploader($value);
        }

        // Handover the rest to Laravel's own setAttribute(), so that other
        // mutators will remain intact...
        return parent::setAttribute($key, $value);
    }
    public function getAttribute($key)
    {
        if (in_array($key, $this->images)) {
            $this->attributes[$key] = asset($this->attributes[$key]);
        }

        // Handover the rest to Laravel's own setAttribute(), so that other
        // mutators will remain intact...
        return parent::getAttribute($key);
    }
}
