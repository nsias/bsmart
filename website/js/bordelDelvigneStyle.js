/**
 * Created by siasn on 06-02-17.
 */

function testJSON(result){
    json = {};
    try
    {
        json = JSON.parse(result);
    }
    catch (err)
    {
        json = {'menuContent' : '',
            'titleContent' : 'Erreur JSON',
            'bodyContent' : result
        };
    }
    return json;
}

function jsonDoSomething(objectJS){
    $.each(objectJS, function(key, value){
        //console.log(key +":"+ value);
        switch (key){
            case "menuContent": console.log(value);
            case "titleContent" :
            case "bodyContent" : $("#"+key).html(value);break;
            default : alert("Err.retour : cas non traité ...  " + key);
        }
    });
}

$(document).ready(function()
{

    arrowShow();
    onClickMenu();

});


function arrowShow()
{
    $(window).scroll(function()
    {
        if ($(this).scrollTop() > 100)
        {
            $('.go-top').fadeIn(100);
        }

        else
        {
            $('.go-top').fadeOut(100);
        }
    });

    $('.go-top').click(function(event)
    {
        event.preventDefault();
        $('html, body').animate({scrollTop: 0}, 100);
    });
}

function onClickMenu()
{
    $( '#menu li' ).click(function(event)
    {
        event.preventDefault();
        var rq = $(this).find("a").attr('href');
        if(rq != "#")
        {
            $.get("index.php?content="+rq, function( data )
            {
                jsonDoSomething(testJSON(data));
            })
                .done( function()
                {
                    loadAsynchronousForm();7
                    onClickMenu();
                });

        }

    });
}


function loadAsynchronousForm()
{
    $("form").submit( function( e )
    {
        e.preventDefault();
        var strSubmit = "&";
        $("form :input").each(function()
        {
            //str.concat("&");
            var id = $(this).attr("id");
            if(id !="loginButton")
            {
                var val = $(this).val();
                strSubmit += id+"=";
                strSubmit += val+"&";
            }
            else
            {
                strSubmit +="submit=ON";
            }

        });
        console.log(strSubmit);
        $.get("index.php?content=login"+strSubmit,function(data){
            jsonDoSomething(testJSON(data));
        }).done(function(){
            onClickMenu();
        });
    });
}
