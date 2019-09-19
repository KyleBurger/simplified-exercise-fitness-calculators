<?php
/**
 * @package SimplifiedExerciseFitnessCalculators
 */

class SEActivate {
    public static function activate() {
        flush_rewrite_rules();
    }
}