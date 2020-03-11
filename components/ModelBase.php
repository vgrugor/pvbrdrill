<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ControllerBase
 *
 * @author Zver
 */
class ModelBase {
    
    public static function getDate($date)
    {
        $timestamp = strtotime($date);
        
        if ($timestamp > 0) {
            $date = date('d.m.Y', $timestamp);
            return $date;
        }
        return '-';
    }
}
