<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Uphlada extends Model {

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['id', 'id_vef', 'id_verk', 'uphlada_img', 'uphlada_file'];
	//

}
