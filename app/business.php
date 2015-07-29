<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class business extends Model {

	protected $fillable = [
                        'name',
                        'description',
                        'telephone',
                        'address',
                        'link'];
    public function Users() {
        return $this->belongsTo('App\User');
    }
}
