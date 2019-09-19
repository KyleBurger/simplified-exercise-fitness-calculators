<?php
/**
 * @package SimplifiedExerciseFitnessCalculators
 */

class SEDeactivate {
    public static function deactivate() {
        flush_rewrite_rules();
    }
}