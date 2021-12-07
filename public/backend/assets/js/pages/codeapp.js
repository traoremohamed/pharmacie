$(function(){
    $('#kt_select2_1').on('change',function(e)
    {
        var id_site=e.target.value;
        // alert('test');exit;
        telUpdate(id_site);
    });

    function telUpdate(id)
    { //alert('test');exit;
        $.get('/lotiss/'+id,function(data)
        { //alert('test');exit;
            $('#kt_select2_12_2').empty();
            $.each(data,function(index,tels)
            {
                $('#kt_select2_12_2').append($('<option>',{
                    value : tels.id_loti,
                    text : tels.lib_loti,
                }));

                $.get('/lotss/'+tels.id_loti,function(data)
                {
                    $('#kt_select2_12_1').empty();
                    $.each(data,function(index,tels)
                    {
                        $('#kt_select2_12_1').append($('<option>',{
                            value : tels.id_lot,
                            text : tels.lib_lot,
                        }));


                    });
                });
            });


        });
    }


});
$(function(){
    $('#sel_loti').on('change',function(e)
    {alert('test');exit;
        var id_loti=e.target.value;
        // alert('test');exit;
        telUpdate(id_loti);
    });

    function telUpdate(id)
    {
        $.get('/lots/'+id,function(data)
        {
            $('#sel_bien').empty();
            $.each(data,function(index,tels)
            {
                $('#sel_bien').append($('<option>',{
                    value : tels.id_lot,
                    text : tels.lib_lot,
                }));


            });
        });
    }
});




$('.calcultotal').click(function () { // clic sur la case cocher/decocher

    var valeursChecked = [];
    $("input[type='checkbox']:checked").each(
        function () {
            //console.log($(this).attr('id'));
            if ($(this).val() != '') {
                valeursChecked.push($(this).val());
                console.log(valeursChecked);
            }

        });
    var totVal = 0;
    var j = 0;
    for (j = 0; j < valeursChecked.length; j++) {
        totVal = parseInt(totVal) + parseInt(valeursChecked[j]);
    }
    //alert(totVal);
    $('#total_a_afficher').html(totVal);
    $('#ligne_selectionnee').html(j);
    $('#total_a_payer').val(totVal);
});


$('.calcultotalfr').click(function () { // clic sur la case cocher/decocher

    var valeursChecked = [];
    $("input[type='checkbox']:checked").each(
        function () {
            //console.log($(this).attr('id'));
            if ($(this).val() != '') {
                valeursChecked.push($(this).val());
                console.log(valeursChecked);
            }

        });
    var totVal = 0;
    var j = 0;
    for (j = 0; j < valeursChecked.length; j++) {
        totVal = parseInt(totVal) + parseInt(valeursChecked[j]);
    }
    //alert(totVal);
    $('#total_a_afficherfr').html(totVal);
    $('#ligne_selectionneefr').html(j);
    $('#total_a_payerfr').val(totVal);
});
