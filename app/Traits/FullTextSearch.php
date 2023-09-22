<?php

namespace App\Traits;

trait FullTextSearch
{
    private function addWildcards($search)
    {
        $reservedSymbols = ['-', '+', '<', '>', '@', '(', ')', '~'];
        $search = str_replace($reservedSymbols, '', $search);

        $tokens = explode(' ', $search);

        foreach ($tokens as &$w) {
            if (strlen($w) >= 3) {
                $w = $w.'*';
            }
        }

        return implode(' ', $tokens);
    }

    public function scopeSearch($query, $search)
    {
        $cols = [];
        foreach ($this->searchable as $s) {
            array_push($cols, $this->qualifyColumn($s));
        }
        $cols = implode(',', $cols);

        $searchQuery = $this->addWildcards($search);

        return $query->whereRaw("MATCH ({$cols}) AGAINST (? IN BOOLEAN MODE)", $searchQuery);
    }
}
