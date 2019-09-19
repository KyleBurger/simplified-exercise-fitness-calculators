<?php
    $page = '<!DOCTYPE html>
        <html>
            <head>
                <style type="text/css">
                    .hidden {
                        display: none !important;
                    }
                    .fitness-calc {
                        display: grid;
                        grid-template-columns: 1fr;
                        grid-gap: 20px;
                        max-width: 1000px;
                        margin: 80px auto;
                        padding: 0 20px;
                    }
                    
                     .fitness-calc label {
                        font-size: 20px;
                        display: grid;
                        grid-template-columns: repeat(auto-fit, minmax(100px, 1fr));
                        grid-gap: 5px 10px;
                        position: relative;
                        max-width: 100%;
                        align-items: center;
                     }
                    
                    .fitness-calc label input,
                    .fitness-calc label select {
                        height: 40px;
                        font-size: 16px;
                        outline: none;
                        text-align: center;
                        color: #000;
                        border: 1px solid #000;
                        width: 100%;
                    }
                    
                    .fitness-calc label input:focus,
                    .fitness-calc label select:focus {
                        background: rgba(0, 0, 0, 0.1);
                    }
                    
                            
                    .fitness-calc label select {
                        -webkit-appearance: none;
                        -moz-appearance: none;
                        appearance: none;
                        border-radius: 0;
                        background-position: calc(100% - 0.5rem) 50%;
                        background-repeat: no-repeat;
                        background-image: url(\'data:image/svg+xml;utf8,<?xml version="1.0" encoding="utf-8"?><!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 1.1//EN" "http://www.w3.org/Graphics/SVG/1.1/DTD/svg11.dtd"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="12" version="1"><path d="M4 8L0 4h8z"/></svg>\');
                        padding: 0.5em;
                        padding-right: 1.5em;
                    }
                    
                    @media only screen and (max-width: 600px) {
                        .fitness-calc label select {
                            grid-template-columns: 1fr;
                        }
                    }
                    
                    .fitness-calc button {
                        padding: 15px 0;
                        color: white;
                        background-color: #0a3951;
                        border: 1px solid #0a3951;
                        box-shadow: 0 10px 24px 0 rgba(0,0,0,.19);
                        margin-top: 10px;
                        max-width: 100%;
                    }
                    
                    .fitness-calc button:focus {
                        outline: none;
                    }
                    
                    .fitness-calc button:hover {
                        box-shadow: unset;
                        cursor: pointer;
                    }
                    
                    .fitness-calc button:disabled { 
                        background-color: #ccc;
                        color: #000;
                    }
                    
                    .fitness-calc button:hover:disabled {
                        background-color: #ccc;
                        color: #000;
                    }
                    
                    .fitness-calc button:hover:disabled:hover {
                        cursor: unset;
                        box-shadow: 0 10px 24px 0 rgba(0,0,0,.19);
                    }
                    
                    .fitness-calc #bmrLabel, #bmiLabel, #lbmLabel, #wiLabel, #piLabel {
                            border: 1px solid #000;
                            text-align: center;
                            padding: 1.2rem;
                            font-weight: 600;
                            font-size: 1.8rem;
                    }
                    
                    .fitness-calc #bmrLabel, #bmiLabel, #lbmLabel, #wiLabel, #piLabel span {
                        line-height: 1.2em;            
                    }
                    
                    .fitness-calc .reset {
                        background-color: transparent;
                        color: #000;
                        min-width: 200px;
                        justify-self: center;
                        max-width: 100%;
                    }
                    
                    .fitness-calc .reset:hover { 
                        background-color: #0a3951;
                        color: white;
                    }
                    .fitness-calc .reset:disabled { 
                        background-color: #ccc;
                    }
                    
                    .fitness-calc .reset:disabled:hover {
                        cursor: unset;
                        box-shadow: 0 10px 24px 0 rgba(0,0,0,.19);
                        color: #000;
                    }
                </style>
                <script type="text/javascript">
                    (function ($) {
                        $(document).ready(function() {
                            const measurement = $("#measurement");
                            const gender = $("#gender");
                            const weight = $("#weight");
                            const submit = $("#submit");
                            const reset = $("#reset");
                            const piLabel = $("#piLabel");
                            const pi = $("#pi");
                            const input = $(\'input[type="number"\');
                            let pounds = "lbs";
                            
                            // Set initial visibility for fields requiring toggling
                            piLabel.addClass("hidden");
                            weight.attr("placeholder", pounds);
                            
                            // Handle onChange() of unit of measurement select field
                            measurement.change(function() {
                                pounds = measurement.val() === "imperial" ? "lbs" : "kgs";
                                
                                // Toggle placeholder attributes
                                weight.attr("placeholder", pounds);
                            });
                            
                            input.keyup(function() {
                                input.each(function(){
                                    if ((weight.val() > 0 && weight.val() !== "")) {
                                      submit.attr("disabled", false);
                                    } else {
                                        submit.attr("disabled", true)
                                    }
                                    
                                    if (weight.val() > 0) {
                                        reset.attr("disabled", false);
                                    }
                                })
                            })
                            
                            submit.click(function() {
                                let piVal = PICalculation(measurement.val(), weight.val(), gender.val());
                                
                                piLabel.removeClass("hidden");
                                pi.html(`${piVal.low} - ${piVal.high} daily grams of protein`);
                            });
                            
                            reset.click(function() {
                                weight.val("");
                                piLabel.addClass("hidden");
                                pi.html("");
                                submit.attr("disabled", true);
                                reset.attr("disabled", true);
                            });
                            
                            // Set which fields to display based on measurement unit on page load
                        });
                        
                        PICalculation = (measurementUnit, weightVal, genderVal) => {
                            const lbToKgDecimal = 0.45359237;
                            const weightToLb = parseFloat(weightVal) / lbToKgDecimal;
                            const weightCalc = measurementUnit === "metric" ? weightToLb : weightVal;
                            
                        
                            // Calculations used to determine Protein Intake
                            // PI for Men = 0.7 - 1.5g per lb
                            // PI for Women = 
                            
                            
                            let piLow = weightCalc * 0.7;
                            let piHigh = weightCalc * 1.5;
                        
                            if (genderVal === "female") {
                                piLow = 0;
                                piHigh = 0;
                            }
                            
                            return {low: handleRounding(piLow), high: handleRounding(piHigh)};
                        };
                        
                        handleRounding = val => {
                            return Math.ceil((val * 1) / 1);
                        };
                        
                    })(jQuery); 
                </script>
            </head>
            
            <body>
                <div class="calculator">
                    <div class="fitness-calc">
                      <label for="measurement">
                        <span>Units Of Measurement:</span>
                        <select name="measurement" id="measurement">
                          <option value="imperial">Imperial</option>
                          <option value="metric">Metric</option>
                        </select>
                      </label>
                      
                      <label for="gender">
                        <span>Gender:</span>
                        <select id="gender" name="gender">
                          <option value="male">Male</option>
                          <option value="female">Female</option>
                        </select>
                      </label>
                      
                      <label for="weight">
                        <span>Lean Body Mass: (<a href="/lbm-calculator" target="_blank" rel="noopener noreferrer">calculator</a>)</span>
                        <input id="weight" type="number" name="weight" min="0" />
                      </label>
                      
                      <label id="piLabel" for="pi" class="hidden">
                        <span name="pi" id="pi"></span>
                      </label>
                      
                      <button id="submit" disabled>Get Your Protein Intake</button>
                      <button id="reset" class="reset" disabled>Reset</button>
                    </div>
                </div>
            </body>
        </html>';
    
    return $page;