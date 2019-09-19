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
                            const heightFt = $("#heightFt");
                            const heightIn = $("#heightIn");
                            const heightCm = $("#heightCm");
                            const weight = $("#weight");
                            const submit = $("#submit");
                            const reset = $("#reset");
                            const bmiLabel = $("#bmiLabel");
                            const bmi = $("#bmi");
                            const input = $(\'input[type="number"\');
                            let pounds = "lbs";
                            
                            // Set initial visibility for fields requiring toggling
                            heightFt.removeClass("hidden");
                            heightIn.removeClass("hidden");
                            heightCm.addClass("hidden");
                            bmiLabel.addClass("hidden");
                            weight.attr("placeholder", pounds);
                            
                            // Handle onChange() of unit of measurement select field
                            measurement.change(function() {
                                pounds = measurement.val() === "imperial" ? "lbs" : "kgs";
                                
                                // Toggle visibility of imperial / metric fields
                                heightFt.toggleClass("hidden");
                                heightIn.toggleClass("hidden");
                                heightCm.toggleClass("hidden");
                                
                                
                                // Toggle placeholder attributes
                                weight.attr("placeholder", pounds);
                            });
                            
                            input.keyup(function() {
                                input.each(function(){
                                    if ((weight.val() > 0 && weight.val() !== "") && 
                                      ((heightFt.val() > 0 && heightFt.val() !== "" && 
                                         heightIn.val() > 0 && heightIn.val() !== "") || (
                                             heightCm.val() > 0 && heightCm.val() !== "")
                                       )) {
                                      submit.attr("disabled", false)
                                    } else {
                                        submit.attr("disabled", true)
                                    }
                                    
                                    if (weight.val() > 0 || heightFt.val() > 0 || heightIn.val() > 0 || heightCm.val() > 0) {
                                        reset.attr("disabled", false);
                                    }
                                })
                            })
                        
                            heightFt.keyup(function(e) {
                                // TODO: Figure out how to manage max / min vals
                                heightFtVal = $(this).val();
                            });
                            
                            heightIn.keyup(function(e) {
                                // TODO: Figure out how to manage max / min vals
                                heightInVal = $(this).val();
                            });
                            
                            heightCm.keyup(function(e) {
                                // TODO: Figure out how to manage max / min vals
                                heightCmVal = $(this).val();
                            });
                            
                            submit.click(function() {
                                let bmiVal = BMICalculation(measurement.val(), heightFt.val(), heightIn.val(), heightCm.val(), weight.val());
                                
                                bmiLabel.removeClass("hidden");
                                bmi.html(`BMI: ${bmiVal} (${bmiVal < 18.5 ? "underweight" : bmiVal > 30 ? "obese" : bmiVal > 25 && bmiVal <= 30 ? "overweight" : "normal" })`);
                            });
                            
                            reset.click(function() {
                                weight.val("");
                                heightFt.val("");
                                heightIn.val("");
                                heightCm.val("");
                                bmiLabel.addClass("hidden");
                                bmi.html("");
                                submit.attr("disabled", true);
                                reset.attr("disabled", true);
                            });
                            
                            // Set which fields to display based on measurement unit on page load
                        });
                        
                        BMICalculation = (measurementUnit, heightFtVal, heightInVal, heightCmVal, weightVal) => {
                        
                            const lbToKgDecimal = 0.45359237;
                            const weightToKg = parseFloat(weightVal) * lbToKgDecimal;
                            const weightCalc = measurementUnit === "imperial" ? weightToKg : weightVal;
                        
                            const inToCmDecimal = 2.54;
                            const heightToCm = ((parseFloat(heightFtVal) * 12) + parseFloat(heightInVal)) * inToCmDecimal;
                            const heightCalc = measurementUnit === "imperial" ? heightToCm : heightCmVal;
                            const heightToM = heightCalc / 100;
                            
                            // Calculations used to determine BMIs
                            // BMI for Men = weight (kg) / [height (m)]2
                        
                            let BMI = weightCalc / Math.pow(heightToM, 2);
                            
                            return handleRounding(BMI);
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
                      
                      <label for="weight">
                        <span>Body Weight:</span>
                        <input id="weight" type="number" name="weight" min="0" />
                      </label>
                      
                      <label for="height">
                        <span>Height:</span>
                        <input
                          id="heightFt"
                          min="0"
                          max="8"
                          type="number"
                          name="heightFt"
                          class="height-ft"
                          placeholder="ft"
                        />
                        <input
                          id="heightIn"
                          min="0"
                          max="12"
                          type="number"
                          name="heightIn"
                          class="height-in"
                          placeholder="in"
                        />
                        <input
                          id="heightCm"
                          min="0"
                          max="12"
                          type="number"
                          name="heightCm"
                          class="height-cm hidden"
                          placeholder="cm"
                        />
                      </label>
                      
                      <label id="bmiLabel" for="bmi" class="hidden">
                        <span name="bmi" id="bmi"></span>
                      </label>
                      
                      <button id="submit" disabled>Get Your BMI</button>
                      <button id="reset" class="reset" disabled>Reset</button>
                    </div>
                </div>
            </body>
        </html>';
    
    return $page;