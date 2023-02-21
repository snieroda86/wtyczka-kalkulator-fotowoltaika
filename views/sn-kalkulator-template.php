<?php $opts =  SN_Kalkulator_Settings::$options; ?>

<!--Scripts-->
    <script type="text/javascript">
        jQuery(document).ready(function($) { 
            var zalecanaMocInstalacji;

            var instalationTypePrice = {
                ekonomiczna: <?php echo(is_array($opts) && isset($opts['sn_kalkulator_economic']) && !empty($opts['sn_kalkulator_economic'])) ? $opts['sn_kalkulator_economic'] : 3600  ;   ?> ,
                standardowa:<?php echo (is_array($opts) && isset($opts['sn_kalkulator_standard']) && !empty($opts['sn_kalkulator_standard'])   ) ? $opts['sn_kalkulator_standard'] : 4100 ; ?>,
                premium: <?php echo (is_array($opts) && isset($opts['sn_kalkulator_premium']) && !empty($opts['sn_kalkulator_premium'])) ? $opts['sn_kalkulator_premium'] : 4600; ?>
            };

            var offerList = {
                ekonomiczna : {
                    title : "Oferta ekonomiczna",
                    desc : "Oferta Ekonomiczna skierowana jest do klientów, dla których najważniejsza jest szybkość zwrotu instalacji."
                },
                standardowa : {
                    title : "Oferta standardowa",
                    desc : "Oferta Standardowa składa się z optymalnego stosunku jakości użytych materiałów do ceny. Instalacja zwróci się nam do 5 roku jej życia."
                } ,
                premium : {
                    title : "Oferta premium",
                    desc : "Oferta Premium skierowana jest do wymagających klientów, dla których liczy sie jakość, a nie szybkość zwrotu poniesionych kosztów."
                }
            };


            // Rodzaj obliczeń
            $('input[type=radio][name=rodzaj_obliczen]').change(function() {
                if (this.value == 1) {
                   $('#calc-sec-2-sn').fadeIn();
                   $('#calc-sec-3-sn').css("display" , "none");

                }
                else if (this.value == 2) {
                   $('#calc-sec-3-sn').fadeIn();
                   $('#calc-sec-2-sn').css("display" , "none");

                }
            });

            // Pokaż kalkulację

            // Wysokosc rachunków
            $('#wysokoscRachunkowNext').click(function(){
                if( ! $('#wysokoscRachunkow').val() ){
                    $('#kalkulacjaWynik').fadeOut();
                    alert('Musisz podać wartośc dla pola wysokośc rachunków');
                }else{
                    $('#table-wysokosc-rachunkow').css("display" , "block");
                    $('#table-roczne-zapotrzebowanie').css("display" , "none");
                    $('#kalkulacjaWynik').fadeIn();
                    $('#rodzajInstalacji').fadeIn();
                    $('#rodzajInstalacjiContainer').fadeIn();


                    // Kalkulacja
                    // $('tr:eq(2) td:eq(1)');
                    var wysokoscRachunkowVal = $('#wysokoscRachunkow').val();
                    $('#table-wysokosc-rachunkow table tbody tr:eq(0) td:eq(1)').html(wysokoscRachunkowVal);

                    var roczneZapotrzebowanieVal = (wysokoscRachunkowVal / 0.75) * 12;
                    $('#table-wysokosc-rachunkow table tbody tr:eq(2) td:eq(1)').html(roczneZapotrzebowanieVal);

                    // Oczekiwana roczna produkcja
                    var oczekiwanaRocznaProdukcja = roczneZapotrzebowanieVal * 1.25 ;
                    $('#table-wysokosc-rachunkow table tbody tr:eq(5) td:eq(1)').html(oczekiwanaRocznaProdukcja);

                    // zalecana moc instalacji
                    // var zalecanaMocInstalacji = oczekiwanaRocznaProdukcja / 1000 ;
                    zalecanaMocInstalacji = oczekiwanaRocznaProdukcja / 1000 ;

                    $('#table-wysokosc-rachunkow table tbody tr:eq(6) td:eq(1)').html(zalecanaMocInstalacji);



                    // Kalkulacja end
                }


                var economicIsntallationCost = instalationTypePrice["ekonomiczna"];
                var primaryCost = economicIsntallationCost * zalecanaMocInstalacji;
                $('#calkowityKosztInstalacji').html(primaryCost);


            });

            // Roczne zapotrzebowanie
            // roczneZapotrzebowanieNext
             $('#roczneZapotrzebowanieNext').click(function(){
                if( ! $('#roczneZapotrzebowanie').val() ){
                    $('#kalkulacjaWynik').fadeOut();

                    alert('Musisz podać wartośc dla pola roczne zapotrzebowanie');
                }else{
                    $('#table-roczne-zapotrzebowanie').css("display" , "block");
                    $('#table-wysokosc-rachunkow').css("display" , "none");
                    $('#kalkulacjaWynik').fadeIn();
                    $('#rodzajInstalacji').fadeIn();
                    $('#rodzajInstalacjiContainer').fadeIn();


                    // Roczne zapotrzebowanie 
                    var roczneZapotrzebowanieVal = $('#roczneZapotrzebowanie').val();
                    $('#table-roczne-zapotrzebowanie table tbody tr:eq(0) td:eq(1)').html(roczneZapotrzebowanieVal);

                    // Oczekiwana poczna prodkcja
                    var oczekiwanaRocznaProdukcja = roczneZapotrzebowanieVal * 1.25 ;
                    $('#table-roczne-zapotrzebowanie table tbody tr:eq(3) td:eq(1)').html(oczekiwanaRocznaProdukcja);

                     // Zalecana moc instalacji
                    // var zalecanaMocInstalacji = oczekiwanaRocznaProdukcja / 1000 ;
                    zalecanaMocInstalacji = oczekiwanaRocznaProdukcja / 1000 ;

                    $('#table-roczne-zapotrzebowanie table tbody tr:eq(4) td:eq(1)').html(zalecanaMocInstalacji);

                }

                var economicIsntallationCost = instalationTypePrice["ekonomiczna"];
                var primaryCost = economicIsntallationCost * zalecanaMocInstalacji;
                $('#calkowityKosztInstalacji').html(primaryCost);

            });

            // Wybór typu instalacji

            $('#typInstalacji').on("change" , function(){
               
                var typInstalacjiVal = $(this).val();
               
                var offerTitle = offerList[typInstalacjiVal]["title"];
                var offerDesc = offerList[typInstalacjiVal]["desc"];

                $(".rodzaj-instalacji-title").html(offerTitle);
                $(".rodzaj-instalacji-desc").html(offerDesc);

                // Koszt instalacji
                var singleInstalationPrice = instalationTypePrice[typInstalacjiVal];
                var totalCost = singleInstalationPrice * zalecanaMocInstalacji;
                $('#calkowityKosztInstalacji').html(totalCost);
                
            })


  
        });

 </script>
