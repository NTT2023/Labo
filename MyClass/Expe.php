<?php

class Expe
{
    public $id,$name,$content,$date;

    // public function __construct(int $id, string $name, string $content, int $date)
    // {
    //     $this->id = $id;
    //     $this->name = $name;
    //     $this->content = $content;
    //     $this->date = $date;
    // }

    public function getResume() {
        return substr($this->content, 0, 50);
    }

    public function getDate()
    {
        $formatter = new IntlDateFormatter('fr_FR', IntlDateFormatter::SHORT, IntlDateFormatter::SHORT);
        return $formatter->format($this->date);
    }
}
