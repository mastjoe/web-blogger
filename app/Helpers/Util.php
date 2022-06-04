<?php

namespace App\Helpers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class Util
{
    /**
     * gets slug form of specific column of a table
     *
     * @param string $string
     * @param string $table
     * @param string $column
     * @return string
     */
    public static function sluggify(
        string $string, 
        string $table="posts", 
        $column = "slug",
        $separator = "-"
    )
    {
        $slug = Str::slug($string, $separator);

        $count = intval(substr($slug, -1, 1)) ? intval(substr($slug, -1, 1)) : 1;
    
        while (DB::table($table)->where($column, $slug)->exists()) {

            $slug = preg_replace("/\d{1}$/", $count, $slug);

            if ($count == 1) {
                $slug = preg_replace("/\d{1}$/", $count, $slug.$separator.$count);
            }
            $count++;
        }

        return $slug;
    }
}