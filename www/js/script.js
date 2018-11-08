function apiCang(apis){
    $("#source select").on('change', function() {
        let apiItem = $(this).find(":selected").val();
        let tempArr = [];
        let cur_for = $('#cur_from');
        cur_for.html('');
        let cur_to = $('#cur_to');
        cur_to.html('');
        $("#rezult h1").first().html('');
        $("#rezult").css({'display' : 'none'});
        $('#convert input[type="text"]').first().val('');

        if(apiItem.length > 0){
            apis.forEach( itemApi =>{
                if(itemApi.title == apiItem){
                    let apiData = itemApi.data;
                    apiData.forEach( dItem => {
                        if(tempArr.indexOf(dItem.base_ccy) < 0){
                            tempArr.push(dItem.base_ccy);
                        }
                        if(tempArr.indexOf(dItem.ccy) < 0){
                            tempArr.push(dItem.ccy);
                        }
                    });
                }
            });
            tempArr.forEach( (val,index) => {
                cur_for.append(`<option ${ index==0? 'selected' : ''} value="${val}">${val}</option>`);
                cur_to.append(`<option ${ index==0? 'selected' : ''} value="${val}">${val}</option>`);
            });
            $("#convert").fadeIn(1000)
        } else {
            $("#convert").fadeOut(1000)
        }

    });
}

function initCalcul(apis){
    $('#convert input[type="button"]').first().on('click', ()=>{
        let apiItem = $("#source option:selected").first().val();
        let cur_for = $("#cur_from option:selected").first().val();
        let cur_to = $("#cur_to option:selected").first().val();
        let cur_vall = $('#convert input[type="text"]').first().val();
        cur_vall = parseFloat(cur_vall);
        if(!isNaN(cur_vall)){
            $('#convert input[type="text"]').css({'border-color' : ''})
            if(apiItem.length > 0 && cur_for.length && cur_to.length > 0){
                apis.forEach( itemApi =>{
                    if(itemApi.title == apiItem){
                        let apiData = itemApi.data;
                        apiData.forEach( dItem => {
                            if(dItem.base_ccy == cur_for && dItem.ccy == cur_to){
                                // dItem.val
                                let rez = cur_vall*dItem.val+'';
                                if(rez && rez.length > 0){
                                    let flag = rez.indexOf('.');
                                    if(flag && flag >= 0){
                                        rez = rez.substring(0, flag+3);
                                    }
                                    $("#rezult h1").first().html(`${cur_vall} ${cur_for} = ${rez} ${cur_to}`);
                                    $("#rezult").css({'display' : 'block'});
                                }
                            }
                        });
                    }
                });
            }
        } else {
            $('#convert input[type="text"]').css({'border-color' : '#FF304F'})
            $("#rezult").css({'display' : 'none'});
        }
    });
}

$(function() {
    if(apis){
        apiCang(apis);
        initCalcul(apis);

        // console.log('---', apis );
    }
});