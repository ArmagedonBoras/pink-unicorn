<?php

namespace App\Helpers;

class PhoneNumber
{
    public function __construct(protected string $number)
    {
    }

    public function __format(): string
    {
        $number = str_replace('+46', '0', $this->number); // ersätt +46 med 0
        $number = preg_replace("/[^0-9]/", "", $number); // ta bort alla tecken som inte är siffror
        $area = "";
        $sub = "";
        if (strlen($number) < 5) {
            return $number; // tresiffriga och fyrsiffriga nummer skrivs ihop
        } elseif (strlen($number) < 6) {
            if (substr($number, 0, 2) == "90") {
                return substr_replace($number, " ", 2, 0); // femsiffriga nummer som börjar på 90 har ett mellanslag mellan 2:e och 3:e siffran
            }
            return substr_replace($number, " ", 3, 0); // femsiffriga nummer har ett mellanslag mellan 3:e och 4:e siffran
        } elseif (strlen($number) == 6) {
            return substr_replace($number, " ", 3, 0); // sexsiffriga nummer utan riktnummer har ett mellanslag mellan 3:e och 4:e siffran
        } elseif (in_array(substr($number, 0, 4), ["0200", "0800", "0900"])) { // Fyrsiffriga där de två eller tre första även är giltigt riktnummer
            $area = substr($number, 0, 4);
            $sub = substr($number, 4);
        } elseif (substr($number, 0, 2) == "08") { // 08 är enda tvåsiffriga
            $area = "08";
            $sub = substr($number, 2);
        } elseif (substr($number, 0, 2) == "07") { // Alla 07x är tresiffriga
            $area = substr($number, 0, 3);
            $sub = substr($number, 3);
        } elseif (in_array(substr($number, 0, 3), ["010", "011", "013", "016", "018", "019", "020", "021", "023", "026", "031", "033", "035", "036", "040", "042", "044", "046", "054", "060", "063", "090", "099"])) {
            $area = substr($number, 0, 3);
            $sub = substr($number, 3);
        } else { // Alla andra riktnummer är fyrsiffriga
            $area = substr($number, 0, 4);
            $sub = substr($number, 4);
        }

        switch (strlen($sub)) {
            case 5:
                $sub = substr_replace($sub, " ", 3, 0);
                break;
            case 6:
                $sub = substr_replace($sub, " ", 4, 0);
                $sub = substr_replace($sub, " ", 2, 0);
                break;
            case 7:
                $sub = substr_replace($sub, " ", 5, 0);
                $sub = substr_replace($sub, " ", 3, 0);
                break;
            case 8:
            case 9:
                $sub = substr_replace($sub, " ", 6, 0);
                $sub = substr_replace($sub, " ", 3, 0);
                break;
            case 10:
                $sub = substr_replace($sub, " ", 8, 0);
                $sub = substr_replace($sub, " ", 6, 0);
                $sub = substr_replace($sub, " ", 3, 0);
                break;
            case 11:
                $sub = substr_replace($sub, " ", 8, 0);
                $sub = substr_replace($sub, " ", 5, 0);
                $sub = substr_replace($sub, " ", 3, 0);
                break;

            default:
        }

        return $area."-".$sub;
    }

    public function __web(): string
    {
        $number = $this->format();
        $number = str_replace(' ', '&nbsp;', $number);
        return $number;
    }

    public function __international(): string
    {
        $number = str_replace('+46', '0', $this->number); // ersätt +46 med 0
        $number = preg_replace("/[^0-9]/", "", $number); // ta bort alla tecken som inte är siffror
        $number = preg_replace("/^0/", "+46", $number); // byt ut riktnummersiffran till +46
        return $number;
    }

    public function __link(): string
    {
        return '<a href="tel:'.$this->international().'">'. $this->web().'</a>';
    }

    public function __call($name, $arguments)
    {
        switch($name) {
            case 'format':
                return $this->__format();
                break;
            case 'web':
                return $this->__web();
                break;
            case 'international':
                return $this->__international();
                break;
            case 'link':
                return $this->__link();
                break;
        }
        return;
    }

    public static function __callStatic($name, $arguments)
    {
        if (!isset($arguments[0])) {
            return;
        }
        $instance = new PhoneNumber($arguments[0]);
        switch($name) {
            case 'format':
                return $instance->format();
                break;
            case 'web':
                return $instance->web();
                break;
            case 'international':
                return $instance->international();
                break;
            case 'link':
                return $instance->link();
                break;
        }
        return;
    }

    public function __toString()
    {
        return $this->__format();
    }
}
