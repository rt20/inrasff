<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Storage;

class Helper{
    public static function initPath($path){
		$arrPath = explode('/', $path);
		
		$cur = '';
		foreach($arrPath as $val){
			$cur .= '/'.$val;
			if(!Storage::disk('public')->exists($cur))
				Storage::disk('public')->makeDirectory($cur);
		}
		// dd($arrPath);
	}

	/**
	 * Format date to be displayed on views
	 */
	public static function displayDateFormat(string $dateString, string $format = "Y-m-d H:i:s")
	{
		return \Carbon\Carbon::createFromFormat($format, $dateString);
	}
}