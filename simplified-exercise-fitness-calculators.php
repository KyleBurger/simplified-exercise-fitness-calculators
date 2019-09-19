<?php
/**
 * @package SimplifiedExerciseFitnessCalculators
 */
/*
Plugin Name: Simplifed Exercise Fitness Calculators
Plugin URI: https://simplifedexercise.com
Description: This is a custom plugin for fitness calculators
Version: 1.0.0
Author: Kyle Burger
Author URI: https://simplifiedexercise.com
License: GPLv2 or later
Text Domain: simplified-exercise-fitness-calculators
*/

/*
This program is free software; you can redistribute it and/or 
modify it under the terms of the GNU General Public License
as published by the Free Software Foundats; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of 
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA 02110-1301, USA.

Copyright 2005-2015 Automattic, Inc.
*/

defined( 'ABSPATH' ) or die( 'Hey, you\'re not supposed to be here... What are you up to?' );

class SEFitnessCalculators {
    public $plugin;
    
    function __construct() {
        $this->plugin = plugin_basename( __FILE__ );
    }
    
    function register() {
        add_shortcode( 'se-bmr-calc', array( $this, 'se_bmr_shortcode' ));
        add_shortcode( 'se-bmi-calc', array( $this, 'se_bmi_shortcode' ));
        add_shortcode( 'se-lbm-calc', array( $this, 'se_lbm_shortcode' ));
        add_shortcode( 'se-wi-calc', array( $this, 'se_wi_shortcode' ));
        add_shortcode( 'se-pi-calc', array( $this, 'se_pi_shortcode' ));
        add_action( 'admin_menu', array( $this, 'add_admin_pages' ));
        add_filter( "plugin_action_links_$this->plugin", array( $this, 'settings_link' ));
    }
    
    public function se_bmr_shortcode() {
        $shortcodeDataBmr = require_once plugin_dir_path( __FILE__ ) . 'views/bmr-shortcode.php';
        return $shortcodeDataBmr;
    }
    
    public function se_bmi_shortcode() {
        $shortcodeDataBmi = require_once plugin_dir_path( __FILE__ ) . 'views/bmi-shortcode.php';
        return $shortcodeDataBmi;
    }
    
    public function se_lbm_shortcode() {
        $shortcodeDataLbm = require_once plugin_dir_path( __FILE__ ) . 'views/lbm-shortcode.php';
        return $shortcodeDataLbm;
    }
    
    public function se_wi_shortcode() {
        $shortcodeDataWi = require_once plugin_dir_path( __FILE__ ) . 'views/wi-shortcode.php';
        return $shortcodeDataWi;
    }
    
    public function se_pi_shortcode() {
        $shortcodeDataPi = require_once plugin_dir_path( __FILE__ ) . 'views/pi-shortcode.php';
        return $shortcodeDataPi;
    }
    
    public function settings_link( $links ) {
        $settings_link = '<a href="admin.php?page=se_fitness_calc">Settings</a>';
        array_push( $links, $settings_link );
        return $links;
    }
    
    public function add_admin_pages() {
        add_menu_page( 'SE Fitness Calculators', 'Fitness Calcs', 'manage_options', 'se_fitness_calc', array( $this, 'admin_index'), 'dashicons-clipboard', 80 );
    }
    
    public function admin_index() {
        require_once plugin_dir_path( __FILE__ ) . 'templates/admin.php';
    }
    
    function activate() {
        require_once plugin_dir_path( __FILE__ ) . 'inc/se-activate.php';
        SEActivate::activate();
    }
    
    function deactivate() {
        require_once plugin_dir_path( __FILE__ ) . 'inc/se-deactivate.php';
        SEDeactivate::deactivate();
    }
}

if ( class_exists( 'SEFitnessCalculators' )) {
    $seFitnessCalculators = new SEFitnessCalculators();
    $seFitnessCalculators->register();
}

// activation
register_activation_hook( __FILE__, array( $seFitnessCalculators, 'activate' ));

// deactivation
register_deactivation_hook( __FILE__, array( $seFitnessCalculators, 'deactivate' ));