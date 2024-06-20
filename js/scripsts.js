$(document).ready(function(){
    
//progress bar
let containerA = document.getElementById("circleA");

let circleA = new progressBar.Circle(containerA,{

    color: 'blue',
    strokeWidth:8,
    duration:1400,
    from:{color:'#AAA' },
    to:{color:'#65DAF9'},
    
    step:function(state,circle){
        circle.path.setAttribute('stroke', state.color)
        let value = Math.round(circle.value() * 60);

        circle.setText(value);

    }
});

let containerB = document.getElementById("circleB");

let circleB = new progressBar.Circle(containerB,{

    color: 'blue',
    strokeWidth:8,
    duration:1400,
    from:{color:'#AAA' },
    to:{color:'#65DAF9'},
    
    step:function(state,circle){
        circle.path.setAttribute('stroke', state.color)
        let value = Math.round(circle.value() * 60);

        circle.setText(value);

    }
});


let containerC = document.getElementById("circleC");

let circleC = new progressBar.Circle(containerC,{

    color: 'blue',
    strokeWidth:8,
    duration:1400,
    from:{color:'#AAA' },
    to:{color:'#65DAF9'},
    
    step:function(state,circle){
        circle.path.setAttribute('stroke', state.color)
        let value = Math.round(circle.value() * 60);

        circle.setText(value);

    }
});

let containerD = document.getElementById("circleD");

let circleD = new progressBar.Circle(containerD,{

    color: 'blue',
    strokeWidth:8,
    duration:1400,
    from:{color:'#AAA' },
    to:{color:'#65DAF9'},
    
    step:function(state,circle){
        circle.path.setAttribute('stroke', state.color)
        let value = Math.round(circle.value() * 60);

        circle.setText(value);

    }
});

//Iniciando o loader quanto o usuario chega no elemento
let dataAreaOffset = $('#data-area').offset();
let stop = 0 ;

$(window).scroll(function(e){
    let scroll = $(window).scrollTop();
    if(scroll > (dataAreaOffset.top -500) && stop == 0){

        circleA.animate(1,0);
        circleB.animate(1,0);
        circleC.animate(1,0);
        circleD.animate(1,0);

        stop =1;
    }
}

//parallax
setTimeout(function(){

    $('class onde quero colocar').parallax({imageSrc:'image que quero colocar'});
},250


});