<!--Scripts end-->


<!-- Kalk start -->
<div class="sn-kalkulator-wrapper">
    <form  id="sn_calculator_form">

        <!-- Sec 1 start -->
        <div class="sn-calc-sec-1" id="calc-sec-1-sn">
            <div class="sn-row">
                <div class="sn-col-12">
                    <h6 class="font-weight-normal text-secondary sn-kalk-step">Krok <span class="text-primary">1</span> z 4</h6>
                    <h4>Wybierz rodzaj obliczeń</h4>
                </div>
            </div>
            <div class="sn-row">
                <div class=" sn-col-md-6">
                    <div class="sn-custom-control sn-custom-radio ">
                        <input type="radio" id="rodzaj-obliczen-1" name="rodzaj_obliczen" class="custom-control-input" value="1">
                        <label class="custom-control-label" for="rodzaj-obliczen-1">
                            Znam koszt miesięcznych rachunków
                        </label>
                    </div>
                </div>
                <div class="sn-col-md-6">
                    <div class="sn-custom-control sn-custom-radio">
                        <input type="radio" id="rodzaj-obliczen-2" name="rodzaj_obliczen" class="custom-control-input" value="2">
                        <label class="custom-control-label" for="rodzaj-obliczen-2">
                            Znam roczne zapotrzebowanie energetyczne
                        </label>
                    </div>
                </div>
            </div>
        </div>
        <!-- Sec 1 end -->

        <!-- Sec 2 start -->

        <div id="calc-sec-2-sn" class="sn-calc-sec-2" style="display: none;">
            <!-- <hr class="mb-5"> -->
            <div class="sn-row">
                <div class="sn-col-12">
                    <h6 class="font-weight-normal text-secondary sn-kalk-step">Krok <span class="text-primary">2</span> z 4</h6>
                    <h4>Podaj koszt miesięcznych rachunków (zł/msc)</h4>
                </div>
            </div>
            <div class="sn-row">
                <div class="sn-col-12">
                    <div class="form-group pt-2">
                        <!-- <label for="costs">Wysokość miesięcznych rachunków (zł/msc)</label> -->
                        <div class="row align-items-center">
                            <div class="col-8">
                                <input type="text" value="" name="wysokosc_rachunkow" id="wysokoscRachunkow" class="form-control">
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>

            <div class="sn-row">
                <div class="sn-col-12">
                    <div class="text-right-sn">
                        <button type="button" id="wysokoscRachunkowNext" class="btn btn-outline-primary float-right btnNextStep ml-auto-sn">
                            Przejdź dalej
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sec 2 end -->

        <!-- Sec 3 start -->

        <div id="calc-sec-3-sn" class="sn-calc-sec-3"  style="display: none;">
            <!-- <hr class="mb-5"> -->
            <div class="sn-row">
                <div class="sn-col-12">
                     <h6 class="font-weight-normal text-secondary sn-kalk-step">Krok <span class="text-primary">2</span> z 4</h6>
                    <h4>Roczne zapotrzebowanie energetyczne (kWh/rok)</h4>
                </div>
            </div>
            <div class="sn-row">
                <div class="sn-col-12">
                    <div class="form-group pt-2">
                        <!-- <label for="demand">Wielkość zapotrzebowania</label> -->
                        <div class="row align-items-center">
                            <div class="col-8">
                                <input type="text" name="roczne_zapotrzebowanie" id="roczneZapotrzebowanie" class="form-control">
                            </div>
                           
                        </div>
                    </div>
                </div>
            </div>

            <div class="sn-row">
                <div class="sn-col-12">
                    <div class="text-right-sn">
                        <button type="button" id="roczneZapotrzebowanieNext" class="btn btn-outline-primary float-right btnNextStep">
                            Przejdź dalej
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sec 3 end -->


        <!-- Kalkulacja start -->

        <div style="display: none;" id="kalkulacjaWynik" class="resultBox">
            <div class="sn-row">
                <div class="sn-col-12">
                    <h6 class="font-weight-normal text-secondary sn-kalk-step">Krok <span class="text-primary">3</span> z 4</h6>
                    <h4>Kalkulacja</h4>
                </div>
            </div>

            <!-- Kalkulacja - wysokość miesiecznych rachunków -->
            <div class="sn-row ptb-0">
                <div class="sn-col-12 ptb-0">
                    <div class="table-responsive" id="table-wysokosc-rachunkow" style="display: none;">
                        <table class="table table-striped table-hover w-100">
                            <tbody>
                                <tr>
                                    <td>Wysokość miesięcznych rachunków</td>
                                    <td>200</td>
                                    <td>zł/msc</td>
                                </tr>
                                <tr>
                                    <td>Cena za 1kWh</td>
                                    <td>0.75</td>
                                    <td>zł/kWh</td>
                                </tr>
                                <tr>
                                    <td>Roczne zapotrzebowanie na energię</td>
                                    <td>322.58</td>
                                    <td>kWh/rok</td>
                                </tr>
                                <tr>
                                    <td>Przewymiarowanie instalacji</td>
                                    <td>25</td>
                                    <td>%</td>
                                </tr>
                               
                                <tr>
                                    <td>Średni uzysk z 1kWp instalacji PV - ekspozycja południowa</td>
                                    <td>1000</td>
                                    <td>kWh/rok</td>
                                </tr>
                                 <tr>
                                    <td>Oczekiwana roczna produkcja z PV</td>
                                    <td>4838.71</td>
                                    <td>kWh/rok</td>
                                </tr>
                                <tr>
                                    <td>Zalecana moc instalacji PV</td>
                                    <td>4.84</td>
                                    <td>kWp</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Kalkulacja - roczne zapotrzebowanie na energie -->
            <div class="sn-row ptb-0">
                <div class="sn-col-12 ptb-0">
                    <div class="table-responsive" id="table-roczne-zapotrzebowanie" style="display: none;">
                        <table class="table table-striped table-hover w-100">
                            <tbody>
                                <tr>
                                    <td>Roczne zapotrzebowanie na energię</td>
                                    <td>200</td>
                                    <td>kWh/rok</td>
                                </tr>
                                <tr>
                                    <td>Przewymiarowanie instalacji</td>
                                    <td>25</td>
                                    <td>%</td>
                                </tr>
                                 <tr>
                                    <td>Średni uzysk z 1kWp instalacji PV - ekspozycja południowa</td>
                                    <td>1000</td>
                                    <td>kWh/rok</td>
                                </tr>
                                 <tr>
                                    <td>Oczekiwana roczna produkcja z PV</td>
                                    <td>4838.71</td>
                                    <td>kWh</td>
                                </tr>                                                      
                                <tr>
                                    <td>Zalecanc moc instalacji PV</td>
                                    <td>4.84</td>
                                    <td>kWp</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        
        </div>
        <!-- Kalkulacja end -->

        <!-- Rodzaj instalacji start -->
        
        <div id="rodzajInstalacji" class="rodzaj-instalacji-wrapper" style="display:none;">
            <!-- <hr class="mt-5"> -->
            <div class="sn-row">
                <div class="sn-col-12">
                    <h6 class="font-weight-normal text-secondary sn-kalk-step">Krok <span class="text-primary">4</span> z 4</h6>
                    <h4>Wybierz rodzaj instalacji</h4>
                </div>
            </div>
            <div class="sn-row">
                <div class="sn-col-12">
                    <div class="form-group">
                        <!-- <label for="typInstalacji">Rodzaj instalacji</label> -->
                        <select name="typ_instalacji" id="typInstalacji" class="form-control">
                            <option value="ekonomiczna" selected>Ekonomiczna</option>
                            <option value="standardowa" >Standardowa</option>
                            <option value="premium">Premium</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <!-- Rodzaj isntalacji end -->

        <div id="rodzajInstalacjiContainer" class="rodzaj-instalacji-items-container" style="display: none;">
            <div class="sn-row">
                <div class="sn-col-12">
                    <div id="installation_desc">
                        <div class="">
                           <!--  <div class="col-12 col-lg-4">
                                <picture class="round calculator-offer-image"><img class="lazy background loaded" src="https://termo-industria.pl/storage/calculator/8cfbe286a167153851c79657477789a9.jpg" srcset="https://termo-industria.pl/storage/calculator/8cfbe286a167153851c79657477789a9@2x.jpg 2x,https://termo-industria.pl/storage/calculator/8cfbe286a167153851c79657477789a9.jpg  1x"></picture>
                            </div> -->
                            <div class="">
                                <h5 class="rodzaj-instalacji-title">Oferta ekonomiczna</h5>
                                <p class="rodzaj-instalacji-desc">Oferta Ekonomiczna skierowana jest do klientów, dla których najważniejsza jest szybkość zwrotu instalacji.</p>
                            </div>
                        </div>
                    </div>
                   
                    <div class="sn-row pt-3">
                        <div class="sn-col-12">
                            <h4 class="pr-5">Jednorazowy koszt instalacji:</h4>
                        </div>
                    </div>
                    <div class="sn-row">
                        <div class="sn-col-12">
                            <div class="bg-accent-sn">
                                <div class="row align-items-center">
                                    <div class="col-12">
                                        <h5 class="p-0 m-0"><span id="calkowityKosztInstalacji">18387.1</span> zł</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Uwaga -->
             <div class="sn-row ">
                <div class="sn-col-12">
                    <div class="bg-alert-sn">
                        <h5>Uwaga</h5>
                        <p class="p-0">Informacje dostarczone przez kalkulator są symulacją. Skontaktuj się z nami w celu weryfikacji i potwierdzenia oferty.</p>
                        <a href="#" class="button-sn ">Skontaktuj się</a>
                    </div>
                </div>
            </div>
            <!-- Uwaga end -->

        </div>

       

        <!-- </div> -->

    </form>
</div>
<!-- Kalk end -->