<?php
require_once '../app/views/templates/interfaceStart.php';
require_once '../app/views/templates/selectProperty.php';
?>
<!--Content here-->
<div class="container">
    <!--    <div class="row">-->
    <!--        <div class="col-md-12">-->
    <!--            <h1 class="wlcm-h1">Welcome <span class="user-color"> User!</span></h1>-->
    <!--        </div>-->
    <!--    </div>-->
    <div class="row">
        <div class="col-md-12">
            <!-- Features Section -->
            <section id="dash-links">
                <div class="container-fluid">
                    <div class="row text-center">
                        <div class="col-md-3 col-sm-6">
                            <a href="<?=WEBDIR?>/propertytenant/viewPayments">
                                <div class="dash-link">
                            <span class="icons">
                                <i class="fa fa-calendar fa-inverse"></i>
                            </span>
                                    <h4 class="link-heading">View Payments</h4>
                                    <?php
                                        $result = $_SESSION['selectedProperty']->getPayments();

                                        for ($i = 0; $i < 1; $i++) {
                                            echo "<p class='link-text'>Last payment was $".$result[$i]['amount']." payed on ".$result[$i]['time'].".";
                                        }
                                    ?>
                                    <p class="link-text">View more payments.</p>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <a href="<?=WEBDIR?>/propertytenant/addPayment">
                                <div class="dash-link">
                            <span class="icons">
                                <i class="fa fa-home fa-inverse"></i>
                            </span>
                                    <h4 class="link-heading">Add Payment</h4>

                                </div>
                            </a>
                        </div>

                    </div>
            </section>
        </div>
    </div>
</div>

<script type="text/javascript">


    $(document).ready(function () {
        $("#propertyHolder").hide();
        $(".show-properties").click(function () {
            $("#propertyHolder").toggle();
        });

        $('.navList li ').on('click', function () {
            var arraypos = $(this).attr('id');
            jQuery.ajax({
                url: '/wallfly-mvc/public/dashboard/selectedProperty',
                type: "POST",
                data: {
                    selected: arraypos
                },
                success: function (result) {
                    $("#propertyHolder").hide();
                    window.location.reload();
                },
                error: function (result) {
                    alert('Exeption:' + exception);
                }
            });
        });

        $('#box').keyup(function () {
            var valThis = this.value.toLowerCase(),
                lenght = this.value.length;

            $('.navList>li>a').each(function () {
                var text = $(this).text(),
                    textL = text.toLowerCase(),
                    htmlR = '<b>' + text.substr(0, lenght) + '</b>' + text.substr(lenght);
                (textL.indexOf(valThis) == 0) ? $(this).html(htmlR).show() : $(this).hide();
            });

        });
    });
</script>

<?php
require_once '../app/views/templates/interfaceEnd.php';
?>

